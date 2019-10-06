<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Oarticula;
use App\Oprevio;
use App\Socioeconomico;
use App\Caso;
use App\Asistencia;
class Institucion extends MiModelo
{
  public $table="instituciones";
  public $guarded=[];

  public function oarticulas() {
  return $this->belongsToMany(Oarticula::class,"institucion_oarticula","institucion_id","oarticula_id");
  }

  public function oprevios() {
  return $this->belongsToMany(Oprevio::class,"institucion_oprevio","institucion_id","oprevio_id");
}

public function socioeconomicos() {
return $this->belongsToMany(Socioeconomico::class,"institucion_socioeconomico","institucion_id","socioeconomico_id");
}

public function asistencias() {
return $this->belongsToMany(Asistencia::class,"institucion_asistencia","institucion_id","asistencia_id");
}

public function casos() {
  return $this->hasOne(Caso::class,"idCaso");
}

public function departamentos() {
  return $this->belongsTo(Departamento::class,"colegio_departamental");
}

public function socioeconomicosIds() {
  return $this->socioeconomicos->pluck("id");
}

public function asistenciasIds() {
  return $this->asistencias->pluck("id");
}



public function oarticulasIds() {
  return $this->oarticulas->pluck("id");
}

public function opreviosIds() {
  return $this->oprevios->pluck("id");
}



}
?>
