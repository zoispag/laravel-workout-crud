@component('mail::message')

# Your assigned plan has been deleted.

@component('mail::button', ['url' => ''])
Visit Workout CRUD
@endcomponent

Thanks,<br />
{{ config('app.name') }}
@endcomponent
