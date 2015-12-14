<div class="form-group col-md-12 ">
	{!! Form::label('rut','RUT') !!}
	{!! Form::text('rut', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-12 ">
	{!! Form::label('name', 'Nombre Completo') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-12 ">
	{!! Form::label('type','Categoria') !!}
	{!! Form::select('type', array('Hora' => 'Hora', 'Instructor' => 'Instructor', 'Regular' => 'Regular', 'Administrativo-docente' => 'Administrativo-docente'),  null, ['class' => 'form-control']);!!}

</div>

<div class="form-group col-md-12 ">
	{!! Form::label('sede_origen','Sede de Origen') !!}
	{!! Form::select('sede_origen', array('Santiago' => 'Santiago', 'Viña del Mar' => 'Viña del Mar'),  null, ['class' => 'form-control']);!!}
</div>

<div class="form-group col-md-6">

	<div class="form-group col-md-4">
		{!! Form::label('min_load', 'Carga Docente Mínima') !!}
		{!! Form::input('number','min_load', null, ['class' => 'form-control',  'step' => 'any']) !!}
	</div>

	<div class="form-group col-md-4">
		{!! Form::label('max_load', 'Carga Docente Máxima') !!}
		{!! Form::input('number','max_load', null, ['class' => 'form-control',  'step' => 'any' ]) !!}
	</div>
</div>
<div class="form-group col-md-12 text-centered" data-toggle="buttons">
	{!! Form::label('areas', 'Áreas del profesor') !!}
	<br>

	@foreach($areas as $area)
		@if(isset($professor) && in_array($area->id, $professor->getAreas()))
			<label class="btn btn-primary active">
			{!! Form::checkbox('area[]', $area->id, true) !!}
		@else
			<label class="btn btn-primary">
			{!! Form::checkbox('area[]', $area->id) !!}
		@endif

			<span class="glyphicon glyphicon-ok"></span>
			{{$area->complete_name}}
			</label>
	@endforeach
</div>


<div class="form-group col-md-12 ">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
