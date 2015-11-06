@extends('master')
@section('content')
	<h1> Registrar Profesor </h1>

	{!! Form::open(['method' => 'POST' , 'route' => 'professors.store']) !!}
		@include('layouts.forms._professor',['submitButtonText' => 'Agregar Nuevo Profesor'])
	{!! Form::close() !!}

@stop
