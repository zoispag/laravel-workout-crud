@component('mail::message')

# {{ $main }}

@if($reason != '')
Reason:
    @component('mail::panel', ['url' => ''])
    {{ $reason }}
    @endcomponent
@endif

@component('mail::button', ['url' => ''])
    View your plan
@endcomponent

Thanks,<br />
{{ config('app.name') }}
@endcomponent
