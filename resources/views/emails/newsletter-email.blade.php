@component('mail::message')
# Hello,
<br>
{{ $message }} 
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent