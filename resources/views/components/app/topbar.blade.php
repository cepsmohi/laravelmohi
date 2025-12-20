<div class="frowb relative z-50 w-full gap-2 py-2 pb-4 print:hidden">
    <x-app.logo :$href/>
    <div class="p-2 w-full frowe gap-2 group">
        <form id="logoutform" action="{{ route('logout') }}" method="POST">
            @csrf
            <x-form.submit-button
                form="logoutform"
                icon="logout"
            />
        </form>
    </div>
</div>
