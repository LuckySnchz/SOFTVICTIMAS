<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Conviviente;
use Validator;
use App\Conviviente_nuevo;
use App\Victim;


class ConvivienteController extends Controller
{

  public function agregar(request $form) {
 $cantVictimas =Victim::where("idCaso",session("idCaso"))->count();
  $reglas = [

  ];

    $validator = Validator::make($form->all(), $reglas);

    $validator->sometimes('agregar_conviviente', 'required', function ($input) {
      return $input->cantVictimas > "1";
            });

    $validator->sometimes('nombre_y_apellido', 'required|min:3|max:100|regex:/^([a-zA-ZñÑ.\s*-])+$/', function ($input) {
      return $input->agregar_conviviente == 1 || $input->cantVictimas ==1;
            });

  $validator->sometimes('edad', 'required|integer|between:0,99', function ($input) {
    return $input->agregar_conviviente == 1 || $input->cantVictimas ==1;
          });

  $validator->sometimes('vinculo_victima', 'required', function ($input) {
    return $input->agregar_conviviente == 1 || $input->cantVictimas ==1;
          });

    $validator->sometimes('vinculo_otro', "required|min:3|max:60|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
      return $input->vinculo_victima == 6;
    });

    $validator->sometimes('niveleducativo_id', 'required', function ($input) {
      return $input->agregar_conviviente == 1 || $input->cantVictimas ==1;
            });

  $validator->sometimes('condiciones_de_trabajo', 'required', function ($input) {
    return $input->agregar_conviviente == 1 || $input->cantVictimas ==1;
          });

    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }

    if ($form["agregar_conviviente"] == 2) {
      return redirect("agregarconviviente");

    } else {



    $conviviente = new Conviviente();

    $conviviente->nombre_y_apellido= $form["nombre_y_apellido"];
    $conviviente->edad= $form["edad"];
    $conviviente->vinculo_victima= $form["vinculo_victima"];
    $conviviente->vinculo_otro= $form["vinculo_otro"];
    $conviviente->niveleducativo_id= $form["niveleducativo_id"];
    $conviviente->condiciones_de_trabajo= $form["condiciones_de_trabajo"];
    $conviviente->userID_create= Auth::id();
    $conviviente->idCaso= session("idCaso");
    $conviviente->idVictim= session("idVictim");



    $conviviente->save();

    $conviviente->victims()->attach($form ["idVictim"], array("vinculo_victima"=> $form ["vinculo_victima"],"vinculo_otro"=> $form ["vinculo_otro"]));


    return redirect("agregarconviviente");
  }}

  public function duplicar($id,$vinculo_victima,$vinculo_otro=0) {

  if(Conviviente_nuevo::where("idVictim",session("idVictim"))->where("idConviviente",$id)->count()==0)
  {
      $conviviente_nuevo = Conviviente_nuevo::find(1)->replicate();

      $conviviente_nuevo->idVictim= session("idVictim");
      $conviviente_nuevo->idConviviente= $id;
      $conviviente_nuevo->vinculo_victima= $vinculo_victima;
      $conviviente_nuevo->vinculo_otro= $vinculo_otro;
      $conviviente_nuevo->save();


        return redirect("agregarconviviente");}
        else{
          $duplicado=Conviviente::find($id);
          $victima=Victim::find(session("idVictim"));
         return view("duplicarreferente",compact("duplicado","victima"));



        }


    }

public function eliminarconviviente($id) {
  $convivienteelim=Conviviente::find($id)->getIdCaso();
   $conviviente_nuevo= Conviviente_nuevo::where("idVictim",session("idVictim"))->where("idConviviente",$id);
   $conviviente_nuevo->delete();

   return redirect("/paneldecontrolvictima/{$convivienteelim}#C");}





    public function editar(Request $form) {

        $conviviente = Conviviente::find($form["idConviviente"]);

        $conviviente->nombre_y_apellido= $form["nombre_y_apellido"];
        $conviviente->edad_conviviente= $form["edad_conviviente"];
        $conviviente->vinculo_victima= $form["vinculo_victima"];
        $conviviente->niveleducativo_id= $form["niveleducativo_id"];
        $conviviente->condiciones_de_trabajo= $form["condiciones_de_trabajo"];

        $conviviente->idCaso= $form ["idCaso"];

             $conviviente->save();
              return redirect("home");}




    }
