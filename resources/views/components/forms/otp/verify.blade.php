<form
    method="POST"
    action="{{ route('otp.verify') }}"
    id="otpVerifyForm"
>
    <div class="-mt-12 fcol">
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-3xl shadow">
            <div class="mb-2 title text-grad">Verify OTP</div>
            @csrf
            <input type="hidden" name="identifier" value="{{ old('identifier', $identifier) }}">
            <div class="mb-4">
                <div>Sent to: <strong>{{ old('identifier', $identifier) }}</strong></div>
                <x-forms.otp.expiretime :$identifier/>
            </div>
            <x-form.input name="code" icon="code" placeholder="123456" value="{{ old('code') }}"/>
            <x-form.submit-button
                form="otpVerifyForm"
                icon="check"
                tag="Verify & Login"
            />
        </div>
    </div>
</form>
