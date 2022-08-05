@extends('layouts.reportes.pdf')
@section('title')
	Propietarios a pagar
@endsection()
@section('content')
<table>
		<thead>
			<tr>
				<th>Carpeta</th>
				<th>Direccion</th>
				<th>Inicio</th>
				<th>Fin</th>
				<th>Inquilinos</th>
				<th>Propietarios</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($data as $contrato)
				<tr>
					<td width="10%">{{ $contrato->carpeta }}</td>
					<td width="30%">{{ $contrato->inmueble->direccion }}</td>
					<td width="15%">{{ $contrato->inicio }}</td>
					<td width="15%">{{ $contrato->fin }}</td>
					<td width="15%">{{ $contrato->inquilinos->map(function($inquilino) {
								return $inquilino->getFullName().(($inquilino->nro_documento)?' ('.$inquilino->nro_documento.')':'');
							})->implode(', ') }}
					</td>
					<td width="15%">{{ $contrato->propietarios->map(function($propietario) {
								return $propietario->getFullName().(($propietario->nro_documento)?' ('.$propietario->nro_documento.')':'');
							})->implode(', ') }}
					</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6" class="taright">Total: {{ $data->count() }}</td>
			</tr>
		</tfoot>
	</table>
@endsection()