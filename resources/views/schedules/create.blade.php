@extends('master')
@section('header')
<div class="row">
	<div class="col-md-12">
		<h1>Asignación de curso para profesor {{$professor->name}}</h1>
	</div>
</div>
</hr>
@endsection

@section('content')

    <script type="text/javascript">

    $(function(){
    var select = $('#courseSelect');
    var selectval = select.val();
    var professorLoad = <?php echo $professorLoad;?>;
    var professorMaxLoad = <?php echo $professor->max_load;?>; 
    var arr = <?php echo json_encode($courseJson);?>;
    var max = 3;
        max = arr[selectval];
    select.change(function(){
        $('input:checkbox').removeAttr('checked');
        selectval=select.val();
        max = arr[selectval];
        checkboxes.change(); 
        if (max+professorLoad>professorMaxLoad) {
            checkboxes.prop('disabled',true);
        }
    });


    var checkboxes = $('input[type="checkbox"]');

    if (max+professorLoad>professorMaxLoad) {
        checkboxes.prop('disabled',true);
    }
    checkboxes.change(function(){
        var current = checkboxes.filter(':checked').length;
        if(current == max){
            document.getElementById("submitButton").disabled = false;
        }else{

            document.getElementById("submitButton").disabled = true;   
        }
        checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
            });
        });  


    function cbChangeL1(obj) {
        var cbs = document.getElementsByClassName("L1");
        var state = obj.checked;
        for (var i = 0; i < cbs.length; i++) {
            cbs[i].checked = false;
        }
        if(state == true){
        obj.checked = true;
        }else{

        obj.checked = false;
        }
    }
    function cbChangeM1(obj) {
        var cbs = document.getElementsByClassName("M1");
        var state = obj.checked;
        for (var i = 0; i < cbs.length; i++) {
            cbs[i].checked = false;
        }
        if(state == true){
        obj.checked = true;
        }else{

        obj.checked = false;
        }
    }
    function cbChangeW1(obj) {
        var cbs = document.getElementsByClassName("W1");
        var state = obj.checked;
        for (var i = 0; i < cbs.length; i++) {
            cbs[i].checked = false;
        }
        if(state == true){
        obj.checked = true;
        }else{

        obj.checked = false;
        }
    }
    function cbChangeJ1(obj) {
        var cbs = document.getElementsByClassName("J1");
        var state = obj.checked;
        for (var i = 0; i < cbs.length; i++) {
            cbs[i].checked = false;
        }
        if(state == true){
        obj.checked = true;
        }else{

        obj.checked = false;
        }
    }
    function cbChangeV1(obj) {
        var cbs = document.getElementsByClassName("V1");
        var state = obj.checked;
        for (var i = 0; i < cbs.length; i++) {
            cbs[i].checked = false;
        }
        if(state == true){
        obj.checked = true;
        }else{

        obj.checked = false;
        }
    }
    function cbChangeL4(obj) {
        var cbs = document.getElementsByClassName("L4");
        var state = obj.checked;
        for (var i = 0; i < cbs.length; i++) {
            cbs[i].checked = false;
        }
        if(state == true){
        obj.checked = true;
        }else{

        obj.checked = false;
        }
    }
    function cbChangeM4(obj) {
        var cbs = document.getElementsByClassName("M4");
        var state = obj.checked;
        for (var i = 0; i < cbs.length; i++) {
            cbs[i].checked = false;
        }
        if(state == true){
        obj.checked = true;
        }else{

        obj.checked = false;
        }
    }
    function cbChangeW4(obj) {
        var cbs = document.getElementsByClassName("W4");
        var state = obj.checked;
        for (var i = 0; i < cbs.length; i++) {
            cbs[i].checked = false;
        }
        if(state == true){
        obj.checked = true;
        }else{

        obj.checked = false;
        }
    }
    function cbChangeJ4(obj) {
        var cbs = document.getElementsByClassName("J4");
        var state = obj.checked;
        for (var i = 0; i < cbs.length; i++) {
            cbs[i].checked = false;
        }
        if(state == true){
        obj.checked = true;
        }else{

        obj.checked = false;
        }
    }
    function cbChangeV4(obj) {
        var cbs = document.getElementsByClassName("V4");
        var state = obj.checked;
        for (var i = 0; i < cbs.length; i++) {
            cbs[i].checked = false;
        }
        if(state == true){
        obj.checked = true;
        }else{

        obj.checked = false;
        }
    }

    </script>
        <div class="col-md-3">
            <div class="form-group">
            <h4>
                <p><b>Nombre</b>: {{$professor->name}}</p>
                <p><b>Tipo</b>: {{$professor->type}}</p>
                <p><b>RUT</b>: {{$professor->rut}}</p>
                <p><b>Carga Anual</b>: {{$professor->annual_load}}</p>
                <p><b>Carga Maxima</b>: {{$professor->max_load}}</p>
                <p><b>Carga Minima</b>: {{$professor->min_load}}</p>
                <p><b>Carga Actual</b>: {{$professorLoad}}</p>
            </h4>
            </div>
        
     <ul class="nav nav-pills nav-stacked">

    <li class="active"><a>Cursos</a></li>
     @foreach($arrayCourses as $course)
        <li><a>{{$course['code']}}</a></li>
     @endforeach
