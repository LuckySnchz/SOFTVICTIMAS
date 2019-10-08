<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Institucion;
use App\Socioeconomico;
use App\Oprevio;
use App\Oarticula;
use App\Departamento;
use App\Asistencia;
use Validator;
class InstitucionPanelController extends Controller
{
 public function agregar(Request $form){

 
$hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));

   $reglas = [
   "organismos_intervinieron"=>"required",
   "requiere_asistencia"=>"required",
   "abogado_particular"=>"required",
   "organismo_articula_si_no"=>"required"

   ];


   $validator = Validator::make($form->all(), $reglas);

   $validator->sometimes('pratocinio_gratuito', 'required', function ($input) {
     return $input->abogado_particular == 2;
   });

   $validator->sometimes('pratocinio_gratuito', 'required', function ($input) {
     return $input->abogado_particular == 3;
   });

   $validator->sometimes('oarticulas', 'required', function ($input) {
     return $input->organismo_articula_si_no == 1;
   });

   $validator->sometimes('oprevios', 'required', function ($input) {
     return $input->organismos_intervinieron == 1;
   });

   $validator->sometimes('cual_otro_organismo', "required|min:3|max:1000|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/", function ($input) {
   return is_array($input->oprevios) && in_array(24,$input->oprevios);
   });

   $validator->sometimes('fecha_de_solicitud', "date_format:Y-m-d|before:$hoy|after:1899-12-31", function ($input) {
     return $input->pratocinio_gratuito == 1;
   });

   $validator->sometimes('fecha_de_solicitud', "date_format:Y-m-d|before:$hoy|after:1899-12-31", function ($input) {
     return $input->pratocinio_gratuito == 2;
   });

   $validator->sometimes('letrado_designado', "required|min:3|max:1000|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/", function ($input) {
     return $input->pratocinio_gratuito == 3;
   });

   $validator->sometimes('pratocinio_conformidad', 'required', function ($input) {
     return $input->pratocinio_gratuito == 3;
   });

   $validator->sometimes('colegio_departamental', 'required', function ($input) {
     return $input->pratocinio_gratuito == 3;
   });

   $validator->sometimes('fecha_designacion', "required|date_format:Y-m-d|before:$hoy|after:1899-12-31", function ($input) {
     return $input->pratocinio_gratuito == 3;
   });

    $validator->sometimes('fecha_solicitud_designacion', "required|date_format:Y-m-d|before:$hoy|after:1899-12-31", function ($input) {
     return $input->pratocinio_gratuito == 3;
   });

   $validator->sometimes('organismos_actual_otro', "required|min:3|max:1000|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/", function ($input) {
   return is_array($input->oarticulas) && in_array(24,$input->oarticulas);
   });

   $validator->sometimes('socioeconomica_otro', "required|min:3|max:1000|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/", function ($input) {
     return is_array($input->socioeconomicos) && in_array(6,$input->socioeconomicos);
   });


    $validator->sometimes('asistencias','required',function ($input) {
     return $input->requiere_asistencia == 1;
   });

 $validator->sometimes('socioeconomicos', 'required', function ($input) {
    return is_array($input->tipo_asistencia) && in_array(3,$input->tipo_asistencia);
   });



   if ($validator->fails()) {
       return back()
                   ->withErrors($validator)
                   ->withInput();
   }


$institucion= new Institucion();

$institucion->organismos_intervinieron= $form ["organismos_intervinieron"];
$institucion->cual_otro_organismo= $form ["cual_otro_organismo"];
$institucion->requiere_asistencia= $form ["requiere_asistencia"];
$institucion->socioeconomica_otro= $form["socioeconomica_otro"];
$institucion->organismo_articula_si_no= $form["organismo_articula_si_no"];
$institucion->organismos_actual_otro= $form["organismos_actual_otro"];
$institucion->pratocinio_gratuito= $form["pratocinio_gratuito"];
$institucion->fecha_de_solicitud= $form["fecha_de_solicitud"];
$institucion->letrado_designado= $form ["letrado_designado"];
$institucion->pratocinio_conformidad= $form ["pratocinio_conformidad"];
$institucion->colegio_departamental= $form ["colegio_departamental"];
$institucion->fecha_solicitud_designacion= $form ["fecha_solicitud_designacion"];
$institucion->fecha_designacion= $form ["fecha_designacion"];
$institucion->abogado_particular= $form ["abogado_particular"];
$institucion->idCaso= session("idCaso");
$institucion->userID_create= Auth::id();

