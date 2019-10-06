<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Derivacion;
use App\Seguimiento;
use Illuminate\Http\Request;

class DerivacionController extends Controller
{

  public function agregar(Request $form){

 $hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));
  $reglas = [

  "fecha_ingreso" => "required|date_format:Y-m-d|before:$hoy|after:1900-01-01",
  "tipo_demanda" => "required",
  "modalidad_ingreso" => "required",
  "derivacion" => "required",
  "estado_derivacion" => "required",
  "contacto"=> "required|min:3|max:600|regex:/^([0-9a-zA-ZñÑ.,\s*-])+$/",
  "nombre_y_apellido"=> "required|min:3|max:100|regex:/^([a-zA-ZñÑ.\s*-])+$/"

        ];

    $validator = Validator::make($form->all(), $reglas);

    $validator->sometimes('organismo', 'required', function ($input) {
    return $input->modalidad_ingreso == 3;
      });

    $validator->sometimes('otro_organismo', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
    return $input->organismo == 24;
      });

    $validator->sometimes('otra_demanda', "required|min:3|max:100|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
    return $input->tipo_demanda == 17;
      });

    $validator->sometimes('derivacion_otro', "required|min:3|max:100|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
    return $input->derivacion == 26;
      });

    if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput();
            }

    $user = Auth::user();

    $derivacion= new DERIVACION();

    $derivacion->fecha_ingreso= $form["fecha_ingreso"];
    $derivacion->nombre_y_apellido=$form["nombre_y_apellido"];
    $derivacion->contacto=$form["contacto"];
    $derivacion->tipo_demanda= $form["tipo_demanda"];
    $derivacion->otra_demanda= $form["otra_demanda"];
    $derivacion->modalidad_ingreso= $form["modalidad_ingreso"];
    $derivacion->organismo= $form["organismo"];
    $derivacion->otro_organismo= $form["otro_organismo"];
    $derivacion->derivacion=$form["derivacion"];
    $derivacion->derivacion_otro=$form["derivacion_otro"];
    $derivacion->estado_derivacion=$form["estado_derivacion"];
    $derivacion->userID_create= Auth::id();
    $derivacion->sede=$user->getSede();
    $derivacion->activo=1;
    $derivacion->save();
    $idDerivacion = $derivacion->id;

    session(["idDerivacion" => $idDerivacion]);


    return redirect('home')->with('message','Derivación cargada con Exito!'); 

    }

    public function cargarSeguimiento(Request $form){

     $hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));
    $reglas = [

"seguimiento" => "required",

    "fecha_seguimiento" => "date_format:Y-m-d|before:$hoy|after:1900-01-01",
    "detalle_seguimiento" => "required|min:3|max:600|regex:/^([0-9a-zA-ZñÑ.,\s*-])+$/"

          ];

      $validator = Validator::make($form->all(), $reglas);

      $validator->sometimes('fecha_seguimiento', 'required|date_format:Y-m-d|before: o igual a la fecha actual|after:1899-12-31', function ($input) {
return $input->intervencion == 1;
  });

$validator->sometimes('detalle_seguimiento', 'required|regex:/^([0-9a-zA-ZñÑ.,\s*-])+$/', function ($input) {
return $input->intervencion == 1;
  });


      if ($validator->fails()) {
          return back()
              ->withErrors($validator)
              ->withInput();
              }

      $user = Auth::user();

      $seguimiento= new Seguimiento();

      $seguimiento->fecha_seguimiento= $form["fecha_seguimiento"];
      $seguimiento->detalle_seguimiento=$form["detalle_seguimiento"];
      $seguimiento->idDerivacion=$form["idDerivacion"];
      $seguimiento->activo= 1;
      $seguimiento->userID_create= Auth::id();
      $seguimiento->sede=$user->getSede();
      $seguimiento->save();


      return redirect("agregarseguimiento/{$seguimiento->idDerivacion}");

}

public function eliminar($id) {
  $derivacion = DERIVACION::find($id);
  $derivacion->desactivar();
  $seguimiento = seguimiento::where("idDerivacion", $id)->get();
  foreach ($seguimiento as $s) {
    $s->desactivar();
  };


  return redirect("home");
}

}
