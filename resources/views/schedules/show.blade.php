@extends('master')
@section('header')
<div class="row">
	<div class="col-md-12">
		<h1>Asignación de horario para profesores</h1>
	</div>
</div>
</hr>
@endsection

@section('content')
    
    <style type="text/css">
    @foreach($arrayCourses as $course)
        @foreach($course['schedule'] as $horario)
            #{{$horario}} {
            background-color: lightblue;
            }
        @endforeach
    @endforeach
    </style>
    @if($errors->has())
       @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            Error: {{ $error }}
        </div>
      @endforeach
    @endif
    <div class="row">

        <div class="col-md-3">
            <div class="form-group">
            <h4>
                <p><b>Nombre</b>: {{$professor->name}}</p>
                <p><b>Tipo</b>: {{$professor->type}}</p>
                <p><b>RUT</b>: {{$professor->rut}}</p>
                <p><b>Carga Maxima</b>: {{$professor->max_load}}</p>
                <p><b>Carga Minima</b>: {{$professor->min_load}}</p>
                <p><b>Carga Actual</b>: {{$professorLoad}}</p>
            </h4>
            </div>
        
     <ul class="nav nav-pills nav-stacked">

    <li class="active"><a>Cursos</a></li>
     @foreach($arrayCourses as $course)
        <li><a><table><tr><td width="80%">{{$course['code']."-".$course['section']}}</td>
        @if($course['area']==$area)
        <td>
            {!! Form::open(['route' => ['destroyroute', $course['id'],$area,$professor->id], 'method' => 'delete', 'class'=>'form-inline']) !!}
                <button type="submit" class="btn btn-default btn-xs">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            {!! Form::close() !!}
        </td>
        @endif
        </tr></table></a></li>
     @endforeach
