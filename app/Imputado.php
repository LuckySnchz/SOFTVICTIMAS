<?php

namespace App;
use App\Victim;

use Illuminate\Database\Eloquent\Model;

class Imputado extends MiModelo
{
  public $table="imputados";
  public $guarded=[];

  public function victims() {
    return $this->belongsToMany(Victim::class,"victim_im","idImputado","idVictim");
  }
  public function getIdCaso()
  {
    return $this->idCaso;
  }
}
