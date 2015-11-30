@extends('master')
@section('content')
<h1>Dashboard</h1>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#Courses">Cursos</a></li>
  <li><a data-toggle="tab" href="#Professors">Profesores</a></li>
</ul>
<div class="tab-content">
  <div id="Courses" class="tab-pane fade in active">
    <br>
    <ul class="nav nav-pills">
     <li class="active"><a data-toggle="pill" href="#unasigned">Sin Asignar</a></li>
     <li><a data-toggle="pill" href="#asigned">Asignados</a></li>
    </ul>

    <div class="tab-content well">
     <div id="unasigned" class="tab-pane fade in active">
       <h3>Cursos sin Asignar</h3>
       @include('layouts.tables._schedules', ['id' => 'dataTable', 'courses' => $unasigned_courses])
     </div>
     <div id="asigned" class="tab-pane fade">
       <h3>Cursos Asignados</h3>
       @include('layouts.tables._schedules', ['id' => 'dataTable1', 'courses' => $asigned_courses])
     </div>
    </div>
  </div>
  <div id="Professors" class="tab-pane fade">
    <br>
    <ul class="nav nav-pills">
     <li class="active"><a data-toggle="pill" href="#all">Todos</a></li>
     <li><a data-toggle="pill" href="#HORA">Hora</a></li>
     <li><a data-toggle="pill" href="#Administrativo">Administrativo-docente</a></li>
     <li><a data-toggle="pill" href="#Instructor">Instructor</a></li>
     <li><a data-toggle="pill" href="#Regular">Regular</a></li>
    </ul>

    <div class="tab-content well">
     <div id="all" class="tab-pane fade in active">
       <h3>Todos los profesores</h3>
       @include('layouts.tables._schedulesProfessor', ['id' => 'dataTable2'])
     </div>
     <div id="HORA" class="tab-pane fade">
       <h3>Profesores Hora</h3>
       @include('layouts.tables._schedulesProfessor', ['id' => 'dataTable3'])
     </div>
     <div id="Administrativo" class="tab-pane fade">
       <h3>Profesores Administrativo-docente</h3>
       @include('layouts.tables._schedulesProfessor', ['id' => 'dataTable4'])
     </div>
     <div id="Instructor" class="tab-pane fade">
       <h3>Profesores Instructores</h3>
       @include('layouts.tables._schedulesProfessor', ['id' => 'dataTable5'])
     </div>
     <div id="Regular" class="tab-pane fade">
       <h3>Profesores Regulares</h3>
       @include('layouts.tables._schedulesProfessor', ['id' => 'dataTable6'])
     </div>
    </div>
  </div>
</div>

@stop
