@if($user->isActive())
    <x-ui.icon icon="user-check" width="w-8"/>
@endif
@if($user->isInactive())
    <x-ui.icon icon="user-cross" width="w-8"/>
@endif
@if($user->isBlocked())
    <x-ui.icon icon="user-block" width="w-8"/>
@endif