</ul>
        </div>
        <div class="col-md-9">

            <form action="#">
                {!! Form::select('professor', $arrayProfessors,$professor->id,['class' => 'form-control', 'id'=>'professorSelect',"onChange"=>"top.location.href=this.options[this.selectedIndex].value;"])!!}
                <br>
            </form>
       
            <div class="table">
                <table class="table" border=1>
                  <tr>
                    <td></td>
                    <td>L</td> 
                    <td>M</td>
                    <td>W</td>
                    <td>J</td> 
                    <td>V</td>
                  </tr>
                  <tr>
                    <td>1A</td>
                    <td align="center" width="18%" id="L1A">{{ (isset($array["L1A"]))?$array["L1A"]:"" }}</td> 
                    <td align="center" width="18%" id="M1A">{{ (isset($array["M1A"]))?$array["M1A"]:"" }}</td>
                    <td align="center" width="18%" id="W1A">{{ (isset($array["W1A"]))?$array["W1A"]:"" }}</td>
                    <td align="center" width="18%" id="J1A">{{ (isset($array["J1A"]))?$array["J1A"]:"" }}</td> 
                    <td align="center" width="18%" id="V1A">{{ (isset($array["V1A"]))?$array["V1A"]:"" }}</td>
                  </tr>
                  <tr>
                    <td>1B</td>
                    <td align="center" width="18%" id="L1B">{{ (isset($array["L1B"]))?$array["L1B"]:"" }}</td> 
                    <td align="center" width="18%" id="M1B">{{ (isset($array["M1B"]))?$array["M1B"]:"" }}</td>
                    <td align="center" width="18%" id="W1B">{{ (isset($array["W1B"]))?$array["W1B"]:"" }}</td>
                    <td align="center" width="18%" id="J1B">{{ (isset($array["J1B"]))?$array["J1B"]:"" }}</td> 
                    <td align="center" width="18%" id="V1B">{{ (isset($array["V1B"]))?$array["V1B"]:"" }}</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td align="center" width="18%" id="L2">{{ (isset($array["L2"]))?$array["L2"]:"" }}</td> 
                    <td align="center" width="18%" id="M2">{{ (isset($array["M2"]))?$array["M2"]:"" }}</td>
                    <td align="center" width="18%" id="W2">{{ (isset($array["W2"]))?$array["W2"]:"" }}</td>
                    <td align="center" width="18%" id="J2">{{ (isset($array["J2"]))?$array["J2"]:"" }}</td> 
                    <td align="center" width="18%" id="V2">{{ (isset($array["V2"]))?$array["V2"]:"" }}</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td align="center" width="18%" id="L3">{{ (isset($array["L3"]))?$array["L3"]:"" }}</td> 
                    <td align="center" width="18%" id="M3">{{ (isset($array["M3"]))?$array["M3"]:"" }}</td>
                    <td align="center" width="18%" id="W3">{{ (isset($array["W3"]))?$array["W3"]:"" }}</td>
                    <td align="center" width="18%" id="J3">{{ (isset($array["J3"]))?$array["J3"]:"" }}</td> 
                    <td align="center" width="18%" id="V3">{{ (isset($array["V3"]))?$array["V3"]:"" }}</td>
                  </tr>
                  <tr>
                    <td>4A</td>
                    <td align="center" width="18%" id="L4A">{{ (isset($array["L4A"]))?$array["L4A"]:"" }}</td> 
                    <td align="center" width="18%" id="M4A">{{ (isset($array["M4A"]))?$array["M4A"]:"" }}</td>
                    <td align="center" width="18%" id="W4A">{{ (isset($array["W4A"]))?$array["W4A"]:"" }}</td>
                    <td align="center" width="18%" id="J4A">{{ (isset($array["J4A"]))?$array["J4A"]:"" }}</td> 
                    <td align="center" width="18%" id="V4A">{{ (isset($array["V4A"]))?$array["V4A"]:"" }}</td>
                  </tr>
                  <tr>
                    <td>4B</td>
                    <td align="center" width="18%" id="L4B">{{ (isset($array["L4B"]))?$array["L4B"]:"" }}</td> 
                    <td align="center" width="18%" id="M4B">{{ (isset($array["M4B"]))?$array["M4B"]:"" }}</td>
                    <td align="center" width="18%" id="W4B">{{ (isset($array["W4B"]))?$array["W4B"]:"" }}</td>
                    <td align="center" width="18%" id="J4B">{{ (isset($array["J4B"]))?$array["J4B"]:"" }}</td> 
                    <td align="center" width="18%" id="V4B">{{ (isset($array["V4B"]))?$array["V4B"]:"" }}</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td align="center" width="18%" id="L5">{{ (isset($array["L5"]))?$array["L5"]:"" }}</td>
                    <td align="center" width="18%" id="M5">{{ (isset($array["M5"]))?$array["M5"]:"" }}</td> 
                    <td align="center" width="18%" id="W5">{{ (isset($array["W5"]))?$array["W5"]:"" }}</td>
                    <td align="center" width="18%" id="J5">{{ (isset($array["J5"]))?$array["J5"]:"" }}</td>
                    <td align="center" width="18%" id="V5">{{ (isset($array["V5"]))?$array["V5"]:"" }}</td> 
                  </tr>
                  <tr>
                    <td>6</td>
                    <td align="center" width="18%" id="L6">{{ (isset($array["L6"]))?$array["L6"]:"" }}</td> 
                    <td align="center" width="18%" id="M6">{{ (isset($array["M6"]))?$array["M6"]:"" }}</td>
                    <td align="center" width="18%" id="W6">{{ (isset($array["W6"]))?$array["W6"]:"" }}</td>
                    <td align="center" width="18%" id="J6">{{ (isset($array["J6"]))?$array["J6"]:"" }}</td> 
                    <td align="center" width="18%" id="V6">{{ (isset($array["V6"]))?$array["V6"]:"" }}</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td align="center" width="18%" id="L7">{{ (isset($array["L7"]))?$array["L7"]:"" }}</td> 
                    <td align="center" width="18%" id="M7">{{ (isset($array["M7"]))?$array["M7"]:"" }}</td>
                    <td align="center" width="18%" id="W7">{{ (isset($array["W7"]))?$array["W7"]:"" }}</td>
                    <td align="center" width="18%" id="J7">{{ (isset($array["J7"]))?$array["J7"]:"" }}</td> 
                    <td align="center" width="18%" id="V7">{{ (isset($array["V7"]))?$array["V7"]:"" }}</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td align="center" width="18%" id="L8">{{ (isset($array["L8"]))?$array["L8"]:"" }}</td> 
                    <td align="center" width="18%" id="M8">{{ (isset($array["M8"]))?$array["M8"]:"" }}</td>
                    <td align="center" width="18%" id="W8">{{ (isset($array["W8"]))?$array["W8"]:"" }}</td>
                    <td align="center" width="18%" id="J8">{{ (isset($array["J8"]))?$array["J8"]:"" }}</td> 
                    <td align="center" width="18%" id="V8">{{ (isset($array["V8"]))?$array["V8"]:"" }}</td>
                  </tr>
                </table>
            </div>
            @if($courseSelect!=array())
            {!! Form::open(['url'=>'schedules'])!!}
                <input type="hidden" name="professor" value={{$professor->id}}>
                <input type="hidden" name="area" value={{$area}}>
            <table class="table" border=0>
            <tr><td>
            {!! Form::select('course', $courseSelect,current($courseSelect),['class' => 'form-control', 'id'=>'courseSelect'])!!}
            </td><td>
                <button type="submit" class="btn btn-default btn-s">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Agregar Curso
                </button>
            {!! Form::close() !!}
            </td></tr>
            </table>
            @else
            No se encontraron cursos disponibles para agregar.
            @endif
        </div>
    </div>

@endsection
