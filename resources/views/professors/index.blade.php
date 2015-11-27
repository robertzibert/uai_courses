@extends('master')
@section('content')
<h1>Profesores</h1>
<table class = "table table-hover">
	<thead>
		<th>Nombre</th>
		<th>Tipo</th>
		<th>Rut</th>
		<th>Carga Anual</th>
		<th>Carga Máxima</th>
		<th>Sede de Origen</th>
		<th>Acciones</th>
	</thead>
	@forelse($professors as $professor)
		<tr>
			<td>{{$professor->name}}</td>
			<td>{{$professor->type}}</td>
			<td>{{$professor->rut}}</td>
			<td>{{$professor->min_load}}</td>
			<td>{{$professor->max_load}}</td>
			<td>{{$professor->sede_origen}}</td>
			<td class="text-right">
				{!! Html::actions($professor->id) !!}
			</td>
		</tr>
	@empty
	<tr>
		<td>Aún no hay profesores</td>
  </tr>
	@endforelse
</table>
<a href="/professors/create" class ="btn btn-success"> Registrar Profesor </a>


@stop
