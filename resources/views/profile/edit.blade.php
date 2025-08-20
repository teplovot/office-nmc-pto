@if(in_array(auth()->user()->role, ['manager', 'admin']))
    <x-manager.dashboard>
        @include('profile.partials.body-profile')
    </x-manager.dashboard>
@elseif(auth()->user()->role === 'methodist')
    <x-methodist.dashboard>
        @include('profile.partials.body-profile')
    </x-methodist.dashboard>
@endif
