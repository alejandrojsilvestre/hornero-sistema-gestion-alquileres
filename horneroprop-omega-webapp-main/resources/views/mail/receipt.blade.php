@component('mail::message')

{{ $data['message'] }}


@component('mail::button', ['url' => $data['link']])
Decargar
@endcomponent

Gracias por confiar en nosotros,<br>
{{ $data['company'] }}
@endcomponent