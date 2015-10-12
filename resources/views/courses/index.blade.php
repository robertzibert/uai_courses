@extends('master')
@section('content')
<h1>Cursos</h1>
<table class = "table">
	<th>Nombre</th>
	<th>Código</th>
	<th>Sección</th>
	<th>Semestre</th>
	<th>Sucursal</th>
	<th>Carga</th>
	<th>Horario</th>
	@foreach($courses as $course)

		<tr>
			<td>{{$course->name}}</td>
			<td>{{$course->code}}</td>
			<td>{{$course->section}}</td>
			<td>{{$course->semester}}</td>
			<td>{{$course->branch}}</td>
			<td>{{$course->load}}</td>
			<td>{{$course->schedule}}</td>
		</tr>

	@endforeach
</table>
<a href="/courses/create" class ="btn btn-success"> Crear Curso </a>
@stop
