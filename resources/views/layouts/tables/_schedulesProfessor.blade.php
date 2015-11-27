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
    @if(($id == 'dataTable2') || ($professor['type'] == 'Hora' && $id == 'dataTable3')|| ($professor['type'] == 'Instructor' && $id == 'dataTable4')|| ($professor['type'] == 'Regular' && $id == 'dataTable5')|| ($professor['type'] == 'Administrativo-docente' && $id == 'dataTable6'))
    <tr>
      <td>{{$professor['name']}}</td>
      <td>{{$professor['rut']}}</td>
      <td>{{$professor['sede_origen']}}</td>
      <td>{{$professor['min_load']}}</td>
      <td>{{$professor['max_load']}}</td>
      <td>{{$professor['current_load']}}</td>
      <td><!-- Single button -->
<div class="btn-group">
  <button type="button" class="btn btn-default">
    Asignar Curso
  </button>
</div></td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>