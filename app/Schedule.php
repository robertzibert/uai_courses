<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = ['id'];

    public function course(){
      return $this->belongsTo('course');
    }
    public function professor(){
      return $this->belongsTo('professor');
    }
}
