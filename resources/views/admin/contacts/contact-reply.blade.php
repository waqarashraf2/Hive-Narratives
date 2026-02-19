@component('mail::message')
# Hello {{ $name }},

Thank you for contacting us. Here's our reply to your message:

@component('mail::panel')
{{ $replyMessage }}
@endcomponent

Best regards,  
{{ config('app.name') }}
@endcomponent