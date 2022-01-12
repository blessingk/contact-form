@component('mail::message')
Dear {{ $contact->name }}

A new contact has been created. Please click the button below for more details.

@component('mail::button', ['url' => url("contacts/show/$contact->id")])
View Contact
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
