<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
  protected $guarded = ['id'];

  public function schedule(){
    return $this->hasMany('App\schedule');
  }
/*
  public function areas(){
    return $this->hasMany('App\professorsarea');
  }
*/

    /**
     * Get a tags lists associate with the post
     */
    public function scopeGetAreas(){
      return $this->areas->lists('id')->toArray();
    }

  public function areas(){
    return $this->belongsToMAny('App\Area');
  }
}
