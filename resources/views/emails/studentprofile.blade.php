@component('mail::message')
# Hello Mohamed

Your Profile Was Updated .

@component('mail::button', ['url' => ''])
Check Your Profile Settings
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
