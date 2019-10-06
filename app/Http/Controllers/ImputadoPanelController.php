<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Imputado;
use App\Imputado_nuevo;
use App\Victim;
use Validator;

class ImputadoPanelController extends Controller
{
  public function agregar(request $form) {


   $cantVictimas = Victim::where("idCaso",session("idCaso"))->count();
    $reglas = [

 

    ];

    $validator = Validator::make($form->all(), $reglas);

    $validator->sometimes('agregar_imputado', 'required', function ($input) {
      return $input->cantVictimas > "1";
            });

  $validator->sometimes('imputado_nombre_y_apellido', 'required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/', function ($input) {
  return $input->agregar_imputado == 1 || $input->cantVictimas ==1;
          });

$validator->sometimes('apodo', 'required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/', function ($input) {        return $input->agregar_imputado == 1 || $input->cantVictimas ==1;
        });
$validator->sometimes('tipo_documento_id', 'required', function ($input) {
  return $input->agregar_imputado == 1 || $input->cantVictimas ==1;
        });


$validator->sometimes('vinculo_victima', 'required',function ($input) {
    return $input->agregar_imputado == 1 || $input->cantVictimas ==1;
          });





$validator->sometimes('caratulacion_judicial', 'required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/', function ($input) {return $input->agregar_imputado == 1 || $input->cantVictimas ==1;
        });

  $validator->sometimes('antecedentes_id', 'required', function ($input) {
    return $input->agregar_imputado == 1 || $input->cantVictimas ==1;
          });

$validator->sometimes('detenido', 'required|integer', function ($input) {
  return $input->agregar_imputado == 1 || $input->cantVictimas ==1;
        });

$validator->sometimes('defensor_particular', 'required|integer', function ($input) {
  return $input->agregar_imputado == 1 || $input->cantVictimas ==1;
        });

$validator->sometimes('defensoria_numero', 'required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/', function ($input) {
  return $input->agregar_imputado == 1 || $input->cantVictimas ==1;
        });

$validator->sometimes('fiscalia_juzgado', 'required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/', function ($input) {
  return $input->agregar_imputado == 1 || $input->cantVictimas ==1;
        });

$validator->sometimes('causa_id_judicial', 'required|integer|max:2147483646', function ($input) {
  return $input->agregar_imputado == 1 || $input->cantVictimas ==1;
        });


    $validator->sometimes('tipo_documento_otro', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
      return $input->tipo_documento_id == 9;
            });

