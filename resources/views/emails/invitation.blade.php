@component('mail::message')
# {{  __('Invitation to create user') }}

{{ __('You have been invited to create an user account on') }} {{ config('app.name') }}.

{{ __('The invitation link is valid for only 1 week.') }}

@component('mail::button', ['url' => $signedUrl ])
{{ __('Accept invitation') }}
@endcomponent

{{ __('If the link has expired, please contact us for a new invitation link.') }}

{{ __('Thanks') }},<br>
{{ $sender }}
@endcomponent
