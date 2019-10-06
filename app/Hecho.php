<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hecho extends MiModelo
{
  public $table="hechos";
  public $guarded=[];

  public function provincias() {
    return $this->hasOne(Provincia::class, "id");
  }


}
