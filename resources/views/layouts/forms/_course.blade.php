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
	{!! Form::label('area_id', 'Área') !!}
	{!! Form::select('area_id', $areas ,  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('load', 'Carga') !!}
	{!! Form::input('number', 'load', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('schedule', 'Horario') !!}
	{!! Form::input('text', 'load', null, ['class' => 'form-control', 'placeholder' => 'L1-J1-W3']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
