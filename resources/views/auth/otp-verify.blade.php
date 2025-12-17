<x-master title="Verify OTP">
    <div class="frow">
        <div class="w-80 min-h-screen fcols">
            <x-forms.otp.verify :$identifier/>
            <x-forms.otp.resend :$identifier/>
        </div>
    </div>
</x-master>
