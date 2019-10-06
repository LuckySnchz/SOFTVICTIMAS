<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Institucion;
class Oprevio extends MiModelo
{
  public $table="oprevios";
  public $timestamps=false;
  public $guarded=[];


    public function instituciones() {
      return $this->belongsToMany(Institucion::class,"institucion_oprevio","oprevio_id","institucion_id");
    }
}
?>
