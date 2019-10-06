<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Caso;

class Intervencion extends MiModelo
{
  public $table="intervenciones";
  public $guarded=[];

  public function casos(){
    return $this->hasOne(Caso::class,"id");
  }

    public function getidCaso()
  {
    return $this->idCaso;
  }
}
?>