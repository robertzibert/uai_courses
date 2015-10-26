@extends('master')
@section('header')
<div class="row">
	<div class="col-md-12">
		<h1>Profesores / Show #{{$professor->id}}</h1>
		<form action="{{ route('professors.destroy', $professor->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
				<input type="hidden" name="_method" value="DELETE">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="btn-group pull-right" role="group" aria-label="...">
						<a class="btn btn-warning btn-group" role="group" href="{{ route('professors.edit', $professor->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
                     <label for="title">Nombre</label>
                     <p class="form-control-static">{{$professor->name}}</p>
                </div>
                    <div class="form-group">
                     <label for="body">Tipo</label>
                     <p class="form-control-static">{{$professor->type}}</p>
                </div>
								<div class="form-group">
								 <label for="body">RUT</label>
								 <p class="form-control-static">{{$professor->rut}}</p>
						</div>
            </form>

            <a class="btn btn-default" href="{{ route('professors.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>

        </div>
    </div>

@endsection
