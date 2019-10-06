<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Caso;
class Delito extends MiModelo
{
  public $table="delitos";
  public $timestamps=false;
  public $guarded=[];


}
