<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Victim;
class Discapacidad extends MiModelo
{
  public $table="discapacidades";
  public $timestamps=false;
  public $guarded=[];

  public function victims() {
    return $this->belongsToMany(Victim::class,"victima_discapacidad","discapacidad_id","victima_id");
  }
}
?>
