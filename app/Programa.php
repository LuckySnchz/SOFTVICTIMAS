<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Victim;
class Programa extends MiModelo
{
  public $table="programas";
  public $timestamps=false;
  public $guarded=[];

  public function victims() {
    $this->belongsToMany(Victim::class,"victima_programa","programa_id","victima_id");
  }
}
?>
