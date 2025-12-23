<form
    method="POST"
    action="{{ route('otp.request') }}"
    id="otpRequestForm"
>
    <div class="-mt-12 fcol">
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-3xl shadow">
            <div class="mb-2 title text-grad">Request OTP</div>
            @csrf
            <x-form.input
                name="identifier"
                icon="mail"
                placeholder="email@example.com"
                value="{{ old('identifier') }}"
            />
            <x-form.submit-button
                form="otpRequestForm"
                icon="send"
                tag="Send OTP"
            />
        </div>
    </div>
</form>
