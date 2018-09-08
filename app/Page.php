<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

  public function adventure() {
    return $this->belongsTo('App\Adventure');
  }

  public function choices() {
    return $this->hasMany('App\Choice');
  }

}
