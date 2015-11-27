<table class = 'table table-bordered' id="{{$id}}" >
  <thead>
    <th>Curso     </th>
    <th>Sección   </th>
    <th>Profesor  </th>
    <th>Horario   </th>
    <th>Acciones  </th>
  </thead>
  <tbody>
    @foreach($courses as $course)
    @if(($course['taken'] == 0 && $id == 'dataTable') || ($course['taken'] == 1 && $id == 'dataTable1'))
    <tr>
      <td>{{$course['name']}}                   </td>
      <td>{{$course['section']}}                </td>
      <td>{{$professorCourse[$course['id']]}}   </td>
      <td>{{$course['schedule']}}               </td>
      <td><!-- Single button -->
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Asignar <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="#">Rely</a></li>
            <li><a href="#">Carols</a></li>
          </ul>
        </div>
      </td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
