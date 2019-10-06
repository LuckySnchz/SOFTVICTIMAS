<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Victim;
class Necesidad extends MiModelo
{
  public $table="necesidades";
  public $timestamps=false;
  public $guarded=[];

  public function victims() {
    return $this->belongsToMany(Victim::class,"victima_necesidad","necesidad_id","victima_id");
  }
}
?>
