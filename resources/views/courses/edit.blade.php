@extends('master')
@section('content')
	<h1>Editar Datos del Profesor: {{$course->name}}</h1>
	{!! Form::model($course, ['method' => 'PATCH' , 'route' => ['courses.update', $course->id] ]) !!}
		@include('layouts.forms._course',['submitButtonText' => 'Edit course'])
	{!! Form::close() !!}

@stop
