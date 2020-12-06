{{--@formatter:off--}}
@component('mail::message')
# {{ __('Hello') }} {{ $user->firstname ?? null }}

{{ __('back.users.new_user_notification.opened_account_on') }} {{ config('app.name') }}.<br>
{{ __('back.users.new_user_notification.random_password_warning') }}

{{ __('back.users.new_user_notification.login_with') }}
* {{ __('Username') }} : {{ $user->username }}
* {{ __('E-Mail Address') }} : {{ $user->email }}
* {{ __('Password') }} : {{ $password }}
@endcomponent
{{--@formatter:on--}}
