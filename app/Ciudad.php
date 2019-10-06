<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends MiModelo
{
  public $table="ciudades";
  public $timestamps=false;
  public $guarded=[];

  public function provincia(){
    return $this->hasOne(Provincia::class,"idPcia");
  }

}
?>
