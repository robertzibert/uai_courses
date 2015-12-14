@extends('master')
@section('content')
	<h1>Editar Curso</h1>
	{!! Form::model($course, ['method' => 'PATCH' , 'route' => ['courses.update', $course->id] ]) !!}
		@include('layouts.forms._course',['submitButtonText' => 'Editar Curso'])
	{!! Form::close() !!}

@stop