$institucion->save();




/*if (is_array($form["oprevios"])){
foreach ($form["oprevios"] as $oprevio) {
  $institucion->oprevios()->attach($oprevio);}
}

foreach ($form["oarticulas"] as $oarticula) {
  $institucion->oarticulas()->attach($oarticula);}

if (is_array($form["socioeconomicos"])){
foreach ($form["socioeconomicos"] as $socioeconomico) {
  $institucion->socioeconomicos()->attach($socioeconomico);}
}*/

return redirect ("agregarDocumento");

}

public function detalle($id) {

  $institucion = Institucion::find($id);
  $instituciones = Institucion::all();
  session(["idOrganismo" => $id]);
  $socioeconomicos = Socioeconomico::all();
  $oprevios = Oprevio::all();
  $oarticulas = Oarticula::all();
  $asistencias= Asistencia::all();
  $organismos_intervinieron=$institucion->organismos_intervinieron;
  $cual_otro_organismo=$institucion->cual_otro_organismo;
  $requiere_asistencia=$institucion->requiere_asistencia;
  $asistencia_juridica=$institucion->asistencia_juridica;
  $asistencia_socioeconomica=$institucion->asistencia_socioeconomica;
  $socioeconomica_otro=$institucion->socioeconomica_otro;
  $asistencia_psicologica=$institucion->asistencia_psicologica;
  $organismo_articula_si_no=$institucion->organismo_articula_si_no;
  $organismos_actual_otro=$institucion->organismos_actual_otro;
  $pratocinio_gratuito=$institucion->pratocinio_gratuito;
  $fecha_de_solicitud=$institucion->fecha_de_solicitud;
  $fecha_solicitud_designacion= $institucion->fecha_solicitud_designacion;
  $letrado_designado=$institucion->letrado_designado;
  $pratocinio_conformidad=$institucion->pratocinio_conformidad;
  $colegio_departamental=$institucion->colegio_departamental;
  $fecha_designacion=$institucion->fecha_designacion;

  $departamentos=Departamento::all();
  $abogado_particular=$institucion->abogado_particular;
  $vac = compact("institucion","instituciones","socioeconomicos","oprevios","oarticulas","organismos_intervinieron","cual_otro_organismo","requiere_asistencia","asistencia_juridica","asistencia_psicologica","asistencia_socioeconomica","socioeconomica_otro",
    "pratocinio_gratuito","letrado_designado","pratocinio_conformidad","colegio_departamental","departamentos","abogado_particular","organismo_articula_si_no","fecha_de_solicitud","fecha_solicitud_designacion","fecha_designacion","organismos_actual_otro","asistencias");
  return view("detalleOrganismo", $vac);
  }

  public function eliminar($id) {
    $institucion = Institucion::find($id);
    $institucion->delete();
      return redirect("agregarOrganismo");

  }

  public function editar(Request $form) {
$hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));

    $reglas = [
    "organismos_intervinieron"=>"required",
    "requiere_asistencia"=>"required",
    "abogado_particular"=>"required",
    "organismo_articula_si_no"=>"required"

    ];


    $validator = Validator::make($form->all(), $reglas);

    $validator->sometimes('pratocinio_gratuito', 'required', function ($input) {
      return $input->abogado_particular == 2;
    });

    $validator->sometimes('pratocinio_gratuito', 'required', function ($input) {
      return $input->abogado_particular == 3;
    });

    $validator->sometimes('oarticulas', 'required', function ($input) {
      return $input->organismo_articula_si_no == 1;
    });

    $validator->sometimes('oprevios', 'required', function ($input) {
      return $input->organismos_intervinieron == 1;
    });

    $validator->sometimes('cual_otro_organismo', "required|min:3|max:1000|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/", function ($input) {
    return is_array($input->oprevios) && in_array(24,$input->oprevios);
    });

    $validator->sometimes('fecha_de_solicitud', "date_format:Y-m-d|before:$hoy|after:1899-12-31", function ($input) {
      return $input->pratocinio_gratuito == 1;
    });

    $validator->sometimes('fecha_de_solicitud', "date_format:Y-m-d|before:$hoy|after:1899-12-31", function ($input) {
      return $input->pratocinio_gratuito == 2;
    });

    $validator->sometimes('letrado_designado', "required|min:3|max:1000|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/", function ($input) {
      return $input->pratocinio_gratuito == 3;
    });

    $validator->sometimes('pratocinio_conformidad', 'required', function ($input) {
      return $input->pratocinio_gratuito == 3;
    });

    $validator->sometimes('colegio_departamental', 'required', function ($input) {
      return $input->pratocinio_gratuito == 3;
    });

    $validator->sometimes('fecha_designacion', "date_format:Y-m-d|before:$hoy|after:1899-12-31", function ($input) {
      return $input->pratocinio_gratuito == 3;
    });

     $validator->sometimes('fecha_solicitud_designacion', "date_format:Y-m-d|before:$hoy|after:1899-12-31", function ($input) {
      return $input->pratocinio_gratuito == 3;
    });

    $validator->sometimes('organismos_actual_otro', "required|min:3|max:1000|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/", function ($input) {
    return is_array($input->oarticulas) && in_array(24,$input->oarticulas);
    });

    $validator->sometimes('socioeconomica_otro', "required|min:3|max:1000|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/", function ($input) {
      return is_array($input->socioeconomicos) && in_array(6,$input->socioeconomicos);
    });


    $validator->sometimes('socioeconomicos', 'required', function ($input) {
      return is_array($input->asistencias) && in_array(3,$input->asistencias);
    });

 $validator->sometimes('asistencias','required',function ($input) {
     return $input->requiere_asistencia == 1;
   });


    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }


