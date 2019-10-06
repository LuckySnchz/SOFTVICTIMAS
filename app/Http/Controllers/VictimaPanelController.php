<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Victim;
use App\Necesidad;
use App\Programa;
use App\Limitacion;
use App\Discapacidad;
use App\Caso;
use App\Delito;
use Validator;

class VictimaPanelController extends Controller
{


public function agregar(Request $form){

 $hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));
 $reglas = [
  "victima_nombre_y_apellido"=>"required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/",
  "genero"=>"required|integer",
  "victima_fecha_nacimiento"=> "required|date_format:Y-m-d|before:$hoy|after:1899-12-31",
 'telefono_victima'=>'required|regex:/^([0-9-])+$/',
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
    return ($input->tienedoc == 1||$input->tienedoc == 5);
   });


 $validator->sometimes('victima_numero_documento', 'required|integer|max:2147483646', function ($input) {
      return ($input->tipodocumento == 1|| $input->tipodocumento == 2||$input->tipodocumento == 3||$input->tipodocumento == 4||$input->tipodocumento == 5||$input->tipodocumento == 6||$input->tipodocumento == 9);
     });

  

    $validator->sometimes('victima_numero_documento', 'required|integer|max:2147483646', function ($input) {
      return (($input->tienedoc == 1|| $input->tienedoc == 5)&&($input->tipodocumento == 1|| $input->tipodocumento == 2||$input->tipodocumento == 3||$input->tipodocumento == 4||$input->tipodocumento == 5||$input->tipodocumento == 6||$input->tipodocumento == 9));
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
    $victim->genero= $form ["genero"];
    $victim->victima_fecha_nacimiento= $form ["victima_fecha_nacimiento"];
    $victim->victima_edad= $form ["victima_edad"];
    $victim->franjaetaria= $form ["franjaetaria"];
    $victim->tienedoc= $form ["tienedoc"];
    $victim->tipodocumento= $form ["tipodocumento"];
    $victim->telefono_victima= $form ["telefono_victima"];
    $victim->otro_telefono_victima= $form ["otro_telefono_victima"];
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
    
  return redirect ("paneldecontrolvictima/{$victim->idCaso}#v1");
   

    }
    

      public function eliminar($id) {
        $victima = Victim::find($id);
        $victima->delete();
          return redirect("agregarVictima");

      }


   public function detalle($id) {
   $victim = Victim::find($id);
    $victimas = Victim::all();
    session(["idVictima" => $id]);
    $necesidades = Necesidad::all();
    $programas = Programa::all();
    $discapacidades = Discapacidad::all();
    $limitaciones = Limitacion::all();

        $victima_nombre_y_apellido=$victim->victima_nombre_y_apellido;
        $telefono_victima=$victim->telefono_victima;
        $otro_telefono_victima=$victim->otro_telefono_victima;
        $genero=$victim->genero;
        $victima_fecha_nacimiento=$victim->victima_fecha_nacimiento;
        $victima_edad=$victim->victima_edad;
        $franjaetaria=$victim->franjaetaria;
        $tienedoc=$victim->tienedoc;
        $tipodocumento=$victim->tipodocumento;
        $tipo_documento_otro= $victim->tipo_documento_otro;
        $residenciaprecaria=$victim->residenciaprecaria;
        $victima_numero_documento=$victim->victima_numero_documento;
        $niveleducativo=$victim->niveleducativo;
        $condiciones_de_trabajo=$victim->condiciones_de_trabajo;
        $necesidades_socioeconomicas_insatisfechas=$victim->necesidades_socioeconomicas_insatisfechas;
        $necesidades_socioeconomicas_insatisfechas_otro=$victim->necesidades_socioeconomicas_insatisfechas_otro;
        $programa_subsidio=$victim->programa_subsidio;
        $programa_subsidio_otro=$victim->programa_subsidio_otro;
        $embarazorelevamiento=$victim->embarazorelevamiento;
          $tiene_discapacidad=$victim->tiene_discapacidad;
       $tienelesion= $victim->tienelesion;
       $tipo_lesion= $victim->tipo_lesion;
       $enfermedadcronica= $victim->enfermedadcronica;
        $tiene_limitacion= $victim->tiene_limitacion;
        $tipo_enfermedad_cronica=$victim->tipo_enfermedad_cronica;
        $limitacion_otro=$victim->limitacion_otro;

        $persona_asistida=$victim->persona_asistida;       
        $otras_personas_asistidas=$victim->otras_personas_asistidas;



               return view("detalleVictima",compact("victimas","victim","victima_nombre_y_apellido","genero","victima_fecha_nacimiento","victima_edad","franjaetaria","tienedoc","tipodocumento","tipo_documento_otro","residenciaprecaria","victima_numero_documento","niveleducativo","condiciones_de_trabajo","necesidades_socioeconomicas_insatisfechas","necesidades_socioeconomicas_insatisfechas_otro","programa_subsidio","programa_subsidio_otro","tiene_discapacidad","embarazorelevamiento","tienelesion","tipo_lesion","enfermedadcronica","enfermedadcronica","tipo_enfermedad_cronica","limitacion_otro","necesidades","programas","tiene_limitacion","limitaciones","discapacidades","persona_asistida","otras_personas_asistidas"));

    }


     public function victima($id,$idCaso) {
   
   session(["idVictim" => $id]);
   session(["idCaso" => $idCaso]);


   
  
    

return redirect("paneldecontrolvictima/{$idCaso}");

    }


   


    public function editar(Request $form) {



 $hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));
 $reglas = [
  "victima_nombre_y_apellido"=>"required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/",
  "genero"=>"required|integer",
  "victima_fecha_nacimiento"=> "required|date_format:Y-m-d|before:$hoy|after:1899-12-31",
 'telefono_victima'=>'required|regex:/^([0-9-])+$/',
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
    return $input->tienedoc == 1;
   });

   $validator->sometimes('victima_numero_documento', 'required|integer|max:2147483646', function ($input) {
     return $input->tienedoc == 1;
    });

   $validator->sometimes('tipodocumento', 'required', function ($input) {
     return $input->tienedoc == 5;
    });

    $validator->sometimes('victima_numero_documento', 'required|integer|max:2147483646', function ($input) {
      return $input->tienedoc == 1;
     });

     $validator->sometimes('victima_numero_documento', 'required|integer|max:2147483646', function ($input) {
       return $input->tienedoc == 5;
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




   $victim= Victim::find($form["idVictima"]);


        $victim->victima_nombre_y_apellido= $form ["victima_nombre_y_apellido"];
        $victim->telefono_victima= $form ["telefono_victima"];
        $victim->otro_telefono_victima= $form ["otro_telefono_victima"];
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
        $victim->persona_asistida= $form ["persona_asistida"];       
        $victim->otras_personas_asistidas= $form ["otras_personas_asistidas"];

        $victim->idCaso= session("idCaso");
         $victim->userID_modify= Auth::id();

             $victim->save();

      $victim->necesidades()->sync($form["necesidades"]);
      $victim->programas()->sync($form["programas"]);
      $victim->discapacidades()->sync($form["discapacidades"]);
      $victim->limitaciones()->sync($form["limitaciones"]);
             
          return redirect("paneldecontrolvictima/{$victim->idCaso}#v1");




}
    }