</ul>
        </div>
        <div class="col-md-9">
            <h2>Curso:</h2>
            {!! Form::open(['url'=>'schedules'])!!}
            <input type="hidden" name="professor" value={{$professor->id}}>
            <input type="hidden" name="area" value={{$area}}>
            {!! Form::select('course', $courseSelect,current($courseSelect),['class' => 'form-control', 'id'=>'courseSelect'])!!}
             <br>
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
                    <td align="center" width="18%" id="L1A">{!! (isset($array["L1A"]) || isset($array["L1B"]))?"Tope de horario":"<input class='L1' onchange='cbChangeL1(this)' type='checkbox' value='L1A' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="M1A">{!! (isset($array["M1A"]) || isset($array["M1B"]))?"Tope de horario":"<input class='M1' onchange='cbChangeM1(this)' type='checkbox' value='M1A' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="W1A">{!! (isset($array["W1A"]) || isset($array["W1B"]))?"Tope de horario":"<input class='W1' onchange='cbChangeW1(this)' type='checkbox' value='W1A' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="J1A">{!! (isset($array["J1A"]) || isset($array["J1B"]))?"Tope de horario":"<input class='J1' onchange='cbChangeJ1(this)' type='checkbox' value='J1A' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="V1A">{!! (isset($array["V1A"]) || isset($array["V1B"]))?"Tope de horario":"<input class='V1' onchange='cbChangeV1(this)' type='checkbox' value='V1A' name='schedules[]'>" !!}</td>
                  </tr>
                  <tr>
                    <td>1B</td>
                    <td align="center" width="18%" id="L1B">{!! (isset($array["L1B"]) || isset($array["L1A"]))?"Tope de horario":"<input class='L1' onchange='cbChangeL1(this)' type='checkbox' value='L1B' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="M1B">{!! (isset($array["M1B"]) || isset($array["M1A"]))?"Tope de horario":"<input class='M1' onchange='cbChangeM1(this)' type='checkbox' value='M1B' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="W1B">{!! (isset($array["W1B"]) || isset($array["W1A"]))?"Tope de horario":"<input class='W1' onchange='cbChangeW1(this)' type='checkbox' value='W1B' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="J1B">{!! (isset($array["J1B"]) || isset($array["J1A"]))?"Tope de horario":"<input class='J1' onchange='cbChangeJ1(this)' type='checkbox' value='J1B' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="V1B">{!! (isset($array["V1B"]) || isset($array["V1A"]))?"Tope de horario":"<input class='V1' onchange='cbChangeV1(this)' type='checkbox' value='V1B' name='schedules[]'>" !!}</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td align="center" width="18%" id="L2">{!! (isset($array["L2"]))?"Tope de horario":"<input type='checkbox' value='L2' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="M2">{!! (isset($array["M2"]))?"Tope de horario":"<input type='checkbox' value='M2' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="W2">{!! (isset($array["W2"]))?"Tope de horario":"<input type='checkbox' value='W2' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="J2">{!! (isset($array["J2"]))?"Tope de horario":"<input type='checkbox' value='J2' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="V2">{!! (isset($array["V2"]))?"Tope de horario":"<input type='checkbox' value='V2' name='schedules[]'>" !!}</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td align="center" width="18%" id="L3">{!! (isset($array["L3"]))?"Tope de horario":"<input type='checkbox' value='L3' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="M3">{!! (isset($array["M3"]))?"Tope de horario":"<input type='checkbox' value='M3' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="W3">{!! (isset($array["W3"]))?"Tope de horario":"<input type='checkbox' value='W3' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="J3">{!! (isset($array["J3"]))?"Tope de horario":"<input type='checkbox' value='J3' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="V3">{!! (isset($array["V3"]))?"Tope de horario":"<input type='checkbox' value='V3' name='schedules[]'>" !!}</td>
                  </tr>
                  <tr>
                    <td>4A</td>
                    <td align="center" width="18%" id="L4A">{!! (isset($array["L4A"]) || isset($array["L4B"]))?"Tope de horario":"<input class='L4' onchange='cbChangeL4(this)' type='checkbox' value='L4A' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="M4A">{!! (isset($array["M4A"]) || isset($array["M4B"]))?"Tope de horario":"<input class='M4' onchange='cbChangeM4(this)' type='checkbox' value='M4A' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="W4A">{!! (isset($array["W4A"]) || isset($array["W4B"]))?"Tope de horario":"<input class='W4' onchange='cbChangeW4(this)' type='checkbox' value='W4A' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="J4A">{!! (isset($array["J4A"]) || isset($array["J4B"]))?"Tope de horario":"<input class='J4' onchange='cbChangeJ4(this)' type='checkbox' value='J4A' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="V4A">{!! (isset($array["V4A"]) || isset($array["V4B"]))?"Tope de horario":"<input class='V4' onchange='cbChangeV4(this)' type='checkbox' value='V4A' name='schedules[]'>" !!}</td>
                  </tr>
                  <tr>
                    <td>4B</td>
                    <td align="center" width="18%" id="L4B">{!! (isset($array["L4B"]) || isset($array["L4A"]))?"Tope de horario":"<input class='L4' onchange='cbChangeL4(this)' type='checkbox' value='L4B' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="M4B">{!! (isset($array["M4B"]) || isset($array["M4A"]))?"Tope de horario":"<input class='M4' onchange='cbChangeM4(this)' type='checkbox' value='M4B' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="W4B">{!! (isset($array["W4B"]) || isset($array["W4A"]))?"Tope de horario":"<input class='W4' onchange='cbChangeW4(this)' type='checkbox' value='W4B' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="J4B">{!! (isset($array["J4B"]) || isset($array["J4A"]))?"Tope de horario":"<input class='J4' onchange='cbChangeJ4(this)' type='checkbox' value='J4B' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="V4B">{!! (isset($array["V4B"]) || isset($array["V4A"]))?"Tope de horario":"<input class='V4' onchange='cbChangeV4(this)' type='checkbox' value='V4B' name='schedules[]'>" !!}</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td align="center" width="18%" id="L5">{!! (isset($array["L5"]))?"Tope de horario":"<input type='checkbox' value='L5' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="M5">{!! (isset($array["M5"]))?"Tope de horario":"<input type='checkbox' value='M5' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="W5">{!! (isset($array["W5"]))?"Tope de horario":"<input type='checkbox' value='W5' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="J5">{!! (isset($array["J5"]))?"Tope de horario":"<input type='checkbox' value='J5' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="V5">{!! (isset($array["V5"]))?"Tope de horario":"<input type='checkbox' value='V5' name='schedules[]'>" !!}</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td align="center" width="18%" id="L6">{!! (isset($array["L6"]))?"Tope de horario":"<input type='checkbox' value='L6' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="M6">{!! (isset($array["M6"]))?"Tope de horario":"<input type='checkbox' value='M6' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="W6">{!! (isset($array["W6"]))?"Tope de horario":"<input type='checkbox' value='W6' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="J6">{!! (isset($array["J6"]))?"Tope de horario":"<input type='checkbox' value='J6' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="V6">{!! (isset($array["V6"]))?"Tope de horario":"<input type='checkbox' value='V6' name='schedules[]'>" !!}</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td align="center" width="18%" id="L7">{!! (isset($array["L7"]))?"Tope de horario":"<input type='checkbox' value='L7' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="M7">{!! (isset($array["M7"]))?"Tope de horario":"<input type='checkbox' value='M7' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="W7">{!! (isset($array["W7"]))?"Tope de horario":"<input type='checkbox' value='W7' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="J7">{!! (isset($array["J7"]))?"Tope de horario":"<input type='checkbox' value='J7' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="V7">{!! (isset($array["V7"]))?"Tope de horario":"<input type='checkbox' value='V7' name='schedules[]'>" !!}</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td align="center" width="18%" id="L8">{!! (isset($array["L8"]))?"Tope de horario":"<input type='checkbox' value='L8' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="M8">{!! (isset($array["M8"]))?"Tope de horario":"<input type='checkbox' value='M8' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="W8">{!! (isset($array["W8"]))?"Tope de horario":"<input type='checkbox' value='W8' name='schedules[]'>" !!}</td>
                    <td align="center" width="18%" id="J8">{!! (isset($array["J8"]))?"Tope de horario":"<input type='checkbox' value='J8' name='schedules[]'>" !!}</td> 
                    <td align="center" width="18%" id="V8">{!! (isset($array["V8"]))?"Tope de horario":"<input type='checkbox' value='V8' name='schedules[]'>" !!}</td>
                  </tr>
                </table>
            </div>
            <input type="submit" id="submitButton" disabled class="btn btn-primary">
            {!! Form::close() !!}
       

        </div>
    </div>

@endsection
