<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Institucion;
class Socioeconomico extends MiModelo
{
  public $table="socioeconomicos";
  public $timestamps=false;
  public $guarded=[];


    public function instituciones() {
      return $this->belongsToMany(Institucion::class,"institucion_socioeconomico","socioeconomico_id","institucion_id");
    }
}
?>
