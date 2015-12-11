<?php

Html::macro('actions', function($id)
{
    $object = Request::segment(1);

    return

       Form::open(['route' => [$object.'.destroy', $id], 'method' => 'delete', 'class' => 'form-inline']).

      '<a class="btn btn-xs btn-primary" href="'.route($object.'.show', $id).'">
         <i class="glyphicon glyphicon-eye-open"></i> View
        </a>

       <a class="btn btn-xs btn-warning" href="'.route($object.'.edit', $id).'">
         <i class="glyphicon glyphicon-edit"></i> Edit
         </a> '
       .Html::customButton('btn btn-xs btn-danger', 'glyphicon glyphicon-trash', 'Delete').
       Form::close();

});

Html::macro('customButton',function($class, $icon, $inner_text){

  return '<button type="submit" class="' . $class . '"><i class="' . $icon . '"></i>' . $inner_text . '</button>';

});

Html::macro('periodButtons', function($semester, $year){

  $semester == 1 ? ($next_semester = 2) && ($next_year = $year) : ($next_semester = 1) && ($next_year = $year + 1);
  $semester == 1 ? ($prev_semester = 2) && ($prev_year = $year - 1) : ($prev_semester = 1) && ($prev_year = $year);


  return
    '<a href="/dashboard/'.$prev_semester.'/'.$prev_year.'" class="btn btn-default" ><i class="glyphicon glyphicon-chevron-left"></i> Semestre Anterior</a>
    <a href="/dashboard/'.$next_semester.'/'.$next_year.'" class="btn btn-default pull-right" > Semestre Siguiente <i class="glyphicon glyphicon-chevron-right"></i></a>';
});
