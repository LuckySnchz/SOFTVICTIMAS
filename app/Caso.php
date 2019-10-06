<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Delito;
use App\Cavaj;
use App\Organismo;
use App\Institucion;
use App\Intervencion;
use App\Victim;
use App\Persona;
use App\Profesional;
class Caso extends MiModelo
{
  public $table="casos";
  public $guarded=[];

  public function getId()
  {
    return $this->id;
  }

 public function getnombre_referencia()
  {
    return $this->nombre_referencia;
  }


  public function getSede()
  {
    return $this->sede;
  }

  public function getUserIdCreate()
  {
    return $this->userID_create;
  }

public function delito() {
    return $this->belongsTo(Delito::class, "delito");
  }

  public function cavajs() {
    return $this->belongsToMany(Cavaj::class,"caso_cavaj","caso_id","cavaj_id");
  }

  public function delitosIds() {
    return $this->delitos->pluck("id");
  }

  public function cavajsIds() {
    return $this->cavajs->pluck("id");
  }

  public function organismos() {
    return $this->belongsToMany(Organismo::class,"caso_organismos","caso_id","organismo_id");
  }

  public function instituciones() {
    return $this->hasOne(Institucion::class,"idCaso");
  }
  public function documentos() {
    return $this->hasMany(Documento::class,"idCaso");
  }

  public function intervenciones() {
    return $this->hasMany(Intervencion::class,"idCaso");
  }

  public function personas() {
    return $this->hasMany(Persona::class,"idCaso");
  }

  public function profesionales() {
    return $this->hasMany(Profesional::class,"idCaso");
  }

  public function victims() {
    return $this->hasMany(Victim::class,"idCaso");
  }

  public function organismosIds() {
    return $this->organismos->pluck("id");
}

 public function getactivo()
  {
    return $this->activo;
  }

public function usuarios() {
    return $this->belongsToMany(Caso::class,"Profesionales","idCaso","nombre_profesional_interviniente");
    
}


  
}
?>
