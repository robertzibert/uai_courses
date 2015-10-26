<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
  protected $guarded = ['id'];

  public function schedule(){
    return $this->hasMany('App\schedule');
  }
  public function areas(){
    return $this->hasMany('App\professorsarea');
  }
}
