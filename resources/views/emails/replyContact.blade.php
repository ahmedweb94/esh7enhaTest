@component('mail::message')
# Replying To Your Message ( {{$contact->title}} )

{!! $contact->reply !!}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
