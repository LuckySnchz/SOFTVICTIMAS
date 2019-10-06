<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Documento;

use Validator;

class DocumentoPanelController extends Controller
{
public function editar(Request $form){

  $reglas = [
    "tipo_documento"=>"required",
    "nombre_documento"=>"required|max:255",
    "archivo"=>"required|file"
  ];

  $validator = Validator::make($form->all(), $reglas);


  if ($validator->fails()) {
      return back()
                  ->withErrors($validator)
                  ->withInput();
  }


$archivo = $form->file("archivo");
$rutaDondeSeGuardaElArchivo = $archivo->store("public");
$nombreDelArchivo = basename($rutaDondeSeGuardaElArchivo);

$documento = Documento::find($form["idDocumento"]);

  $documento->tipo_documento= $form [ "tipo_documento"];
  $documento->nombre_documento= $form [ "nombre_documento"];
  $documento->archivo = $nombreDelArchivo;
  $documento->idCaso= session("idCaso");

      $documento->userID_create= $form["userID_create"];
      $documento->userID_modify= Auth::id();
      $documento->save();
  
      return redirect("/paneldecontrolcaso/{$documento->idCaso}#c4");


}


public function detalle($id) {

    $documentos = Documento::all();
    $documento = Documento::find($id);

    $tipo_documento=$documento->tipo_documento;
    $nombre_documento=$documento->nombre_documento;

    return view("detalleDocumento", compact("documento","documentos","tipo_documento","nombre_documento"));
  }

 


public function eliminardocumento($id) {
   $documentoelim=session("idCaso");
    $documento = Documento::find($id);
    $documento->delete();

 return redirect("paneldecontrolcaso/{$documentoelim}#c4");

  }
public function eliminardoc($id) {
   $documentoelim=session("idCaso");
    $documento = Documento::find($id);
    $documento->delete();

 return redirect("agregarDocumento");

  }







  
public function agregar(Request $form){

  $reglas = [
    "tipo_documento"=>"required",
    "nombre_documento"=>"required|max:255",
    "archivo"=>"required|file"
  ];

  $validator = Validator::make($form->all(), $reglas);


  if ($validator->fails()) {
      return back()
                  ->withErrors($validator)
                  ->withInput();
  }


$archivo = $form->file("archivo");
$rutaDondeSeGuardaElArchivo = $archivo->store("public");
$nombreDelArchivo = basename($rutaDondeSeGuardaElArchivo);

$documento= new Documento( );

  $documento->tipo_documento= $form [ "tipo_documento"];
  $documento->nombre_documento= $form [ "nombre_documento"];
  $documento->archivo = $nombreDelArchivo;
  $documento->idCaso= session("idCaso");
  $documento->userID_create= Auth::id();

  $documento->save( );
 return redirect("/paneldecontrolcaso/{$documento->idCaso}#c4");
}




}
