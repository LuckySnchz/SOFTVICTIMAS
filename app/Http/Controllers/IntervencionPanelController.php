<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Intervencion;
use App\Delito;
use App\Cavaj;
use App\Usuario;
use App\Caso;
use Validator;

class IntervencionPanelController extends Controller
{
  public function agregar(Request $form){

    $reglas = [
      "fecha_intervencion"=>"required|before:tomorrow",
      "detalle_intervencion"=>'required|min:3|max:1000|',

    ];

    $validator = Validator::make($form->all(), $reglas);


    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }

  $intervencion = new Intervencion();

  $intervencion->fecha_intervencion= $form["fecha_intervencion"];
  $intervencion->detalle_intervencion= $form["detalle_intervencion"];
  $intervencion->idCaso= session("idCaso");
  $intervencion->userID_create= Auth::id();


  $intervencion->save();

  return redirect ("home");
}



public function search(Request $req) {
  $delitos = Delito::all();
  $cavajs = Cavaj::all();
  $usuarios =Usuario::all();

    $search = $req["search"];

    switch ($req["search"]) {

      case "presentacion":
        $search =1;
        break;
      case "intervencion":
        $search =2 ;
      break;

      case "derivacion":
        $search =3 ;
      break;
    }

    $casos = Caso::where("nombre_referencia", "like", "%$search%")
      ->orWhere("nombre_y_apellido_de_la_victima", "like", "%$search%")
      ->orWhere("modalidad_ingreso", "like", "%$search%")
      ->get();

    return view("select", compact("casos"));}

}
