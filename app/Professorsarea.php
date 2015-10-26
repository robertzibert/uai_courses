<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professorsarea extends Model
{
    protected $guarded = ['id'];

    public function professor(){
      return $this->belongsTo('\App\Professor');
    }
}
