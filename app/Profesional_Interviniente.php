<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesional_Interviniente extends MiModelo
{
  public $table="profesionales_intervinientes";
  public $primarykey="id_profesionales_intervinientes";
  public $timestamps=false;
  public $guarded=[];
}
