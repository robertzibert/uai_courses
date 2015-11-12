@extends('master')
@section('content')
	<h1>Editar Datos del Profesor: {{$professor->name}}</h1>
	{!! Form::model($professor, ['method' => 'PATCH' , 'route' => ['professors.update', $professor->id] ]) !!}
		@include('layouts.forms._professor',['submitButtonText' => 'Edit professor'])
	{!! Form::close() !!}

@stop
