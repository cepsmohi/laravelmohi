<form
    method="POST"
    action="{{ route('otp.request') }}"
    id="resentOtpForm"
>
    <div class="mt-8 fcol">
        <div class="p-4 border border-dashed rounded-3xl">
            @csrf
            <input type="hidden" name="identifier" value="{{ old('identifier', $identifier) }}">
            <x-form.submit-button
                form="resentOtpForm"
                icon="send"
                tag="Resend OTP"
            />
        </div>
    </div>
</form>
