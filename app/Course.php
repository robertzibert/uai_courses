<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = ['id'];

    public function professor(){
      $this->belongsTo('professors');
    }
    public function schedules(){
      $this->hasMany('schedules');
    }

}
