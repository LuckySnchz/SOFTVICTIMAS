<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Caso;
use App\Victim;

class Imputado_nuevo extends MiModelo
{
  public $table="victim_im";
  public $guarded=[];
   public $timestamps=false;

  public function casos(){
    return $this->hasOne(Caso::class,"id");
  }

  public function victims() {
    return $this->belongsToMany(Victim::class,"victim_im","idImputado","idVictim");
  }

  
}
?>
