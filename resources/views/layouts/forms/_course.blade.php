<div class="form-group">
	{!! Form::label('area_id', 'Área') !!}
	{!! Form::select('area_id', $areas ,  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('code','Código') !!}
	{!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('name', 'Nombre') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
	{!! Form::label('section', 'Sección') !!}
	{!! Form::text('section', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('semester', 'Período Académico') !!}

	<div class="row">

		<div class="col-md-6">
				{!! Form::select('semester', ['1' => 'Primer Semestre', '2' => 'Segundo Semestre'],  null, ['class' => 'form-control']) !!}
		</div>

		<div class="col-md-6">
					{!! Form::selectRange('year', 2010, 2100, null ,['class' => 'form-control']) !!}
		</div>

	</div>
</div>

<div class="form-group">
	{!! Form::label('load', 'Carga') !!}
	{!! Form::input('number', 'load', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('branch', 'Sede') !!}
	{!! Form::select('branch', array('santiago' => 'Santiago', 'viña' => 'Viña del Mar'),  null, ['class' => 'form-control']);!!}

</div>


<div class="form-group">
	{!! Form::label('schedule', 'Horario') !!}
	{!! Form::input('text', 'schedule', null, ['class' => 'form-control', 'placeholder' => 'L1-J1-W3']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
