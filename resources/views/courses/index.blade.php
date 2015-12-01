@extends('master')
@section('content')
<h1>Cursos</h1>
<table class = "table table-hover" id = "dataTable">
	<thead>
		<th>Area</th>
		<th>Código</th>
		<th>Nombre</th>
		<th>Sección</th>
		<th>Semestre</th>
		<th>Año</th>
		<th>Sucursal</th>
		<th>Horario</th>

		@if(Auth::user()->role()->first()->name == "Administrador")
		<th>Acciones</th>
		@endif
	</thead>
	@foreach($courses as $course)

		<tr>
			<td>{{$course->area()->first()->name}}</td>
			<td>{{$course->code}}</td>
			<td>{{$course->name}}</td>
			<td>{{$course->section}}</td>
			<td>{{$course->semester}}</td>
			<td>{{$course->year}}</td>
			<td>{{$course->branch}}</td>
			<td>{{$course->schedule}}</td>
			@if(Auth::user()->role()->first()->name == "Administrador")
			<td>{!! Html::actions($course->id) !!}</td>
			@endif

		</tr>

	@endforeach
</table>
@if(Auth::user()->role()->first()->name == "Administrador")
<a href="/courses/create" class ="btn btn-success"> Crear Curso </a>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Importar Excel
</button>

@include('layouts.modals._reports',['submitButtonText' => 'Importar Cursos', 'model' => 'courses', 'title' => 'Cursos'])
@endif
@stop
