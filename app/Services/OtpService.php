<?php

namespace App\Services;

use App\Models\Otp;
use Illuminate\Support\Facades\Hash;
use Log;
use Random\RandomException;

class OtpService
{
    /**
     * @throws RandomException
     */
    public function createOtp(
        string $identifier,
        string $purpose = 'login',
        int $ttlMinutes = 5,
        ?string $ip = null,
        ?string $ua = null
    ): Otp {
        // Optional: invalidate previous active OTPs for same identifier/purpose
        Otp::where('identifier', $identifier)
            ->where('purpose', $purpose)
            ->whereNull('consumed_at')
            ->update(['consumed_at' => now()]);

        $code = $this->generateCode(6);

        $otp = Otp::create([
            'identifier' => $identifier,
            'purpose' => $purpose,
            'code_hash' => Hash::make($code),
            'expires_at' => now()->addMinutes($ttlMinutes),
            'ip' => $ip,
            'user_agent' => $ua,
        ]);

        // Send it (replace with real provider)
        $this->sendCode($identifier, $code);

        return $otp;
    }

    /**
     * @throws RandomException
     */
    public function generateCode(int $digits = 6): string
    {
        $min = (int) pow(10, $digits - 1);
        $max = (int) pow(10, $digits) - 1;
        return (string) random_int($min, $max);
    }

    public function sendCode(string $identifier, string $code): void
    {
        // Decide channel by identifier format
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            // Email sending placeholder
            Log::info("OTP Email to $identifier: $code");
            // TODO: Mail::to($identifier)->send(new OtpMail($code));
            return;
        }

        // SMS sending placeholder
        Log::info("OTP SMS to $identifier: $code");
        // TODO: integrate Twilio / Vonage / local gateway
    }

    public function verify(string $identifier, string $code, string $purpose = 'login', int $maxAttempts = 5): bool
    {
        $otp = Otp::where('identifier', $identifier)
            ->where('purpose', $purpose)
            ->whereNull('consumed_at')
            ->latest()
            ->first();

        if (!$otp) {
            return false;
        }

        if ($otp->isExpired()) {
            return false;
        }

        if ($otp->attempts >= $maxAttempts) {
            return false;
        }

        $otp->increment('attempts');

        if (!Hash::check($code, $otp->code_hash)) {
            return false;
        }

        $otp->update(['consumed_at' => now()]);

        return true;
    }
}
