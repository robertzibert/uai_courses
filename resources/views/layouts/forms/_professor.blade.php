<div class="form-group">
	{!! Form::label('name', 'Nombre') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('type','Tipo') !!}
	{!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('rut','RUT') !!}
	{!! Form::text('rut', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-4">
	{!! Form::label('annual_load','Carga Anual') !!}
	{!! Form::input('number','annual_load', null, ['class' => 'form-control',  'step' => 'any']) !!}
</div>

<div class="form-group col-md-4">
	{!! Form::label('min_load', 'Carga Mínima') !!}
	{!! Form::input('number','min_load', null, ['class' => 'form-control',  'step' => 'any']) !!}
</div>

<div class="form-group col-md-4">
	{!! Form::label('max_load', 'Carga Máxima') !!}
	{!! Form::input('number','max_load', null, ['class' => 'form-control',  'step' => 'any' ]) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
