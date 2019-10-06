<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CollectionPHP;
use Illuminate\Support\Collection as Collection;
use App\Caso;
use App\Delito;
use Validator;
use App\Cavaj;
use App\Usuario;
use App\User;
use App\Organismo;
use App\Departamento;
use App\Imputado;
use App\Provincia;
use App\Ciudad;
use App\Demanda;
use App\Derivacion;
use App\Oderivados;
use App\Tipo_demandas;
use App\MiModelo;
use App\Profesional;


class CasoPanelController extends Controller
{

  public function editar(Request $form){

$hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));
    $reglas = [

 "nombre_referencia" => "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/",

 "delito" => "required",
 "descripcion_caso" => "required|min:3|max:10000|regex:/^([0-9a-zA-ZñÑ.,@\s*-])+$/",
 "fecha_ingreso" => "required|date_format:Y-m-d|before:$hoy",
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

 $validator->sometimes('motivospasivos', 'required', function ($input) {
 return $input->estado == 2;
  });

 $validator->sometimes('cual_otro_motivospasivos', "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.,\s*-])+$/", function ($input) {
 return $input->motivospasivos == 5;
  });

 $validator->sometimes('cual_otro_organismo', "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/", function ($input) {
 return $input->organismo == 24;
  });

 $validator->sometimes('otro_delito', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
 return $input->delito == 73;
  });

  $validator->sometimes('fecha_hecho', "date_format:Y-m-d|before:$hoy|after:1899-12-31", function ($input) {
    return $input->fecha_delito == 1;
  });

  $validator->sometimes('fecha_hecho_otro', "required|min:3|max:100|regex:/^([0-9a-zA-ZñÑ.,\s*-])+$/", function ($input) {
    return $input->fecha_delito == 2;
  });
 $validator->sometimes('provincia_hecho', 'required', function ($input) {
return $input->pais_hecho == 1;
  });
 

 $validator->sometimes('localidad_hecho', 'required', function ($input) {
return $input-> provincia_hecho > 0 && $input-> provincia_hecho < 25;
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

$caso = Caso::find($form["idCaso"]);

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
$caso->userID_modify= Auth::id();

$caso->sede=$user->getSede();


$caso->save();

$idCaso = $caso->id;

session(["idCaso" => $idCaso]);


          /* $caso->delitos()->sync($form["delitos"]);

           $caso->cavajs()->sync($form["cavaj"]);

          $caso->organismos()->sync($form["organismos"]);

          $idCaso= session("idCaso");*/
          return redirect("/paneldecontrolcaso/{$idCaso}#c1");



}



 public function editardemandaAcaso(Request $form){

$hoy = date("d-m-Y");

    $hoy = date("d-m-Y",strtotime($hoy."+ 1 days"));
    $reglas = [

 "nombre_referencia" => "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/",

 "descripcion_caso" => "required|min:3|max:10000|regex:/^([0-9a-zA-ZñÑ.,@\s*-])+$/",
 "fecha_ingreso" => "required|date_format:Y-m-d|before:$hoy",
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

 $validator->sometimes('motivospasivos', 'required', function ($input) {
 return $input->estado == 2;
  });

 $validator->sometimes('cual_otro_motivospasivos', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
 return $input->motivospasivos == 5;
  });

 $validator->sometimes('cual_otro_organismo', "required|min:3|max:255|regex:/^([0-9a-zA-ZñÑ.\s*-])+$/", function ($input) {
 return $input->organismo == 24;
  });

 $validator->sometimes('otro_delito', "required|min:3|max:255|regex:/^([a-zA-ZñÑ.\s*-])+$/", function ($input) {
 return $input->delito == 73;
  });

  $validator->sometimes('fecha_hecho', "date_format:Y-m-d|before:$hoy|after:1899-12-31", function ($input) {
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

  $validator->sometimes('pais_hecho_otro', 'required', function ($input) {
return $input->pais_hecho == 3;
  });

 if ($validator->fails()) {
    return back()
        ->withErrors($validator)
        ->withInput();
        }

$user = Auth::user();

$caso = Caso::find($form["idCaso"]);

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
$caso->userID_modify= Auth::id();

$caso->sede=$user->getSede();


$caso->save();

$idCaso = $caso->id;

session(["idCaso" => $idCaso]);


          /* $caso->delitos()->sync($form["delitos"]);

           $caso->cavajs()->sync($form["cavaj"]);

          $caso->organismos()->sync($form["organismos"]);

          $idCaso= session("idCaso");*/
          return redirect("/agregarProfesional");



}


public function detalle($id) {

      $provincias = Provincia::all();
      $ciudades = Ciudad::all();
      $delitos = Delito::all();
      $cavajs = Cavaj::all();
      $usuarios = Usuario::all();
      $organismos = Organismo::all();
      $departamentos = Departamento::all();
      $caso=Caso::find($id);
    session(["idCaso"=> $id]);



$nombre_referencia=$caso->nombre_referencia;
$nro_carpeta=$caso->nro_carpeta;
$delito=$caso->delito;
$otro_delito=$caso->otro_delito;
$descripcion_caso=$caso->descripcion_caso;
$fecha_ingreso=$caso->fecha_ingreso;
$modalidad_ingreso=$caso->modalidad_ingreso;
$organismo=$caso->organismo;
$cual_otro_organismo=$caso->cual_otro_organismo;
$cavaj=$caso->cavaj;
$comisaria=$caso->comisaria;
$denuncias_previas=$caso->denuncias_previas;
$departamento_judicial=$caso->departamento_judicial;
$estado=$caso->estado;
$nombre_y_apellido_de_la_victima=$caso->nombre_y_apellido_de_la_victima;
$motivospasivos=$caso->motivospasivos;
$cual_otro_motivospasivo=$caso->cual_otro_motivospasivo;
$fecha_delito=$caso->fecha_delito;
$fecha_hecho=$caso->fecha_hecho;
$fecha_hecho_otro=$caso->fecha_hecho_otro;
$pais_hecho=$caso->pais_hecho;
$pais_hecho_otro=$caso->pais_hecho_otro;
$provincia_hecho=$caso->provincia_hecho;
$localidad_hecho=$caso->localidad_hecho;

return view("detalleCaso", compact("delitos", "cavajs","usuarios","organismos","departamentos","provincias","ciudades","nombre_referencia","nro_carpeta","delito","otro_delito","descripcion_caso","fecha_ingreso","modalidad_ingreso","organismo","cual_otro_organismo","cavaj","comisaria","denuncias_previas","departamento_judicial","estado","nombre_y_apellido_de_la_victima","motivospasivos","cual_otro_motivospasivo","fecha_delito","fecha_hecho","fecha_hecho_otro","pais_hecho","pais_hecho_otro","provincia_hecho","localidad_hecho","caso"));


      }

      public function search(Request $req) {
            $user = Auth::user();
            $delitos = Delito::all();
            $cavajs = Cavaj::all();
            $usuarios =Usuario::all();
            $oderivados = Oderivados::all();
            $tipo_demandas = Tipo_demandas::all();
             $profesionales = Profesional::all();

             $profesionales=[];
             $casos=[];
             $demandas=[];
             $derivaciones=[];
             $buscar=$req["buscar"];

              $search = $req["search"];

              switch ($req["search"]) {

                case "PRESENTACION":
                  $search =1;
                  break;
                case "INTERVENCION":
                  $search =2 ;
                break;

                case "DERIVACION":
                  $search =3 ;

                  
                break;}

switch ($req["buscar"]) {
                case "4":
$buscar=4;
$casos = Caso::where(function($query) use ($search){
        $query->where('nombre_referencia', 'LIKE', '%'.$search.'%');
        $query->orWhere('nombre_y_apellido_de_la_victima', 'LIKE', '%'.$search.'%');
        $query->orWhere('modalidad_ingreso', 'LIKE', '%'.$search.'%');
     
 
    })->get(); 

    $demandas = Demanda::where('activo' ,'=',1)

    ->where(function($query) use ($search){
        $query->where('nombre_y_apellido_de_la_victima', 'LIKE', '%'.$search.'%');
      
        $query->orWhere('modalidad_ingreso', 'LIKE', '%'.$search.'%');
   

    })->get(); 
   


$derivaciones = Derivacion::where('activo' ,'=',1)

    ->where(function($query) use ($search){
        $query->where('nombre_y_apellido', 'LIKE', '%'.$search.'%');
      
        $query->orWhere('modalidad_ingreso', 'LIKE', '%'.$search.'%');
     

    })

   
   ->get();        

        break;
        }



switch ($req["buscar"]) {
                case "5":
$buscar=5;
$casos = Caso::where(function($query) use ($search){
        $query->where("userID_create",Auth::user()->getId())->where('nombre_referencia', 'LIKE', '%'.$search.'%');
        $query->orWhere("userID_create",Auth::user()->getId())->where('nombre_y_apellido_de_la_victima', 'LIKE', '%'.$search.'%');
        $query->orWhere("userID_create",Auth::user()->getId())->where('modalidad_ingreso', 'LIKE', '%'.$search.'%');
     
 
    })->get(); 


    $demandas = Demanda::where('activo' ,'=',1)

    ->where(function($query) use ($search){
        $query->where("userID_create",Auth::user()->getId())->where('nombre_y_apellido_de_la_victima', 'LIKE', '%'.$search.'%');
      
        $query->orWhere("userID_create",Auth::user()->getId())->where('modalidad_ingreso', 'LIKE', '%'.$search.'%');
   

    })->get(); 
   


$derivaciones = Derivacion::where('activo' ,'=',1)

    ->where(function($query) use ($search){
        $query->where("userID_create",Auth::user()->getId())->where('nombre_y_apellido', 'LIKE', '%'.$search.'%');
      
        $query->orWhere("userID_create",Auth::user()->getId())->where('modalidad_ingreso', 'LIKE', '%'.$search.'%');
     

    })

   
   ->get();        

        break;
        }



            if($user->hasRole('admin')){

        switch ($req["buscar"]) {
                case "1":

$casos = Caso::where('activo' ,'=',1)

    ->where(function($query) use ($search){
        $query->where('nombre_referencia', 'LIKE', '%'.$search.'%');
        $query->orWhere('nombre_y_apellido_de_la_victima', 'LIKE', '%'.$search.'%');
        $query->orWhere('modalidad_ingreso', 'LIKE', '%'.$search.'%');
     

    })
   
   ->get();

         

         break;
            case "2":
                 

$demandas = Demanda::where('activo' ,'=',1)

    ->where(function($query) use ($search){
        $query->where('nombre_y_apellido_de_la_victima', 'LIKE', '%'.$search.'%');
      
        $query->orWhere('modalidad_ingreso', 'LIKE', '%'.$search.'%');
     

    })
   
   ->get();

             break;
            case "3":
                
            $derivaciones = Derivacion::where('activo' ,'=',1)

    ->where(function($query) use ($search){
        $query->where('nombre_y_apellido', 'LIKE', '%'.$search.'%');
      
        $query->orWhere('modalidad_ingreso', 'LIKE', '%'.$search.'%');
     

    })
   
   ->get();
              break;
      
 

        }
            }




         if($user->hasRole('profesional')){
          switch ($req["buscar"]) {
                case "1":
   
  
    $profesionales=Profesional::all();
    //$casos=Auth::user()->casos('activo' ,'=',1)
  if($buscar==1){
$casos=Caso::where('activo' ,'=',1)
->where(function($query) use ($search){

            $query->where("nombre_referencia", "like", '%'.$search.'%');
      $query->orwhere("nombre_y_apellido_de_la_victima", "like", '%'.$search.'%');

           $query->orwhere("modalidad_ingreso", "like", '%'.$search.'%');
                       })
   
   ->get();}
    break;



           
            case "2":
         if($buscar==2){
            $demandas = Demanda::where('activo' ,'=',1)

->where(function($query) use ($search){

           $query->where("userID_create",Auth::user()->getId())->where("nombre_y_apellido_de_la_victima", "like", '%'.$search.'%');
        $query->orwhere("userID_create",Auth::user()->getId())->where("modalidad_ingreso", "like", '%'.$search.'%');
                    })
   
   ->get();}
                     break;
                     case "3":
                if($buscar==3){   
           $derivaciones = Derivacion::where('activo' ,'=',1)
           ->where(function($query) use ($search){

    $query->where("userID_create",Auth::user()->getId())->where("nombre_y_apellido", "like", '%'.$search.'%');
$query->orwhere("userID_create",Auth::user()->getId())->where("modalidad_ingreso", "like", '%'.$search.'%');
                    })
   
   ->get();
}


            break;
           
              }}

              if($user->hasRole('user')){

              switch ($req["buscar"]) {
                case "1":
                $casos=Caso::where('activo' ,'=',1)
                 ->where(function($query) use ($search){

          $query->where("sede",Auth::user()->getSede())->where("nombre_referencia", "like", '%'.$search.'%');
              $query->orwhere("sede",Auth::user()->getSede())->where("nombre_y_apellido_de_la_victima", "like", '%'.$search.'%');
            $query->orwhere("sede",Auth::user()->getSede())->where("modalidad_ingreso", "like", '%'.$search.'%');
               })
   
   ->get();

                break;
                 case "2":
                $demandas=Demanda::where('activo' ,'=',1)

                 ->where(function($query) use ($search){

      $query->where("sede",Auth::user()->getSede())->where("nombre_y_apellido_de_la_victima", "like", '%'.$search.'%');
$query->orwhere("sede",Auth::user()->getSede())->where("modalidad_ingreso", "like", '%'.$search.'%');
         })
   
   ->get();
                break;
                 case "3":
                $derivaciones=Derivacion::where('activo' ,'=',1)
                ->where(function($query) use ($search){

         $query->where("sede",Auth::user()->getSede())->where("nombre_y_apellido", "like", '%'.$search.'%');
            $query->orwhere("sede",Auth::user()->getSede())->where("modalidad_ingreso", "like", '%'.$search.'%');
        })
   
   ->get();
           break;    
              }}

  
if($casos){
  $countcasos=$casos->count();

if($countcasos>0){
$countcasos=0;
$countdemandas=0;
$countderivaciones=0;
  return view("home", compact("profesionales","casos","demandas","derivaciones","tipo_demandas","oderivados","delitos","cavajs","user","buscar","countcasos","countdemandas","countderivaciones"));

}

else{abort(403, "No Hay Ingresos para mostrar!");
   
}

}

if($demandas){
 
  $countdemandas=$demandas->count();
 
  
if($countdemandas>0){
  $countcasos=0;
$countdemandas=0;
$countderivaciones=0;
   return view("home", compact("profesionales","casos","demandas","derivaciones","tipo_demandas","oderivados","delitos","cavajs","user","buscar","countdemandas","countcasos","countdemandas","countderivaciones"));

}

else{abort(403, "No Hay Ingresos para mostrar!");
   
}



}


if($derivaciones){

  $countderivaciones=$derivaciones->count();

if($countderivaciones>0){
  $countcasos=0;
$countdemandas=0;
$countderivaciones=0;

  return view("home", compact("profesionales","casos","demandas","derivaciones","tipo_demandas","oderivados","delitos","cavajs","user","buscar","countderivaciones","countcasos","countdemandas","countderivaciones"));

}

else{abort(403, "No Hay Ingresos para mostrar!");
   
}


}




if($buscar==0){
  return redirect("home")->with('message','Selecciona Caso, Incicencias, Derivaciones o BUSQUEDA GENERAL!'); 

}}
     public function eliminar($id) {
        $caso = Caso::find($id);
        $caso->delete();
          return redirect("home");

      }

}

