@extends('layouts.reportes.pdf')
@section('title')
	Caja Diaria
@endsection()
@section('content')
	<table>
		<thead>
			<tr>
				<th>campo 1</th>
				<th>campo 2</th>
				<th class="taright">campo 3</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>dato 1</td>
				<td>dato 2</td>
				<td class="taright">dato 3</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3" class="taright">Total: $0000</td>
			</tr>
		</tfoot>
@endsection()
	</table>