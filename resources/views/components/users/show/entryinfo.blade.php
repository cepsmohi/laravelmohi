<div class="frows gap-2">
    <x-ui.icon icon="register" width="w-10"/>
    <div class="stitle">{{ $user->created_at->format('Y-m-d h:i:s a') }}</div>
</div>
<div class="frows gap-2">
    <x-ui.icon icon="edit" width="w-10"/>
    <div class="stitle">{{ $user->updated_at->format('Y-m-d h:i:s a') }}</div>
</div>
