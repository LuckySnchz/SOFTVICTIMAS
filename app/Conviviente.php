<?php

namespace App;
use App\Caso;
use App\Victim;

use Illuminate\Database\Eloquent\Model;

class Conviviente extends MiModelo
{
  public $table="convivientes";
  public $guarded=[];


public function caso() {
  return $this->belongsTo(Caso::class,"IdCaso");
}

public function victims() {
  return $this->belongsToMany(Victim::class,"victim_ra","idConviviente","idVictim");
}
public function getIdCaso()
  {
    return $this->idCaso;
  }
  
}

?>
