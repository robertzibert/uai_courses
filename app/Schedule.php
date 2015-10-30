<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = ['id'];

    public function course(){
      return $this->belongsTo('\App\course');
    }
    public function professor(){
      return $this->belongsTo('\App\professor');
    }
}
