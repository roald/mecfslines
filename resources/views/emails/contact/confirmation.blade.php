@component('mail::message')
# {{  __('Contact request confirmation') }}

{{ __('Thank you for getting in touch with us!') }}

{{ __('You contacted us with the following information:') }}

- {{ __('Name') }}: **{{ $name }}**
- {{ __('Email') }}: **{{ $email }}**

### {{ __('Message') }}
> {{ $message }}

@component('mail::button', ['url' => route('web.home')])
{{ __('Go to') }} {{ config('app.name') }}
@endcomponent

{{ __('Thanks') }},<br>
{{ config('app.name') }}
@endcomponent
