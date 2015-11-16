<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
  protected $guarded = ['id'];

  public function courses(){
    return $this->hasMany('\App\Courses');
  }

  public function professors(){
    return $this->belongsToMany('\App\Courses');
  }
}
