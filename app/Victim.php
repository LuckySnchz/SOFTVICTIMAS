<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Necesidad;
use App\Persona;
use App\Caso;
use App\Conviviente;
use App\Imputado;
use App\Programa;
use App\Discapacidad;
use App\Limitacion;

class Victim extends MiModelo
{
public $table="victims";
  public $guarded=[];

  public function caso(){
    return $this->hasOne(Caso::class,"id");
  }

  public function necesidades() {
    return $this->belongsToMany(Necesidad::class,"victima_necesidad","victima_id","necesidad_id");
  }

  public function programas() {
    return $this->belongsToMany(Programa::class,"victima_programa","victima_id","programa_id");
  }

  public function discapacidades() {
    return $this->belongsToMany(Discapacidad::class,"victima_discapacidad","victima_id","discapacidad_id");
}
    public function limitaciones() {
      return $this->belongsToMany(Limitacion::class,"victima_limitacion","victima_id","limitacion_id");
    }

    public function personas() {
      return $this->belongsToMany(Persona::class,"victim_pa","idVictim","idPersona");
    }

    public function convivientes() {
      return $this->belongsToMany(Conviviente::class,"victim_ra","idVictim","idConviviente");
    }

    public function imputados() {
      return $this->belongsToMany(Imputado::class,"victim_im","idVictim","idImputado");
    }

    public function necesidadesIds() {
      return $this->necesidades->pluck("id");
    }

    public function programasIds() {
      return $this->programas->pluck("id");
    }
    public function discapacidadesIds() {
      return $this->discapacidades->pluck("id");
    }

    public function limitacionesIds() {
      return $this->limitaciones->pluck("id");
    }
public function getIdCaso()
  {
    return $this->idCaso;
  }
}
?>
