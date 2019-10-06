<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Caso;
use App\Victim;

class Persona extends MiModelo
{
  public $table="personas";
  public $guarded=[];

  public function casos(){
    return $this->hasOne(Caso::class,"id");
  }

  public function victims() {
    return $this->belongsToMany(Victim::class,"victim_pa","idPersona","idVictim");
  }
  public function getIdCaso()
  {
    return $this->idCaso;
  }
}
?>
