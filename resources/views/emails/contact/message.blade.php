@component('mail::message')
# {{ config('app.name') }} - {{ __('Contact request') }}

{{ __('A new message has been sent from the website!') }}

## {{ __('Information') }}

- {{ __('Name') }}: **{{ $name }}**
- {{ __('Email') }}: **{{ $email }}**

## {{ __('Message') }}
> {{ $message }}
@endcomponent