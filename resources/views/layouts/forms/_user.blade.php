<div class="form-group">
	{!! Form::label('email', 'Email') !!}
	{!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('name', 'Nombre') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('password','Contraseña') !!}
	{!! Form::input('password','password', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('password_confirmation','Repetición Contraseña') !!}
	{!! Form::input('password','password_confirmation', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('role_id', 'Rol') !!}
	{!! Form::select('role_id', $roles , null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
