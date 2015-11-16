@extends('master')
@section('content')
<h1>Usuarios</h1>
<table class = "table table-hover">
	<thead>
		<th>Nombre</th>
		<th>Rol</th>
		<th>Email</th>
		<th>Acciones</th>
	</thead>
	@forelse($users as $user)
		<tr>
			<td>{{$user->name}}</td>
			<td>{{$user->type}}</td>
			<td>{{$user->email}}</td>
			<td class="text-right">
				{!! Html::actions($user->id) !!}
			</td>
		</tr>
	@empty
	<tr>
		<td>Aún no hay usuarios</td>
  </tr>
	@endforelse
</table>
<a href="/users/create" class ="btn btn-success"> Registrar Usuarios </a>


@stop
