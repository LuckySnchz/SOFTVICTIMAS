<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imputado;
use Validator;
use App\Imputado_nuevo;
use App\Victim;

class ImputadoController extends Controller
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


 $validator->sometimes('apodo', 'required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/', function ($input) {
  return $input->agregar_imputado == 1 || $input->cantVictimas ==1;
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

$validator->sometimes('causa_id_judicial','required|integer|max:2147483646' , function ($input) {
  return $input->agregar_imputado == 1 || $input->cantVictimas ==1;
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

  $validator->sometimes('documento_nro', 'required|integer|max:2147483646', function ($input) {
    return $input->tipo_documento_id == 1 ||$input->tipo_documento_id == 2 ||$input->tipo_documento_id == 3 ||$input->tipo_documento_id == 4 ||$input->tipo_documento_id == 5 ||$input->tipo_documento_id == 6 ||$input->tipo_documento_id == 9;
          });

    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }

    if ($form["agregar_imputado"] == 2) {
      return redirect("agregarimputado");

    } else {

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

    return redirect("agregarimputado");
}}


public function duplicar($id) {

  if(Imputado_nuevo::where("idVictim",session("idVictim"))->where("idImputado",$id)->count()==0)
  {
      $imputado_nuevo = Imputado_nuevo::find(1)->replicate();
      $imputado_nuevo->idVictim= session("idVictim");
      $imputado_nuevo->idImputado= $id;
      $imputado_nuevo->save();


        return redirect("agregarimputado");}
        else{
          $duplicado=Imputado::find($id);
          $victima=Victim::find(session("idVictim"));
          return view("duplicarimputado",compact("duplicado","victima"));

        }


    }





public function eliminarimputado($id) {
   $imputadoelim=session("idCaso");
    $imputado_nuevo= Imputado_nuevo::where("idVictim",session("idVictim"))->where("idImputado",$id);
   $imputado_nuevo->delete();

   return redirect("/paneldecontrolvictima/{$imputadoelim}#D");}


  public function editar(Request $form) {
      $imputado = Imputado::find($form["idImputado"]);
      $imputado->nombre_y_apellido= $form["nombre_y_apellido"];
      $imputado->tipo_documento_id= $form["tipodo_documento_id"];
      $imputado->tipo_documento_otro= $form["tipo_documento_otro"];
      $imputado->documento_nro= $form["documento_nro"];
      $imputado->vinculo_id= $form["vinculo_id"];
      $imputado->vinculo_otro= $form["vinculo_otro"];
      $imputado->antecedentes_id= $form["antecedentes_id"];
      $imputado->defensoria_nro= $form["defensoria_nro"];
      $imputado->idCaso= $form ["idCaso"];
      $imputado->save();
       return redirect("home");


}
}
