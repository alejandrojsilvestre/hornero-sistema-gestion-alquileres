@component('mail::message')

{{ $data['message'] }}


Gracias por confiar en nosotros,<br>
{{ $data['company'] }}
@endcomponent