@component('mail::message')
    Reset Password

Use This Code To Reset Your Password ( {{$user->code}} )


Thanks,<br>
{{ config('app.name') }}
@endcomponent
