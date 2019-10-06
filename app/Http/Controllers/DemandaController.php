<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Demanda;
use App\Provincia;
use App\Ciudad;
use App\Delito;
use App\Organismo;
use App\Departamento;
use App\Cavaj;
use App\Caso;
use App\User;
use App\Usuario;
class DemandaController extends Controller
{

public function agregar(Request $form){
$hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));
$reglas = [

"fecha_ingreso" => "required|date_format:Y-m-d|before:$hoy|after:1900-01-01",
"delito" => "required",
"modalidad_ingreso" => "required",
"nombre_y_apellido_de_la_victima"=> "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/",
"fecha_delito"=>"required",
"pais_hecho"=>"required",


      ];

  $validator = Validator::make($form->all(), $reglas);

  $validator->sometimes('organismo', 'required', function ($input) {
  return $input->modalidad_ingreso == 3;
    });

  $validator->sometimes('cual_otro_organismo', "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/", function ($input) {
  return $input->organismo == 24;
    });

  $validator->sometimes('otro_delito', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
  return $input->delito == 36;
    });
$validator->sometimes('fecha_hecho', "required|date_format:Y-m-d|before:$hoy|after:1899-12-31", function ($input) {
    return $input->fecha_delito == 1;
  });

  $validator->sometimes('fecha_hecho_otro', "required|min:3|max:100|regex:/^([0-9a-zA-ZñÑ.,\s*-])+$/", function ($input) {
    return $input->fecha_delito == 2;
  });

  $validator->sometimes('provincia_hecho', 'required', function ($input) {
return $input->pais_hecho == 1;
  });



    $validator->sometimes('pais_hecho_otro', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
return $input->pais_hecho == 3;
  });
 

  $validator->sometimes('localidad_hecho', 'required', function ($input) {
return $input->pais_hecho == 1;
  
  });

  $validator->sometimes('localidad_hecho', 'required', function ($input) {
return (
  $input->provincia_hecho == 1||$input->provincia_hecho == 2||$input->provincia_hecho == 3||$input->provincia_hecho == 4||$input->provincia_hecho == 5||$input->provincia_hecho == 6||$input->provincia_hecho == 7||$input->provincia_hecho == 8||$input->provincia_hecho == 9||$input->provincia_hecho == 10||$input->provincia_hecho == 11||$input->provincia_hecho == 12||$input->provincia_hecho == 13||$input->provincia_hecho == 14||$input->provincia_hecho == 15||$input->provincia_hecho == 16||$input->provincia_hecho == 17||$input->provincia_hecho == 18||$input->provincia_hecho == 19||$input->provincia_hecho == 20||$input->provincia_hecho == 21||$input->provincia_hecho == 22||$input->provincia_hecho == 23||$input->provincia_hecho == 24);
  });









  if ($validator->fails()) {
      return back()
          ->withErrors($validator)
          ->withInput();
          }

  $user = Auth::user();

  $demanda= new Demanda();

  $demanda->fecha_ingreso= $form["fecha_ingreso"];
  $demanda->nombre_y_apellido_de_la_victima=$form["nombre_y_apellido_de_la_victima"];
  $demanda->delito= $form["delito"];
  $demanda->otro_delito= $form["otro_delito"];
  $demanda->modalidad_ingreso= $form["modalidad_ingreso"];
  $demanda->organismo= $form["organismo"];
  $demanda->cual_otro_organismo= $form["cual_otro_organismo"];
  $demanda->fecha_delito= $form ["fecha_delito"];
  $demanda->fecha_hecho= $form ["fecha_hecho"];
  $demanda->fecha_hecho_otro  = $form ["fecha_hecho_otro"];
  $demanda->pais_hecho= $form ["pais_hecho"];
  $demanda->pais_hecho_otro= $form ["pais_hecho_otro"];
  $demanda->provincia_hecho= $form ["provincia_hecho"];
  $demanda->localidad_hecho= $form ["localidad_hecho"];
  $demanda->activo= 1;
  $demanda->userID_create= Auth::id();
  $demanda->sede=$user->getSede();

  $demanda->save();
  $idDemanda = $demanda->id;

  session(["idDemanda" => $idDemanda]);

