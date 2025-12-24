<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
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
            'identifier' => ['required', 'string', 'email', 'max:191'],
        ]);

        $identifier = strtolower(trim($data['identifier']));

        /** @var User|null $user */
        $user = User::where('email', $identifier)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'identifier' => 'User does not exist.',
            ]);
        }

        if ($user->isBlocked()) {
            throw ValidationException::withMessages([
                'identifier' => 'Your account is blocked.',
            ]);
        }

        if ($user->isInactive()) {
            throw ValidationException::withMessages([
                'identifier' => 'Your account is inactive.',
            ]);
        }

        // Rate limit OTP sends per identifier + IP
        $key = 'otp_send:'.sha1($identifier.'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'identifier' => "Too many requests. Try again in {$seconds} seconds.",
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
            ->with('success', 'OTP sent.');
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
        $user = $this->findUserByIdentifier($identifier);

        Auth::login($user, remember: true);
        $request->session()->regenerate();

        RateLimiter::clear($key);

        return redirect()->route('dashboard');
    }

    private function normalizeIdentifier(string $identifier): string
    {
        $identifier = trim($identifier);

        if (!filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email address.');
        }
        return mb_strtolower($identifier);
    }

    private function findUserByIdentifier(string $identifier): User
    {
        if (!filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email address.');
        }
        return User::where('email', $identifier)->firstOrFail();
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }

    public function register()
    {
        return view('auth.register');
    }
}
