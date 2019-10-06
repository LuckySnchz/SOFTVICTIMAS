<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profesional;
use App\Casos;

use Validator;

class ProfesionalController extends Controller
{
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

  $validator->sometimes('hasta_profesional_interviniente', 'required|date_format:Y-m-d|before:de la fecha Actual|after:desde_profesional_interviniente', function ($input) {
    return $input->actual_profesional_interviniente == 2;
  });

$validator->sometimes('nombre_profesional_interviniente_otro', 'required|regex:/^([a-zA-ZñÑ.\s*-])+$/', function ($input) {
    return $input->nuevo_profesional == 1;
  });

 $validator->sometimes('nombre_profesional_interviniente', 'required|', function ($input) {
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

  $profesional->save();
  


    $count=Profesional::where("idCaso",session("idCaso"))->where("nombre_profesional_interviniente",Auth::id())->count();


if($count==0){$profesional->casos()->attach($form ["idCaso"], array("nombre_profesional_interviniente"=> Auth::id()));}


  return redirect ("agregarProfesional");
}


public function detalle($id) {

    $profesional = Profesional::find($id);


    $vac = compact("profesional");

    return view("detalleProfesional", $vac);
  }

  public function eliminar($id) {
    $profesional = Profesional::find($id);
    $profesional->delete();
      return redirect("agregarProfesional");

  }
  public function editar(Request $form) {
      $profesional = Profesional::find($form["idProfesional"]);
      $profesional->nombre_profesional_interviniente= $form ["nombre_profesional_interviniente"];
      $profesional->desde_profesional_interviniente= $form ["desde_profesional_interviniente"];
      $profesional->actual_profesional_interviniente= $form ["actual_profesional_interviniente"];
      $profesional->hasta_profesional_interviniente= $form ["hasta_profesional_interviniente"];
      $profesional->idCaso= $form ["idCaso"];

           $profesional->save();
            return redirect("home");}




}
