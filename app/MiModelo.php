<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MiModelo extends Model
{
    public static function activos() {
      return self::where("activo", 1)->get();
    }

    public function desactivar() {
      $this->activo = 0;
      $this->save();
    }
}
