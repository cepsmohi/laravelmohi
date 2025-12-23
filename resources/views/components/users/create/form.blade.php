<x-form.form-create
    wiresubmit="createUser"
    formId="createUserForm"
    :submitCondi="true"
    submitIcon="plus"
    submitTag="Create"
>
    <x-form.inputwire
        name="name"
        placeholder="User name"
        icon="user"
        autocomplete="name"
    />
    <x-form.inputwire
        name="email"
        placeholder="Email address"
        icon="mail"
        hints="username@domain.com"
        autocomplete="email"
    />
    <x-form.inputwire
        name="phone"
        placeholder="Phone number"
        icon="phone"
        hints="01xxxxxxxx"
    />
</x-form.form-create>
