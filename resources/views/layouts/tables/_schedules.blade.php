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
            <a href={{ URL::to("schedules/".$course->year."-".$course->semester."/".$course->area()->first()->name."/index") }}>
                <button class="btn btn-default">
                  Asignar
                </button>
            </a>
        </div>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
