<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Caso;

class Documento extends MiModelo
{
  public $table="documentos";
  public $guarded=[];

  public function casos(){
    return $this->hasOne(Caso::class,"id");
  }
  public function getIdCaso()
  {
    return $this->idCaso;
  }
}
?>
