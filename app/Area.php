<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
  protected $guarded = ['id'];

  public function courses(){
    return $this->hasMany('\App\Course');
  }

  public function professors(){
    return $this->belongsToMany('\App\Professor');
  }

  public function scopeGetAreas(){
    return $this->orderBy('complete_name', 'ASC')->lists('complete_name', 'id');
  }

}
