@extends('master')
@section('content')
	<h1> Registrar Usuario </h1>

	{!! Form::open(['method' => 'POST' , 'route' => 'users.store']) !!}
		@include('layouts.forms._user',['submitButtonText' => 'Agregar Nuevo Usuario'])
	{!! Form::close() !!}

@stop
