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

class IntervencionController extends Controller
{
  public function agregar(Request $form){
 
     
    $hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));

   $reglas = [
   "fecha_intervencion" => 'required|date_format:Y-m-d|before: o igual a la fecha actual|after:1899-12-31',
    "detalle_intervencion" => "required|min:3|max:10000|regex:/^([0-9a-zA-ZñÑ.,@\s*-])+$/" ,];

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
   $intervencion->idVictim= session("idVictim");
  $intervencion->userID_create= Auth::id();


  $intervencion->save();

  return redirect ("agregarIntervencion/#victima");
}


  public function agregarnueva(Request $form){
 
    $hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));

   $reglas = [
   "fecha_intervencion" => 'required|date_format:Y-m-d|before: o igual a la fecha actual|after:1899-12-31',
    "detalle_intervencion" => "required|min:3|max:10000|regex:/^([0-9a-zA-ZñÑ.,@\s*-])+$/" ,];

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
   $intervencion->idVictim= session("idVictim");
  $intervencion->userID_create= Auth::id();

session(["idCaso"=> $intervencion->idCaso]);

  $intervencion->save();


  return redirect ("agregarnuevaIntervencionvictima/{$intervencion->idCaso}/#victima");
}

public function agregarnuevapanel(Request $form){
 
    $hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));

   $reglas = [
   "fecha_intervencion" => 'required|date_format:Y-m-d|before: o igual a la fecha actual|after:1899-12-31',
    "detalle_intervencion" => "required|min:3|max:10000|regex:/^([0-9a-zA-ZñÑ.,@\s*-])+$/" ,];

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
   $intervencion->idVictim= session("idVictim");
  $intervencion->userID_create= Auth::id();

session(["idCaso"=> $intervencion->idCaso]);

  $intervencion->save();


  return redirect ("paneldecontrolvictima/{$intervencion->idCaso}/#victima");
}

























   public function eliminarintervencion($id) {
     $intervencionelim=Intervencion::find($id)->getidCaso();
 $intervencion= Intervencion::find($id);
   $intervencion->delete();


   return redirect("/agregarIntervencion/$intervencionelim");}






public function eliminarnuevaintervencion($id) {
     $intervencionelim=Intervencion::find($id)->idCaso;
 $intervencion= Intervencion::find($id);
   $intervencion->delete();


   return redirect("/agregarnuevaIntervencionvictima/$intervencionelim/#victima");}


   public function eliminarnuevaintervencionpanel($id) {
     $intervencionelim=Intervencion::find($id)->idCaso;
 $intervencion= Intervencion::find($id);
   $intervencion->delete();


   return redirect("/paneldecontrolvictima/$intervencionelim/#victima");}



public function detalle($id) {

      $intervencion=Intervencion::find($id);
    session(["idIntervencion"=> $id]);



$fecha_intervencion=$intervencion->fecha_intervencion;
$detalle_intervencion=$intervencion->detalle_intervencion;

return view("detallenuevaintervencion", compact("fecha_intervencion","detalle_intervencion"));}



public function detallepanel($id) {

      $intervencion=Intervencion::find($id);
    session(["idIntervencion"=> $id]);



$fecha_intervencion=$intervencion->fecha_intervencion;
$detalle_intervencion=$intervencion->detalle_intervencion;

return view("detallenuevaintervencionpanel", compact("fecha_intervencion","detalle_intervencion"));}



public function victima($id,$idCaso) {

    
    session(["idVictim"=> $id]);
    session(["idCaso"=> $idCaso]);



return redirect("agregarnuevaIntervencionvictima/{$idCaso}/#victima");}








public function editar(Request $form){
  
    $hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));

   $reglas = [
   "fecha_intervencion" => 'required|date_format:Y-m-d|before: o igual a la fecha actual|after:1899-12-31',
    "detalle_intervencion" => "required|min:3|max:10000|regex:/^([0-9a-zA-ZñÑ.,@\s*-])+$/" ,];

    $validator = Validator::make($form->all(), $reglas);


    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }

$intervencion = Intervencion::find(session("idIntervencion"));

  $intervencion->fecha_intervencion= $form["fecha_intervencion"];
  $intervencion->detalle_intervencion= $form["detalle_intervencion"];
  $intervencion->idCaso= session("idCaso");
  $intervencion->userID_create= Auth::id();


  $intervencion->save();
 $idCaso=session("idCaso");
  return redirect ("agregarnuevaIntervencionvictima/$idCaso/#victima");
}

public function editarpanel(Request $form){
  
    $hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));

   $reglas = [
   "fecha_intervencion" => 'required|date_format:Y-m-d|before: o igual a la fecha actual|after:1899-12-31',
    "detalle_intervencion" => "required|min:3|max:10000|regex:/^([0-9a-zA-ZñÑ.,@\s*-])+$/" ,];

    $validator = Validator::make($form->all(), $reglas);


    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }

$intervencion = Intervencion::find(session("idIntervencion"));

  $intervencion->fecha_intervencion= $form["fecha_intervencion"];
  $intervencion->detalle_intervencion= $form["detalle_intervencion"];
  $intervencion->idCaso= session("idCaso");
  $intervencion->userID_create= Auth::id();


  $intervencion->save();
 $idCaso=session("idCaso");
  return redirect ("paneldecontrolvictima/{$intervencion->idCaso}/#victima");
}





}