@extends('master')
@section('content')
	<h1> Editar Usuario </h1>

  {!! Form::model($user, ['method' => 'PATCH' , 'route' => ['users.update', $user->id] ]) !!}
		@include('layouts.forms._user',['submitButtonText' => 'Editar Nuevo Usuario'])
	{!! Form::close() !!}

@stop
