<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Victim;
class Limitacion extends MiModelo
{
  public $table="limitaciones";
  public $timestamps=false;
  public $guarded=[];

  public function victims() {
    return $this->belongsToMany(Victim::class,"victima_limitaciones","limitaciones_id","victima_id");
  }
}
?>
