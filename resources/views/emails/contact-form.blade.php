@component('mail::message')

<strong>Ime i Prezime</strong>

{{ $name }}
<br>
<strong>Email</strong>

{{ $mail }}

<strong>Vaša poruka</strong>

{{ $text }}

@endcomponent
