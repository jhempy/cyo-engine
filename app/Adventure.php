<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Adventure extends Model
{

  public function first_page() {
    return $this->hasOne('App\Page', 'first_page_id');
  }

  public function pages() {
    return $this->hasMany('App\Page');
  }

  public function pretty_updated() {
    $updated = Carbon::parse($this->updated_at);
    $time = '';
    if ($updated->hour > 11) {
      $time = $updated->hour - 12 . ':' . sprintf('%02d', $updated->minute) . ' pm';
    }
    else {
      $time = $updated->hour . ':' . sprintf('%02d', $updated->minute) . ' am';
    }
    $pretty = $updated->month . '/' . $updated->day . '/' . $updated->year . ' ' . $time;
    return $pretty;
  }

}