return redirect('home')->with('message','Incidencia cargada con Exito!'); 


  }

  public function eliminar($id) {
    $demanda = DEMANDA::find($id);
    $demanda->desactivar();


    return redirect("home");
  }


//DETALLE EN LA VISTA AGREGARCASO, MUESTRA TODO LO DE DEMANDA:
        public function PasarACaso($id){
          

        $DemandaACaso = Demanda::find($id);
        $DemandaACaso->desactivar();

          

          $provincias = Provincia::all();
          $ciudades = Ciudad::all();
          $delitos = Delito::all();
          $cavajs = Cavaj::all();
          $usuarios = Usuario::all();
          $organismos = Organismo::all();
          $departamentos = Departamento::all();
          $fecha_ingreso_dem=$DemandaACaso->fecha_ingreso;
          $delito_dem= $DemandaACaso->delito;
          $otro_delito_dem= $DemandaACaso->otro_delito;
          $modalidad_ingreso_dem= $DemandaACaso->modalidad_ingreso;
          $organismo_dem= $DemandaACaso->organismo;
          $cual_otro_organismo_dem= $DemandaACaso->cual_otro_organismo;
          $nombre_y_apellido_de_la_victima_dem= $DemandaACaso->nombre_y_apellido_de_la_victima;
          $fecha_delito_dem= $DemandaACaso->fecha_delito;
          $fecha_hecho_dem= $DemandaACaso->fecha_hecho;
          $fecha_hecho_otro_dem = $DemandaACaso->fecha_hecho_otro;
          $pais_hecho_dem= $DemandaACaso->pais_hecho;
          $pais_hecho_otro_dem= $DemandaACaso->pais_hecho_otro;
          $provincia_hecho_dem= $DemandaACaso->provincia_hecho;
          $localidad_hecho_dem= $DemandaACaso->localidad_hecho;
          session(["idDemanda" => $id]);
          
          session(["DemandaCte" => "1"]);
             return view("agregarCaso",compact("delitos","provincias", "ciudades","cavajs","usuarios","organismos","departamentos","fecha_ingreso_dem","delito_dem","otro_delito_dem","modalidad_ingreso_dem","organismo_dem","cual_otro_organismo_dem","nombre_y_apellido_de_la_victima_dem","fecha_delito_dem","fecha_hecho_dem","fecha_hecho_otro_dem","pais_hecho_dem","pais_hecho_otro_dem","provincia_hecho_dem","localidad_hecho_dem"));



}

     public function Caso(Request $form){
          
$hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));
    $reglas = [

"nombre_referencia" => "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/",

"delito" => "required",
"descripcion_caso" => "required|min:3|regex:/^([0-9a-zA-ZñÑ.,\s*-])+$/",
"fecha_ingreso" => "required|date_format:Y-m-d|before:$hoy|after:1899-12-31",
"modalidad_ingreso" => "required",
"cavaj" => "required",
"comisaria" => "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/",
"denuncias_previas" => "required",
"departamento_judicial" => "required",
"estado" => "required",
"nombre_y_apellido_de_la_victima" => "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/",
"fecha_delito"=>"required",
"pais_hecho"=>"required",



    ];

$validator = Validator::make($form->all(), $reglas);

 $validator->sometimes('organismo', 'required', function ($input) {
  return $input->modalidad_ingreso == 3;
    });

  $validator->sometimes('cual_otro_organismo', "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/", function ($input) {
  return $input->organismo == 24;
    });




$validator->sometimes('organismo', 'required', function ($input) {
return $input->modalidad_ingreso == 3;
  });

$validator->sometimes('motivospasivos', 'required', function ($input) {
return $input->estado == 2;
  });

$validator->sometimes('cual_otro_motivospasivos', "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.,\s*-])+$/", function ($input) {
return $input->motivospasivos == 5;
  });






