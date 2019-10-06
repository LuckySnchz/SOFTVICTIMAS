<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Caso;

class Organismo extends MiModelo
{
      public $table="organismos";
      public $timestamps=false;
      public $guarded=[];

      public function casos() {
        $this->belongsToMany(Caso::class,"caso_organismos","organismo_id","caso_id");
      }

}
