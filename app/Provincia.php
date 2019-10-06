<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends MiModelo
{
  public $table="provincias";
  public $timestamps=false;
  public $guarded=[];

  public function ciudades(){
    return $this->hasMany(Ciudad::class,"idPcia");
  }

  public function hechos(){
    return $this->hasMany(Hecho::class,"provincia_hecho");
  }
}
?>
