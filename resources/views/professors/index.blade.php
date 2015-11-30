@extends('master')
@section('content')
<h1>Profesores</h1>
<table class = "table table-hover" id = "dataTable">
	<thead>
		<th>Rut</th>
		<th>Nombre</th>
		<th>Categoría</th>
		<th>Sede de Origen</th>
		<th>Carga Docente Mínima</th>
		<th>Carga Docente Máxima</th>
		<th>Acciones</th>
	</thead>
	@forelse($professors as $professor)
		<tr>
			<td>{{$professor->rut}}</td>
			<td>{{$professor->name}}</td>
			<td>{{$professor->type}}</td>
			<td>{{$professor->sede_origen}}</td>
			<td>{{$professor->min_load}}</td>
			<td>{{$professor->max_load}}</td>
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
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Importar Excel
</button>

@include('layouts.modals._reports',['submitButtonText' => 'Importar Profesores', 'model' => 'professors', 'title' => 'Profesores'])


@stop