    $validator->sometimes('vinculo_otro', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
      return $input->vinculo_victima == 6;
                    });

    $validator->sometimes('antecedentes', "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.,;\s*-])+$/", function ($input) {
      return $input->antecedentes_id == 1;
                    });

    $validator->sometimes('lugar_de_alojamiento', "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/", function ($input) {
      return $input->detenido == 1;
                    });

  $validator->sometimes('documento_nro', 'required|integer|max:2147483646', function ($input) {
    return $input->tipo_documento_id == 1 ||$input->tipo_documento_id == 2 ||$input->tipo_documento_id == 3 ||$input->tipo_documento_id == 4 ||$input->tipo_documento_id == 5 ||$input->tipo_documento_id == 6 ||$input->tipo_documento_id == 9;
          });


    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }


   

    $imputado = new Imputado();
    $imputado->nombre_y_apellido= $form["imputado_nombre_y_apellido"];
    $imputado->apodo= $form["apodo"];
    $imputado->tipo_documento_id= $form["tipo_documento_id"];
    $imputado->tipo_documento_otro= $form["tipo_documento_otro"];
    $imputado->documento_nro= $form["documento_nro"];
    $imputado->vinculo_victima= $form["vinculo_victima"];
    $imputado->vinculo_otro= $form["vinculo_otro"];
    $imputado->caratulacion_judicial= $form["caratulacion_judicial"];
    $imputado->antecedentes_id= $form["antecedentes_id"];
    $imputado->antecedentes= $form["antecedentes"];
    $imputado->detenido= $form["detenido"];
    $imputado->lugar_de_alojamiento= $form["lugar_de_alojamiento"];
    $imputado->defensor_particular= $form["defensor_particular"];
    $imputado->defensoria_nro= $form["defensoria_numero"];
    $imputado->fiscalia_juzgado= $form["fiscalia_juzgado"];
    $imputado->causa_id_judicial= $form["causa_id_judicial"];
    $imputado->idVictim= session("idVictim");
    $imputado->idCaso= session("idCaso");
    $imputado->userID_create= Auth::id();

    $imputado->save();

    $imputado->victims()->attach($form ["idVictim"], array("vinculo_victima"=> $form ["vinculo_victima"],"vinculo_otro"=> $form ["vinculo_otro"]));
      return redirect("/paneldecontrolvictima/{$imputado->idCaso}/#v4");


}
public function detalle($id) {
    $imputados=Imputado::all();
    $imputado = Imputado::find($id);
    session(["idImputado" => $id]);
 $nombre_y_apellido=$imputado->nombre_y_apellido;
  
    $apodo= $imputado->apodo;
    $tipo_documento_id= $imputado->tipo_documento_id;
    $tipo_documento_otro=$imputado->tipo_documento_otro;
    $documento_nro=$imputado->documento_nro;
    $vinculo_victima=$imputado->vinculo_victima;
    $vinculo_otro= $imputado->vinculo_otro;
    $caratulacion_judicial=$imputado->caratulacion_judicial;
    $antecedentes_id=$imputado->antecedentes_id;
    $antecedentes=$imputado->antecedentes;
    $detenido=$imputado->detenido;
    $lugar_de_alojamiento=$imputado->lugar_de_alojamiento;
    $defensor_particular=$imputado->defensor_particular;
    $defensoria_nro=$imputado->defensoria_nro;
    $fiscalia_juzgado=$imputado->fiscalia_juzgado;
    $causa_id_judicial= $imputado->causa_id_judicial;

    return view("detalleimputado", compact("imputados","imputado","nombre_y_apellido","apodo","tipo_documento_id","tipo_documento_otro","documento_nro","vinculo_victima","vinculo_otro","caratulacion_judicial","antecedentes_id","antecedentes","detenido","lugar_de_alojamiento","defensor_particular","defensoria_nro","fiscalia_juzgado","causa_id_judicial"));
  }

  public function detalleimputado($id) {
    

    $imputados=Imputado::all();
    $imputado = Imputado::find($id);
    session(["idImputado" => $id]);
    $nombre_y_apellido=$imputado->nombre_y_apellido;
  
    $apodo= $imputado->apodo;
    $tipo_documento_id= $imputado->tipo_documento_id;

    $tipo_documento_otro=$imputado->tipo_documento_otro;
    $documento_nro=$imputado->documento_nro;
    $vinculo_victima=$imputado->vinculo_victima;
    $vinculo_otro= $imputado->vinculo_otro;
    $caratulacion_judicial=$imputado->caratulacion_judicial;
    $antecedentes_id=$imputado->antecedentes_id;
    $antecedentes=$imputado->antecedentes;
    $detenido=$imputado->detenido;
    $lugar_de_alojamiento=$imputado->lugar_de_alojamiento;
    $defensor_particular=$imputado->defensor_particular;
    $defensoria_nro=$imputado->defensoria_nro;
    $fiscalia_juzgado=$imputado->fiscalia_juzgado;
    $causa_id_judicial= $imputado->causa_id_judicial;


     if(Imputado_nuevo::where("idVictim",session("idVictim"))->where("idImputado",$id)->count()==0){

    return view("detalleimputadovinculo", compact("imputados","imputado","nombre_y_apellido","apodo","tipo_documento_id","tipo_documento_otro","documento_nro","vinculo_victima","vinculo_otro","caratulacion_judicial","antecedentes_id","antecedentes","detenido","lugar_de_alojamiento","defensor_particular","defensoria_nro","fiscalia_juzgado","causa_id_judicial"));
  }
  else{  
         $duplicado=Imputado::find($id)->nombre_y_apellido;
         return view("duplicarreferente",compact("duplicado"));
        



        }
      }


 



 public function editar(Request $form) {
  $reglas = [
  'imputado_nombre_y_apellido'=>'required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/', 

'apodo'=>'required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/', 
'tipo_documento_id'=>'required', 
 

'vinculo_victima'=> 'required', 

'caratulacion_judicial'=> 'required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/',

  'antecedentes_id'=>'required',

'detenido'=> 'required|integer',
'defensor_particular'=> 'required|integer', 
'defensoria_numero'=> 'required|min:1|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/', 

'fiscalia_juzgado'=> 'required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/', 

'causa_id_judicial'=>'required|integer|max:2147483646', 

    ];




    $validator = Validator::make($form->all(), $reglas);


  $validator->sometimes('documento_nro', 'required|integer|max:2147483646', function ($input) {
      return $input->tipo_documento_id == 1||$input->tipo_documento_id == 2||$input->tipo_documento_id == 3||$input->tipo_documento_id == 4||$input->tipo_documento_id == 5||$input->tipodo_cumento_id == 6||$input->tipo_documento_id == 9;
            });




    $validator->sometimes('tipo_documento_otro', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
      return $input->tipo_documento_id == 9;
            });

    $validator->sometimes('vinculo_otro', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
      return $input->vinculo_victima == 6;
                    });

    $validator->sometimes('antecedentes', "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.,\s*-])+$/", function ($input) {
      return $input->antecedentes_id == 1;
                    });

    $validator->sometimes('lugar_de_alojamiento', "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/", function ($input) {
      return $input->detenido == 1;
                    });



    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }

     
      $imputado = Imputado::find($form["idImputado"]);
      $imputado->nombre_y_apellido= $form["imputado_nombre_y_apellido"];
      $imputado->tipo_documento_id= $form["tipo_documento_id"];
      $imputado->tipo_documento_otro= $form["tipo_documento_otro"];
      $imputado->documento_nro= $form["documento_nro"];
      $imputado->vinculo_victima= $form["vinculo_victima"];
      $imputado->vinculo_otro= $form["vinculo_otro"];
      $imputado->antecedentes_id= $form["antecedentes_id"]; 
       $imputado->detenido= $form["detenido"];
       $imputado->antecedentes= $form["antecedentes"];
      $imputado->lugar_de_alojamiento=$form["lugar_de_alojamiento"];  
      $imputado->caratulacion_judicial=$form["caratulacion_judicial"];
      $imputado->fiscalia_juzgado=$form["fiscalia_juzgado"];
      $imputado->causa_id_judicial= $form["causa_id_judicial"];
      $imputado->defensoria_nro= $form["defensoria_numero"];
      $imputado->idCaso= $form ["idCaso"];
      $imputado->save();
       return redirect("paneldecontrolvictima/{$imputado->idCaso}#v4");}

  public function editarimputado(Request $form) {
  
    $reglas = [
    
      "vinculo_victima"=>"required",
    ];

    $validator = Validator::make($form->all(), $reglas);

    $validator->sometimes('vinculo_otro', 'required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/', function ($input) {
      return $input->vinculo_victima == 6;
    });

    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }


 $imputado = Imputado::find($form["idImputado"]);
     
      $imputado->vinculo_victima= $form["vinculo_victima"];
      $imputado->vinculo_otro= $form["vinculo_otro"];
      
      $imputado->idCaso= $form ["idCaso"];
      $imputado->save();
     
      $imputado_nuevo = new Imputado_nuevo();      
      $imputado_nuevo->idVictim= session("idVictim");
      $imputado_nuevo->idImputado= $form["idImputado"];
      $imputado_nuevo->vinculo_victima=$form["vinculo_victima"];
      $imputado_nuevo->vinculo_otro= $form["vinculo_otro"];
      $imputado_nuevo->save();


        return redirect("agregarimputado");}


}
