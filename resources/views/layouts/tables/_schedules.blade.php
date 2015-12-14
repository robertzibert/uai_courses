<table class = 'table table-bordered' id="{{$id}}" >
  <thead>
    <th>Área</th>
    <th>Curso</th>
    <th>Sección</th>
    <th>Profesor</th>
    <th>Horario</th>
    <th>Acciones</th>
  </thead>
  <tbody>
    @foreach($courses as $course)
    <tr>
      <td>{{$course->area()->first()->name}}</td>
      <td>{{$course->name}}</td>
      <td>{{$course->section}}</td>
      <td>profesor</td>
      <td>{{$course->schedule}}</td>
      <td><!-- Single button -->
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Asignar <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">

          </ul>
        </div>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
