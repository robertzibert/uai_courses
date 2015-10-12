@extends('master')
@section('content')
	<h1> Crear Curso </h1>

	{!! Form::open(['method' => 'POST' , 'route' => 'courses.store']) !!}
		@include('layouts.forms._course',['submitButtonText' => 'Agregar Nuevo Curso'])
	{!! Form::close() !!}

@stop
