<x-navigation-alert-banner color="red">
    {{__('Currently impersonating :user', ['user' => auth()->user()->name])}}&nbsp;
    <x-slot:link href="{{ route('impersonate.leave', ['impersonate' => get_impersonate_session_value()]) }}">
        {{__('Back to your profile')}}
    </x-slot:link>
</x-navigation-alert-banner>
