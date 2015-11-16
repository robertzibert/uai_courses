@extends('master')
@section('header')
<div class="row">
	<div class="col-md-12">
		<h1>Cursos / Show #{{$course->id}}</h1>
		<form action="{{ route('professors.destroy', $course->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
				<input type="hidden" name="_method" value="DELETE">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="btn-group pull-right" role="group" aria-label="...">
						<a class="btn btn-warning btn-group" role="group" href="{{ route('professors.edit', $course->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
						<button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>
					</div>
				</form>
			</div>
    </div>
</hr>
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12">

            <form action="#">
              <div class="form-group">
                  <label for="name">Nombre</label>
                  <p class="form-control-static">{{$course->name}}</p>
                </div>
                <div class="form-group">
                  <label for="code">Código</label>
                  <p class="form-control-static">{{$course->code}}</p>
                </div>
                <div class="form-group">
                  <label for="section">Sección</label>
                  <p class="form-control-static">{{$course->section}}</p>
                </div>
                <div class="form-group">
                  <label for="branch">Sucursal</label>
                  <p class="form-control-static">{{$course->branch}}</p>
                </div>
                <div class="form-group">
                  <label for="semester">Semestre</label>
                  <p class="form-control-static">{{$course->semester}}</p>
                </div>
                <div class="form-group">
                  <label for="number">Carga</label>
                  <p class="form-control-static">{{$course->load}}</p>
                </div>

            </form>

            <a class="btn btn-default" href="{{ route('professors.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>

        </div>
    </div>

@endsection
