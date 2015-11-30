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