$validator->sometimes('otro_delito', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
return $input->delito == 36;
  });

  $validator->sometimes('fecha_hecho', "required|date_format:Y-m-d|before:$hoy|after:1899-12-31", function ($input) {
    return $input->fecha_delito == 1;
  });

  $validator->sometimes('fecha_hecho_otro', "required|min:3|max:100|regex:/^([0-9a-zA-ZñÑ.,\s*-])+$/", function ($input) {
    return $input->fecha_delito == 2;
  });

  $validator->sometimes('provincia_hecho', 'required', function ($input) {
return $input->pais_hecho == 1;
  });

    $validator->sometimes('localidad_hecho', 'required', function ($input) {
return $input->pais_hecho == 1;
  
  });

  $validator->sometimes('localidad_hecho', 'required', function ($input) {
return (
  $input->provincia_hecho == 1||$input->provincia_hecho == 2||$input->provincia_hecho == 3||$input->provincia_hecho == 4||$input->provincia_hecho == 5||$input->provincia_hecho == 6||$input->provincia_hecho == 7||$input->provincia_hecho == 8||$input->provincia_hecho == 9||$input->provincia_hecho == 10||$input->provincia_hecho == 11||$input->provincia_hecho == 12||$input->provincia_hecho == 13||$input->provincia_hecho == 14||$input->provincia_hecho == 15||$input->provincia_hecho == 16||$input->provincia_hecho == 17||$input->provincia_hecho == 18||$input->provincia_hecho == 19||$input->provincia_hecho == 20||$input->provincia_hecho == 21||$input->provincia_hecho == 22||$input->provincia_hecho == 23||$input->provincia_hecho == 24);
  });


  $validator->sometimes('localidad_hecho', 'required', function ($input) {
return 
  $input->localidad_hecho == 4090;
  });



    $validator->sometimes('pais_hecho_otro', "required|min:3|max:100|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
return $input->pais_hecho == 3;
  });
 


if ($validator->fails()) {
    return back()
        ->withErrors($validator)
        ->withInput();
        }
      

          $user = Auth::user();
          $caso= new Caso();
          $caso->nombre_referencia= $form["nombre_referencia"];
          $caso->nro_carpeta= $form["nro_carpeta"];
          $caso->delito= $form["delito"];
          $caso->otro_delito= $form["otro_delito"];
          $caso->descripcion_caso= $form["descripcion_caso"];
          $caso->fecha_ingreso= $form["fecha_ingreso"];
          $caso->modalidad_ingreso= $form["modalidad_ingreso"];
          $caso->organismo= $form["organismo"];
          $caso->cual_otro_organismo= $form["cual_otro_organismo"];
          $caso->cavaj= $form["cavaj"];
          $caso->comisaria= $form["comisaria"];
          $caso->denuncias_previas= $form["denuncias_previas"];
          $caso->departamento_judicial= $form["departamento_judicial"];
          $caso->estado= $form["estado"];
          $caso->nombre_y_apellido_de_la_victima=$form["nombre_y_apellido_de_la_victima"];
          $caso->motivospasivos= $form["motivospasivos"];
          $caso->cual_otro_motivospasivo= $form["cual_otro_motivospasivos"];
          $caso->fecha_delito= $form ["fecha_delito"];
          $caso->fecha_hecho= $form ["fecha_hecho"];
          $caso->fecha_hecho_otro  = $form ["fecha_hecho_otro"];
          $caso->pais_hecho= $form ["pais_hecho"];
          $caso->pais_hecho_otro= $form ["pais_hecho_otro"];
          $caso->provincia_hecho= $form ["provincia_hecho"];
          $caso->localidad_hecho= $form ["localidad_hecho"];
          $caso->activo=1;
          $caso->userID_create= Auth::id();
          $caso->sede=$user->getSede();
          $caso->save();
          $idCaso = $caso->id;

          session(["idCaso" => $idCaso]);
return redirect("agregarProfesional");


}


}
