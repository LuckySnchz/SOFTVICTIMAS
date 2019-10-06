<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Institucion;

class Departamento extends MiModelo
{
  public $table="departamentos";
  public $timestamps=false;
  public $guarded=[];

public function instituciones(){
  return $this->hasOne(Institucion::class,"id");
}
}
