<div class="form-group">
	{!! Form::label('name', 'Nombre') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('code','Código') !!}
	{!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('section', 'Sección') !!}
	{!! Form::text('section', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('branch', 'Sucursal') !!}
	{!! Form::text('branch', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('semester', 'Semestre') !!}
	{!! Form::text('semester', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('year', 'Año') !!}
	{!! Form::input('number', 'year', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('schedule', 'Horario') !!}
	{!! Form::text('schedule', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('area', 'Area') !!}
	{!! Form::text('area', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
