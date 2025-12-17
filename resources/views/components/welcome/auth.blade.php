@if (Route::has('login'))
    @auth
        <x-form.ahref
            icon="dashboard"
            :href="route('dashboard')"
        />
    @else
        <x-form.ahref
            icon="login"
            :href="route('login')"
        />
        @if (Route::has('register'))
            <x-form.ahref
                icon="register"
                :href="route('register')"
            />
        @endif
    @endauth
@endif
