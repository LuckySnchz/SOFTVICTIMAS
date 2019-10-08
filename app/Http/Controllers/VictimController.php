<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Victim;
use App\Necesidad;
use App\Programa;
use App\Limitacion;
use App\Discapacidad;
use App\Intervencion;
use App\Persona;
use App\Conviviente;
use App\Imputado;


use Validator;

class VictimController extends Controller
{


public function agregar(Request $form){



 $hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));
 $reglas = [
  "victima_nombre_y_apellido"=>"required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/",
  "genero"=>"required|integer",
  "victima_fecha_nacimiento"=> "required|date_format:Y-m-d|before:$hoy|after:1899-12-31",
  'telefono_victima'=>'required|regex:/^([0-9-])+$/',
  'domicilio_victima_asistida'=>'required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/',
  'localidad_hecho'=> 'required',
  'otro_telefono_victima'=>'required|regex:/^([0-9-])+$/',
  "victima_edad"=>"required|integer",
  "franjaetaria"=>"required",
  "tienedoc"=>"required|integer",
  "niveleducativo"=>"required|integer",
  "condiciones_de_trabajo"=>"required|integer",
  "necesidades_socioeconomicas_insatisfechas"=>"required",
  "programa_subsidio"=>"required|integer",
  "tiene_discapacidad"=>"required",
  "tienelesion"=>"required|integer",
  "enfermedadcronica"=>"required|integer",
  "persona_asistida"=>"required",
  "otras_personas_asistidas"=>"required",
  "tiene_limitacion"=>"required"
];

  $validator = Validator::make($form->all(), $reglas);

  $validator->sometimes('embarazorelevamiento', 'required|integer', function ($input) {
    return $input->genero == 1;
   });

  $validator->sometimes('embarazorelevamiento', 'required|integer', function ($input) {
   return $input->genero == 4;
    });

  $validator->sometimes('embarazorelevamiento', 'required|integer', function ($input) {
    return $input->genero == 5;
   });


  $validator->sometimes('tipodocumento', 'required', function ($input) {
    return ($input->tienedoc == 1||$input->tienedoc == 3);
   });


 $validator->sometimes('victima_numero_documento', 'required|integer|max:2147483646', function ($input) {
      return ($input->tipodocumento == 1|| $input->tipodocumento == 2||$input->tipodocumento == 3||$input->tipodocumento == 4||$input->tipodocumento == 5||$input->tipodocumento == 6||$input->tipodocumento == 9);
     });

  

    $validator->sometimes('victima_numero_documento', 'required|integer|max:2147483646', function ($input) {
      return ($input->tienedoc == 1|| $input->tienedoc == 3);
     });


     


     $validator->sometimes('tipo_documento_otro', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
       return $input->tipodocumento == 9;
      });

   $validator->sometimes('residenciaprecaria', 'required', function ($input) {
     return $input->tipodocumento == 6;
    });
   $validator->sometimes('necesidades', 'required', function ($input) {
     return $input->necesidades_socioeconomicas_insatisfechas == 1;
   });
  $validator->sometimes('programas', 'required', function ($input) {
      return $input->programa_subsidio == 1;
   });

   $validator->sometimes('discapacidades', 'required', function ($input) {
       return $input->tiene_discapacidad == 1;
    });

    $validator->sometimes('tipo_lesion', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
     return $input->tienelesion == 1;
   });
    $validator->sometimes('tipo_enfermedad_cronica', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
     return $input->enfermedadcronica == 1;
    });

    $validator->sometimes('limitaciones', 'required', function ($input) {
     return $input->tiene_limitacion == 1;
    });

    $validator->sometimes('necesidades_socioeconomicas_insatisfechas_otro', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
    return is_array($input->necesidades) && in_array(8,$input->necesidades);
    });

    $validator->sometimes('programa_subsidio_otro', "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/", function ($input) {
    return is_array($input->programas) && in_array(5,$input->programas);
    });

    $validator->sometimes('limitacion_otro', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
    return is_array($input->limitaciones) && in_array(4,$input->limitaciones);
    });

   if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                   ->withInput();
    }

    $victim= new Victim( );

    $victim->victima_nombre_y_apellido= $form ["victima_nombre_y_apellido"];
    $victim->telefono_victima= $form ["telefono_victima"];
    $victim->otro_telefono_victima= $form ["otro_telefono_victima"];
    $victim->domicilio_victima_asistida=$form["domicilio_victima_asistida"]; 
    $victim->localidad_hecho=$form["localidad_hecho"];
    $victim->genero= $form ["genero"];
    $victim->victima_fecha_nacimiento= $form ["victima_fecha_nacimiento"];
    $victim->victima_edad= $form ["victima_edad"];
    $victim->franjaetaria= $form ["franjaetaria"];
    $victim->tienedoc= $form ["tienedoc"];
    $victim->tipodocumento= $form ["tipodocumento"];
    $victim->tipo_documento_otro= $form ["tipo_documento_otro"];
    $victim->residenciaprecaria= $form ["residenciaprecaria"];
    $victim->victima_numero_documento= $form ["victima_numero_documento"];
    $victim->niveleducativo= $form ["niveleducativo"];
    $victim->condiciones_de_trabajo= $form ["condiciones_de_trabajo"];
    $victim->necesidades_socioeconomicas_insatisfechas= $form ["necesidades_socioeconomicas_insatisfechas"];
    $victim->necesidades_socioeconomicas_insatisfechas_otro= $form ["necesidades_socioeconomicas_insatisfechas_otro"];
    $victim->programa_subsidio= $form ["programa_subsidio"];
    $victim->programa_subsidio_otro= $form ["programa_subsidio_otro"];
    $victim->embarazorelevamiento= $form ["embarazorelevamiento"];
    $victim->tiene_discapacidad= $form ["tiene_discapacidad"];
    $victim->tienelesion= $form ["tienelesion"];
    $victim->tipo_lesion= $form ["tipo_lesion"];
    $victim->enfermedadcronica= $form ["enfermedadcronica"];
    $victim->tipo_enfermedad_cronica= $form ["tipo_enfermedad_cronica"];
    $victim->tiene_limitacion= $form ["tiene_limitacion"];
    $victim->limitacion_otro= $form ["limitacion_otro"];
    $victim->persona_asistida= $form["persona_asistida"];
    $victim->otras_personas_asistidas= $form["otras_personas_asistidas"];
    $victim->idCaso= session("idCaso");
    $victim->userID_create= Auth::id();

    $victim->save();

    $idVictim= $victim->id;

    session(["idVictim" => $idVictim]);


    if (is_array($form["necesidades"])){
    foreach ($form["necesidades"] as $necesidad) {
    $victim->necesidades()->attach($necesidad);}}

    if (is_array($form["programas"])){
    foreach ($form["programas"] as $programa) {
    $victim->programas()->attach($programa);}}

    if (is_array($form["discapacidades"])){
    foreach ($form["discapacidades"] as $discapacidad) {
    $victim->discapacidades()->attach($discapacidad);}}

    if (is_array($form["limitaciones"])){
    foreach ($form["limitaciones"] as $limitacion) {
    $victim->limitaciones()->attach($limitacion);}}

    if($form["otras_personas_asistidas"] == 1){
      return redirect ("agregarPersona");}


      else{
        return redirect ("agregarconviviente");
      }

    }

    public function detalle($id) {

        $victima = Victim::find($id);


        $vac = compact("victima");

        return view("detalleVictima", $vac);
      }

      public function eliminarvictima($id) {

    $Intervenciones=Intervencion::all();
       foreach ($Intervenciones as $Intervencion) {
         if($Intervencion->idVictim==$id){
   
                $Intervencion->delete();
         }
       }

       $Personas=Persona::all();
       foreach ($Personas as $Persona) {
         if($Persona->idVictim==$id){
   
                $Persona->delete();
         }
       }

         $Convivientes=Conviviente::all();
       foreach ($Convivientes as $Conviviente) {
         if($Conviviente->idVictim==$id){
   
                $Conviviente->delete();
         }
       }

         $Imputados=Imputado::all();
       foreach ($Imputados as $Imputado) {
         if($Imputado->idVictim==$id){
   
                $Imputado->delete();
         }
       }

         $victimaelim=Victim::find($id)->getIdCaso();
        $victima = Victim::find($id);
        $victima->delete();
          return redirect("paneldecontrolvictima/{$victimaelim}#B");

      }


    public function editar(Request $form) {

        $victim = Victim::find($form["idVictima"]);

        $victim->victima_nombre_y_apellido= $form ["victima_nombre_y_apellido"];
        $victim->telefono_victima= $form ["telefono_victima"];
        $victim->otro_telefono_victima= $form ["otro_telefono_victima"];
        $victim->domicilio_victima_asistida=$form["domicilio_victima_asistida"];
        $victim->localidad_hecho=$form["localidad_hecho"];
        $victim->genero= $form ["genero"];
        $victim->victima_fecha_nacimiento= $form ["victima_fecha_nacimiento"];
        $victim->victima_edad= $form ["victima_edad"];
        $victim->franjaetaria= $form ["franjaetaria"];
        $victim->tienedoc= $form ["tienedoc"];
        $victim->tipodocumento= $form ["tipodocumento"];
        $victim->tipo_documento_otro= $form ["tipo_documento_otro"];
        $victim->residenciaprecaria= $form ["residenciaprecaria"];
        $victim->victima_numero_documento= $form ["victima_numero_documento"];
        $victim->niveleducativo= $form ["niveleducativo"];
        $victim->condiciones_de_trabajo= $form ["condiciones_de_trabajo"];
        $victim->necesidades_socioeconomicas_insatisfechas= $form ["necesidades_socioeconomicas_insatisfechas"];
        $victim->necesidades_socioeconomicas_insatisfechas_otro= $form ["necesidades_socioeconomicas_insatisfechas_otro"];
        $victim->programa_subsidio= $form ["programa_subsidio"];
        $victim->programa_subsidio_otro= $form ["programa_subsidio_otro"];
        $victim->embarazorelevamiento= $form ["embarazorelevamiento"];
        $victim->tienelesion= $form ["tienelesion"];
        $victim->tipo_lesion= $form ["tipo_lesion"];
        $victim->enfermedadcronica= $form ["enfermedadcronica"];
        $victim->tipo_enfermedad_cronica= $form ["tipo_enfermedad_cronica"];
        $victim->limitacion_otro= $form ["limitacion_otro"];

        $victim->idCaso= $form ["idCaso"];

             $victim->save();
             foreach ($form["necesidades"] as $necesidad) {
             $victim->necesidades()->attach($necesidad);}

             foreach ($form["programas"] as $programa) {
             $victim->programas()->attach($programa);}

             foreach ($form["discapacidades"] as $discapacidad) {
             $victim->discapacidades()->attach($discapacidad);}

             foreach ($form["limitaciones"] as $limitacion) {
             $victim->limitaciones()->attach($limitacion);}














              return redirect("home");}





    }
