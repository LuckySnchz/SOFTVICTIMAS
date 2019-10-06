<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Derivacion extends MiModelo
{
  public $table="derivaciones";
  public $guarded=[];

  public static function activos() {
    return self::where("activo", 1)->get();
  }
}
