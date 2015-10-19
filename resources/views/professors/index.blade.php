@extends('master')
@section('content')
<h1>Profesores</h1>
<table class = "table table-hover">
	<thead>
		<th>Nombre</th>
		<th>Tipo</th>
		<th>Rut</th>
		<th>Carga Anual</th>
		<th>Carga mínima</th>
		<th>Carga Máxima</th>
		<th>Acciones</th>
	</thead>
	@foreach($professors as $professor)
		<tr>
			<td>{{$professor->name}}</td>
			<td>{{$professor->type}}</td>
			<td>{{$professor->rut}}</td>
			<td>{{$professor->annual_load}}</td>
			<td>{{$professor->min_load}}</td>
			<td>{{$professor->max_load}}</td>
			<td class="text-right">
					<a class="btn btn-xs btn-primary" href="{{ route('professors.show', $professor->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
					<a class="btn btn-xs btn-warning" href="{{ route('professors.edit', $professor->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
					<form action="{{ route('professors.destroy', $professor->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
					</form>
			</td>
		</tr>

	@endforeach
</table>
<a href="/professors/create" class ="btn btn-success"> Registrar Profesor </a>
@stop
