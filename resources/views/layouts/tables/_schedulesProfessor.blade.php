<table class = 'table table-bordered' id="{{$id}}" >
  <thead>
    <th>Nombre</th>
    <th>Rut</th>
    <th>Sede Origen</th>
    <th>Carga Anual</th>
    <th>Carga Máxima</th>
    <th>Carga Actual</th>
    <th>Acciones</th>
  </thead>
  <tbody>
    @foreach($professors as $professor)
    @if(($id == 'dataTable2') || ($professor['type'] == 'Hora' && $id == 'dataTable3')|| ($professor['type'] == 'Instructor' && $id == 'dataTable5')|| ($professor['type'] == 'Regular' && $id == 'dataTable6')|| ($professor['type'] == 'Administrativo-docente' && $id == 'dataTable4'))
    <tr>
      <td>{{$professor['name']}}</td>
      <td>{{$professor['rut']}}</td>
      <td>{{$professor['sede_origen']}}</td>
      <td>{{$professor['min_load']}}</td>
      <td>{{$professor['max_load']}}</td>
      <td>{{$professor['current_load']}}</td>
      <td><!-- Single button -->
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Asignar <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            @foreach($prof_areas[$professor['id']] as $ar)
            <li><a href={{ URL::to("schedules/".$year."-".$semester."/".$ar['name']."/".$professor['id']) }}>{{$ar['name']}}</a></li>
            @endforeach
          </ul>
        </div>
      </td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>