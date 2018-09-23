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

  public function parents() {
      // TODO:
      // should return a collection(?) of the pages that have choices that point to this page

      


  }

}
