<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Institucion;
class Oarticula extends MiModelo
{
  public $table="oarticulas";
  public $timestamps=false;
  public $guarded=[];

  public function instituciones() {
    return $this->belongsToMany(Institucion::class,"institucion_oarticula","oartitula_id","institucion_id");
  }
}
?>
