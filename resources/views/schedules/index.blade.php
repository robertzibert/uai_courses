@extends('master')
@section('content')
<h1>Dashboard</h1>


 <ul class="nav nav-pills">
   <li class="active"><a data-toggle="pill" href="#unasigned">Sin Asignar</a></li>
   <li><a data-toggle="pill" href="#asigned">Asignados</a></li>
 </ul>

 <div class="tab-content well">
   <div id="unasigned" class="tab-pane fade in active">
     <h3>Cursos sin Asignar</h3>
     @include('layouts.tables._schedules', ['id' => 'dataTable'])
   </div>
   <div id="asigned" class="tab-pane fade">
     <h3>Cursos Asignados</h3>
     @include('layouts.tables._schedules', ['id' => 'dataTable1'])
   </div>
 </div>

@stop
