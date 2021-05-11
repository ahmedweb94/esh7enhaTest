@component('mail::message')
# Contact Us From {{$contact->name}} Email: {{$contact->email}} Mobile: {{$contact->mobile}}

<h3>{{$contact->title}}</h3>
{{ $contact->message }}<br><br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
