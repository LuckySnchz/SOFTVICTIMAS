<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Institucion;
class Asistencia extends MiModelo
{
  public $table="asistencias";
  public $timestamps=false;
  public $guarded=[];

  public function instituciones() {
    return $this->belongsToMany(Institucion::class,"institucion_asistencia","asistencia_id","institucion_id");
  }
}
?>
