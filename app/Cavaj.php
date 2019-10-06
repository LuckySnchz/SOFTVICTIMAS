<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Caso;
class Cavaj extends MiModelo
{
  public $table="cavajs";
  public $timestamps=false;
  public $guarded=[];

  public function casos() {
    $this->belongsToMany(Caso::class,"caso_cavaj","cavaj_id","caso_id");
  }
}
