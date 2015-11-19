<div class="form-group col-md-12 ">
	{!! Form::label('name', 'Nombre') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-12 ">
	{!! Form::label('type','Tipo') !!}
	{!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-12 ">
	{!! Form::label('rut','RUT') !!}
	{!! Form::text('rut', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-12 ">
	{!! Form::label('sede_origen','Sede de Origen') !!}
	{!! Form::text('sede_origen', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-4">
	{!! Form::label('min_load', 'Carga Mínima') !!}
	{!! Form::input('number','min_load', null, ['class' => 'form-control',  'step' => 'any']) !!}
</div>

<div class="form-group col-md-4">
	{!! Form::label('max_load', 'Carga Máxima') !!}
	{!! Form::input('number','max_load', null, ['class' => 'form-control',  'step' => 'any' ]) !!}
</div>

<div class="form-group col-md-12 text-centered" data-toggle="buttons">
	{!! Form::label('areas', 'Areas del profesor') !!}
	<br>
		@foreach($areas as $area)
			@if(isset($professor) && in_array($area->id, $professor->getAreas()))
				<label class="btn btn-primary active">
			@else
				<label class="btn btn-primary">
			@endif

					 {!! Form::checkbox('area[]', $area->id) !!}
					<span class="glyphicon glyphicon-ok"></span>
					{{$area->name}}
				</label>

		@endforeach



</div>



<div class="form-group col-md-12 ">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