$institucion = Institucion::find($form["idOrganismo"]);
$institucion->organismos_intervinieron= $form ["organismos_intervinieron"];
$institucion->cual_otro_organismo= $form ["cual_otro_organismo"];
$institucion->requiere_asistencia= $form ["requiere_asistencia"];
$institucion->socioeconomica_otro= $form["socioeconomica_otro"];
$institucion->organismo_articula_si_no= $form["organismo_articula_si_no"];
$institucion->organismos_actual_otro= $form["organismos_actual_otro"];
$institucion->pratocinio_gratuito= $form["pratocinio_gratuito"];
$institucion->fecha_de_solicitud= $form["fecha_de_solicitud"];
$institucion->fecha_solicitud_designacion= $form ["fecha_solicitud_designacion"];
$institucion->letrado_designado= $form ["letrado_designado"];
$institucion->pratocinio_conformidad= $form ["pratocinio_conformidad"];
$institucion->colegio_departamental= $form ["colegio_departamental"];
$institucion->fecha_designacion= $form ["fecha_designacion"];
$institucion->abogado_particular= $form ["abogado_particular"];

$institucion->idCaso= session("idCaso");

$institucion->userID_modify= Auth::id();


     $institucion->save();
      $institucion->asistencias()->sync($form["asistencias"]);
      $institucion->oprevios()->sync($form["oprevios"]);
      $institucion->socioeconomicos()->sync($form["socioeconomicos"]);
      $institucion->oarticulas()->sync($form["oarticulas"]);
      return redirect("paneldecontrolcaso/{$institucion->idCaso}#c3");}


}
