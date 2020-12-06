@component('mail::message')
**{{ __('front.contact.email.you_received_new_message') }}**

<p>
<b>{{ __('front.contact.email.user_name') }} :</b> {{ $content['name'] }}<br>
<b>{{ __('front.contact.email.user_email') }} :</b> {{ $content['email'] }}
</p>

<b>{{ __('front.contact.email.user_message') }} :</b><br>
{!! nl2br(e($content['message'])) !!}
@endcomponent
