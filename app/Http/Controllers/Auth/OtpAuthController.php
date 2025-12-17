<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Random\RandomException;

class OtpAuthController extends Controller
{
    public function showRequestForm()
    {
        return view('auth.otp-request');
    }

    /**
     * @throws RandomException|RandomException
     */
    public function requestOtp(Request $request, OtpService $otpService)
    {
        $data = $request->validate([
            'identifier' => ['required', 'string', 'max:191'], // email or phone
        ]);

        $identifier = $this->normalizeIdentifier($data['identifier']);

        // Rate limit OTP sends per identifier + IP
        $key = 'otp_send:'.sha1($identifier.'|'.$request->ip());
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'identifier' => "Too many requests. Try again in $seconds seconds.",
            ]);
        }
        RateLimiter::hit($key);

        $otpService->createOtp(
            identifier: $identifier,
            ip: $request->ip(),
            ua: substr((string) $request->userAgent(), 0, 255),
        );

        return redirect()
            ->route('otp.verify.form', ['identifier' => $identifier])
            ->with('status', 'OTP sent successfully.');
    }

    private function normalizeIdentifier(string $identifier): string
    {
        $identifier = trim($identifier);

        // If it's email, lowercase it
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            return mb_strtolower($identifier);
        }

        // If it's phone, keep digits + leading + (basic normalization)
        return preg_replace('/[^\d+]/', '', $identifier) ?? $identifier;
    }

    public function showVerifyForm(Request $request)
    {
        $identifier = $request->query('identifier', '');
        return view('auth.otp-verify', ['identifier' => $identifier]);
    }

    public function verifyOtp(Request $request, OtpService $otpService)
    {
        $data = $request->validate([
            'identifier' => ['required', 'string', 'max:191'],
            'code' => ['required', 'string', 'min:4', 'max:10'],
        ]);

        $identifier = $this->normalizeIdentifier($data['identifier']);
        $code = trim($data['code']);

        // Rate limit verification attempts
        $key = 'otp_verify:'.sha1($identifier.'|'.$request->ip());
        if (RateLimiter::tooManyAttempts($key, 10)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'code' => "Too many attempts. Try again in $seconds seconds.",
            ]);
        }
        RateLimiter::hit($key);

        $ok = $otpService->verify($identifier, $code);

        if (!$ok) {
            throw ValidationException::withMessages([
                'code' => 'Invalid or expired OTP.',
            ]);
        }

        // Find or create user
        $user = $this->findOrCreateUserByIdentifier($identifier);

        Auth::login($user, remember: true);
        $request->session()->regenerate();

        RateLimiter::clear($key);

        return redirect()->route('dashboard');
    }

    private function findOrCreateUserByIdentifier(string $identifier): User
    {
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            return User::firstOrCreate(
                ['email' => $identifier],
                ['name' => 'User '.substr(sha1($identifier), 0, 6), 'password' => bcrypt(str()->random(32))]
            );
        }

        // Phone flow
        return User::firstOrCreate(
            ['phone' => $identifier],
            ['name' => 'User '.substr(sha1($identifier), 0, 6), 'password' => bcrypt(str()->random(32))]
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function register()
    {
        return view('auth.register');
    }
}
