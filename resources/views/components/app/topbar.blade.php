<div class="frowb relative z-50 w-full gap-2 py-2 pb-6 print:hidden">
    <x-app.logo :$href/>
    <div class="w-full frowe gap-2 group">
        {{--        <div class="hidden frowe gap-2 group-hover:flex">--}}
        {{--            <x-form.ahref--}}
        {{--                icon="user"--}}
        {{--                :href="route('users.profile')"--}}
        {{--                width="w-12"--}}
        {{--            />--}}
        {{--            <x-form.ahref--}}
        {{--                icon="pass"--}}
        {{--                :href="route('users.password')"--}}
        {{--                width="w-12"--}}
        {{--            />--}}
        {{--            @can('admin', cusr())--}}
        {{--                <x-form.ahref--}}
        {{--                    icon="users"--}}
        {{--                    :href="route('users.index')"--}}
        {{--                    width="w-12"--}}
        {{--                />--}}
        {{--            @endcan--}}
        {{--        </div>--}}
        <form id="logoutform" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="submit-button glass buttonhover" id="sbtn-logoutform" form="logoutform" type="submit"
                    value="Submit">
                <x-ui.icon icon="logout"/>
            </button>
        </form>
    </div>
</div>
