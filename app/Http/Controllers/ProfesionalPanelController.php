<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profesional;
use App\Usuario;

use Validator;


class ProfesionalPanelController extends Controller
{
public function editar(Request $form){

$hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));
  $reglas = [
  
    "desde_profesional_interviniente"=>"required|date_format:Y-m-d|before:$hoy|after:1899-12-31",
    "actual_profesional_interviniente"=>"required"
  ];

  $validator = Validator::make($form->all(), $reglas);

  $hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));

  $validator->sometimes('hasta_profesional_interviniente', 'required|date_format:Y-m-d|before:de la fecha Actual|after:desde_profesional_interviniente', function ($input) {
    return $input->actual_profesional_interviniente == 2;
  });






  if ($validator->fails()) {
      return back()
                  ->withErrors($validator)
                  ->withInput();
  }

  $profesional = Profesional::find($form["idProfesional"]);

 
  $profesional->desde_profesional_interviniente= $form [ "desde_profesional_interviniente"];
  $profesional->actual_profesional_interviniente= $form [ "actual_profesional_interviniente"];
  $profesional->hasta_profesional_interviniente= $form [ "hasta_profesional_interviniente"];
  $profesional->idCaso= session("idCaso");
  $profesional->userID_modify= Auth::id();



           $profesional->save();
           return redirect("paneldecontrolcaso/{$profesional->idCaso}#c2");
          }


public function detalle($id) {

    $profesional = Profesional::find($id);
    $profesionales = Profesional::All();
    $usuarios = Usuario::All();
    session(["idProfesional" => $id]);
$nombre_profesional_interviniente=$profesional->nombre_profesional_interviniente;
$nombre_profesional_interviniente_otro=$profesional->nombre_profesional_interviniente_otro;
$desde_profesional_interviniente=$profesional->desde_profesional_interviniente;
$hasta_profesional_interviniente=$profesional->hasta_profesional_interviniente;
$actual_profesional_interviniente=$profesional->actual_profesional_interviniente;

    $vac = compact("profesional","profesionales","usuarios","nombre_profesional_interviniente","nombre_profesional_interviniente_otro","desde_profesional_interviniente","hasta_profesional_interviniente","actual_profesional_interviniente");

    return view("detalleProfesional", $vac);
  }

  public function eliminar($id) {
    $profesional = Profesional::find($id);
    $profesional->delete();

 return redirect("paneldecontrolcaso/{$profesional->idCaso}#c2");

  }


public function agregar(Request $form){
    $hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));

  $reglas = [
   
  "desde_profesional_interviniente"=>"required|date_format:Y-m-d|before:$hoy|after:1899-12-31",
    "actual_profesional_interviniente"=>"required"
  
  ];


$validator = Validator::make($form->all(), $reglas);

  $hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));




  $validator->sometimes('hasta_profesional_interviniente', 'required|after:desde_profesional_interviniente', function ($input) {
    return $input->actual_profesional_interviniente == 2;
  });


 $validator->sometimes('nombre_profesional_interviniente_otro', 'required|regex:/^([a-zA-ZñÑ.\s*-])+$/', function ($input) {
    return $input->nuevo_profesional == 1;
  });

 $validator->sometimes('nombre_profesional_interviniente', 'required', function ($input) {
    return $input->nuevo_profesional == 2 || $input->nuevo_profesional == '';
  });




  if ($validator->fails()) {
      return back()
                  ->withErrors($validator)
                  ->withInput();
  }

  $profesional= new Profesional( );

  $profesional->nombre_profesional_interviniente= $form [ "nombre_profesional_interviniente"];
  $profesional->nombre_profesional_interviniente_otro= $form [ "nombre_profesional_interviniente_otro"];
  $profesional->desde_profesional_interviniente= $form [ "desde_profesional_interviniente"];
  $profesional->actual_profesional_interviniente= $form [ "actual_profesional_interviniente"];
  $profesional->hasta_profesional_interviniente= $form [ "hasta_profesional_interviniente"];
  $profesional->idCaso= session("idCaso");
  $profesional->userID_create= Auth::id();

  $profesional->save( );
   return redirect("paneldecontrolcaso/{$profesional->idCaso}");
  
}


}
