<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
//RUTAS DE AGREGAR CASO (EUGE)------------------------------------------------//
//A-CASO//
Route::get("/agregarCaso",function(){
  $provincias = App\Provincia::all();
  $ciudades = App\Ciudad::all();
  $delitos = DB::table("delitos")
  ->select(DB::raw("*"))
  ->orderBy(DB::raw("nombre","ASC"))
  ->get();
  $cavajs = App\Cavaj::all();
  $usuarios = App\Usuario::all();
  $organismos = App\Organismo::all();
  $departamentos = App\Departamento::all();
  session(["DemandaCte" => "0"]);
  return view("agregarCaso", compact("delitos","provincias", "ciudades","cavajs","usuarios","organismos","departamentos"));
})->middleware('auth');
Route::post("/agregarCaso","CasoController@agregar")->middleware('auth');

//A-PROFESIONAL//

Route::get("/agregarProfesional",function(){
    $profesionales = App\Profesional::all();
 
    $instituciones = App\Institucion::all();
    $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
    $profsinter=App\Profesional::where("idCaso",session("idCaso"))->get();
    $countprofsinter=App\Profesional::where("idCaso",session("idCaso"))->count();
    $usuarios = App\Usuario::where("rol","3")
    ->orderBy(DB::raw("nombre_y_apellido","ASC"))
    ->get();
    //ir eliminando los profesionales que ya se han agregado
     $array1[]="";
    $array2[]="";
    if ($countprofsinter==0){
      $array2[]=0;
      $array1[]=0;
    }

       if($countprofsinter>0){    
           $array = array();
        foreach($usuarios as $usuario){
           foreach($profsinter as $profinter){           
if($profinter->nombre_profesional_interviniente==$usuario->id){
$array1[]=$usuario->id;}
else{
 $array2[]=$usuario->id;
    $array2=array_unique($array2); }
}}
foreach ($array1 as $ar1) {
 
if (($clave = array_search($ar1, $array2)) !== false) {
    unset($array2[$clave]);
}
if (($clave = array_search(
Auth::id(), $array2)) !== false) {
    unset($array2[$clave]);
}}
}    
return view("agregarProfesional",compact("profesionales","usuarios","instituciones","institucionnav","array2","countprofsinter","array1"));
})->middleware('auth');
Route::post("/agregarProfesional","ProfesionalController@agregar")->middleware('auth');

//A-PERSONA ASISTIDA//

Route::get("/agregarPersona",function(){
  $personas = App\Persona::all();
  $personas_nuevas = App\Persona_nueva::all();
    $casoActual = App\Caso::find(session("idCaso"));
    $victimActual = App\Victim::find(session("idVictim"));
  $casoActualenPersona = App\Persona::where("idCaso",session("idCaso"))->count();
  $cantVictimas = App\Victim::where("idCaso",session("idCaso"))->count();
  $cantdePersonas = App\Persona::where("idCaso",session("idCaso"))->count();

  $instituciones = App\Institucion::all();
  $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
  $clave=0;
return view("agregarPersona",compact("casoActual","cantVictimas","casoActualenPersona","victimActual","personas","instituciones","institucionnav","cantdePersonas","personas_nuevas","clave"));
})->middleware('auth');
Route::post("/agregarPersona","PersonaController@agregar")->middleware('auth');

Route::get("/duplicar",function(){
return view("duplicar");
})->middleware('auth');
Route::get("/duplicar/{id}", "PersonaController@duplicar")->middleware('auth');
Route::get("/eliminarpersona/{id}", "PersonaController@eliminarpersona")->middleware('auth');


//B-VICTIMAS//

Route::get("/agregarVictima",function(){
  $necesidades = App\Necesidad::all();
  $programas = App\Programa::all();
  $discapacidades = App\Discapacidad::all();
  $limitaciones = App\Limitacion::all();
  $victims= App\Victim::all();
  $cantVictimas = App\Victim::where("idCaso",session("idCaso"))->count();
  $casoActual = App\Caso::find(session("idCaso"));
  $instituciones = App\Institucion::all();
  $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();

  $ciudades =App\Ciudad::where("idPcia","1")
  ->orWhere("idPcia","2")->get();
   
  return view("agregarVictima", compact("necesidades","programas","discapacidades","limitaciones","victims","instituciones","institucionnav","casoActual","cantVictimas","ciudades"));
})->middleware('auth');
Route::post("/agregarVictima","VictimController@agregar")->middleware('auth');
Route::get("/eliminarvictima/{id}", "VictimController@eliminarvictima")->middleware('auth');

//C-CONVIVIENTES//

Route::get("/agregarconviviente",function(){
    $convivientes = App\Conviviente::all();

    $cantVictimas = App\Victim::where("idCaso",session("idCaso"))->count();
    $instituciones = App\Institucion::all();
     $casoActual = App\Caso::find(session("idCaso"));
    $victimActual = App\Victim::find(session("idVictim"));
     $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
     $convivientes_nuevos = App\Conviviente_nuevo::all();
  return view("agregarconviviente",compact("convivientes_nuevos","cantVictimas","victimActual","convivientes","instituciones","institucionnav","casoActual"));
})->middleware('auth');
Route::post("/agregarconviviente","ConvivienteController@agregar")->middleware('auth');

Route::get("/duplicarreferente/{id}/{vinculo}/{otro?}", "ConvivienteController@duplicar")->middleware('auth');
Route::get("/eliminarconviviente/{id}", "ConvivienteController@eliminarconviviente")->middleware('auth');
//D-HECHOS//
/*Route::get("/agregarDelito",function(){
  $provincias = App\Provincia::all();
  $ciudades = App\Ciudad::all();

  $hechos= App\Hecho::All();
  $instituciones = App\Institucion::all();
  $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
  return view("agregarDelito",compact("imputados","provincias", "ciudades","hechos","instituciones","institucionnav"));
})->middleware('auth');
Route::post("/agregarDelito","HechoController@agregar")->middleware('auth');*/

//E-IMPUTADOS//

Route::get("/agregarimputado",function(){
    $imputados = App\Imputado::all();
    $imputados_nuevos = App\Imputado_nuevo::all();
   
    $casoActual = App\Caso::find(session("idCaso"));
    $victimActual = App\Victim::find(session("idVictim"));
    $cantVictimas = App\Victim::where("idCaso",session("idCaso"))->count();
    $instituciones = App\Institucion::all();
     
    $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
  return view("agregarimputado",compact("cantVictimas","victimActual","imputados","instituciones","institucionnav","imputados_nuevos","casoActual"));
})->middleware('auth');
Route::post("/agregarimputado","ImputadoController@agregar")->middleware('auth');

Route::get("/duplicar",function(){
return view("duplicarimputado");
})->middleware('auth');
Route::get("/duplicarimputado/{id}", "ImputadoController@duplicar")->middleware('auth');
Route::get("/eliminarimputado/{id}", "ImputadoController@eliminarimputado")->middleware('auth');

//F-ORGANISMOS//

Route::get("/agregarOrganismo",function(){
  $oprevios = App\Oprevio::all();
  $casoActual = App\Caso::find(session("idCaso"));
  $victimActual = App\Victim::find(session("idVictim"));
  $oarticulas = App\Oarticula::all();
  $socioeconomicos = App\Socioeconomico::all();
  $departamentos = App\Departamento::all();

 $victims= App\Victim::all();
  $instituciones = App\Institucion::all();
  $asistencias = App\Asistencia::all();
return view("agregarOrganismo", compact("oprevios","oarticulas","socioeconomicos","victims","departamentos","instituciones","asistencias","casoActual","victimActual"));
})->middleware('auth');
Route::post("/agregarOrganismo","InstitucionController@agregar")->middleware('auth');

//G-DOCUMENTOS//

Route::get("/agregarDocumento",function(){
    $documentos = App\Documento::all();
    
    $instituciones = App\Institucion::all();
    $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
return view("agregarDocumento",compact("documentos","instituciones","institucionnav"));
})->middleware('auth');
Route::post("/agregarDocumento","DocumentoController@agregar")->middleware('auth');

//G2-INFORME E INTERVENCION//

Route::get("/agregarIntervencion",function(){
  $provincias = App\Provincia::all();
  $ciudades = App\Ciudad::all();
  $hechos= App\Hecho::All();
  $casos = App\Caso::all();
  $instituciones = App\Institucion::all();
  $socioeconomicos = App\Socioeconomico::all();
  $departamentos = App\Departamento::all();
  $victimas= App\Victim::all();
  $intervenciones = App\Intervencion::all();
  $organismos = App\Organismo::all(); 

  $institucion_oarticulas = App\Institucion_Oarticula::all();
  $delitos = App\Delito::all();
  $cavajs = App\Cavaj::all();
  $oarticulas = App\Oarticula::all();
  
  $casoActual = App\Caso::find(session("idCaso"));
  $instituciones = App\Institucion::all();
 $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
  return view("agregarIntervencion", compact("provincias", "ciudades","hechos","organismos","oarticulas","cavajs","delitos","institucion_oarticulas","casos","instituciones","socioeconomicos","victimas","departamentos", "intervenciones", "casoActual","instituciones","institucionnav"));
})->middleware('auth');
Route::post("/agregarIntervencion","IntervencionController@agregar")->middleware('auth');




//Route::get("/kpi","KpiController@index")->middleware('auth');
//Route::post("/kpi","KpiController@index")->middleware('auth');

//---------HOME VISTA DEL BUSCADOR)-------------//

//EDITAR CASO//

/*Route::get("/inicio",function(){
    $casos = [];
    return view("inicio",compact("casos"));
});*/
Route::get("/search", "CasoPanelController@search")->middleware('auth');
//INFORME//
/*
Route::get("/sel",function(){
$casos = [];
    return view("sel",compact("casos"));
})->middleware('auth');
Route::get("/search2", "CasoController@search")->middleware('auth');


Route::get("/select",function(){
$casos = [];
    return view("select",compact("casos"));
})->middleware('auth');
Route::get("/search3", "IntervencionController@search")->middleware('auth');*/

Route::get("/agregarIntervencion/{id}",function($id){
  session(["idCaso" => $id]);
  $casos = App\Caso::all();
  $instituciones = App\Institucion::all();
  $socioeconomicos = App\Socioeconomico::all();
  $departamentos = App\Departamento::all();
  $victimas= App\Victim::all();
  $ciudades= App\Ciudad::all();
  $organismos = App\Organismo::all();
  $intervenciones = App\Intervencion::all();
  

  $institucion_oarticulas = App\Institucion_Oarticula::all();
  $delitos = App\Delito::all();
  $cavajs = App\Cavaj::all();
  $provincias = App\Provincia::all();
  $oarticulas = App\Oarticula::all();
  $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
  $casoActual = App\Caso::find(session("idCaso"));
  return view("agregarIntervencion", compact("institucionnav","provincias","organismos","ciudades","oarticulas","cavajs","delitos","institucion_oarticulas","casos","instituciones","socioeconomicos","victimas","departamentos", "intervenciones", "casoActual"));
})->middleware('auth');
Route::post("/agregarIntervencion","IntervencionController@agregar")->middleware('auth');
Route::get("/eliminarintervencion/{id}", "IntervencionController@eliminarintervencion")->middleware('auth');

Route::get("/eliminarnuevaintervencion/{id}", "IntervencionController@eliminarnuevaintervencion")->middleware('auth');




Route::get("/agregarnuevaIntervencionvictima/{id}",function($id){
  session(["idCaso" => $id]);
  $casos = App\Caso::all();
  $instituciones = App\Institucion::all();
  $socioeconomicos = App\Socioeconomico::all();
  $departamentos = App\Departamento::all();
  $victimas= App\Victim::all();
  $ciudades= App\Ciudad::all();
  $organismos = App\Organismo::all();

  $intervenciones = DB::table("intervenciones")
    ->select(DB::raw("*"))
    ->orderBy(DB::raw("fecha_intervencion","ASC"))
    ->get();
 
  $institucion_oarticulas = App\Institucion_Oarticula::all();
  $delitos = App\Delito::all();
  $cavajs = App\Cavaj::all();
  $provincias = App\Provincia::all();
  $oarticulas = App\Oarticula::all();
  $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
  $casoActual = App\Caso::find(session("idCaso"));

  return view("agregarnuevaIntervencionvictima", compact("institucionnav","provincias","organismos","ciudades","oarticulas","cavajs","delitos","institucion_oarticulas","casos","instituciones","socioeconomicos","victimas","departamentos", "intervenciones", "casoActual"));
})->middleware('auth');






Route::post("/agregarnuevaIntervencionvictimapanel","IntervencionController@agregarnuevapanel")->middleware('auth');


Route::post("/agregarnuevaIntervencionvictima","IntervencionController@agregarnueva")->middleware('auth');

Route::get("/detallenuevaIntervencion/{id}", "IntervencionController@detalle")->middleware('auth');

Route::get("/detallenuevaIntervencionpanel/{id}", "IntervencionController@detallepanel")->middleware('auth');

Route::post("/detallenuevaintervencionpanel", "IntervencionController@editarpanel")->middleware('auth');



Route::post("/detallenuevaintervencion", "IntervencionController@editar")->middleware('auth');

Route::get("/eliminarnuevaintervencionpanel/{id}", "IntervencionController@eliminarnuevaintervencionpanel")->middleware('auth');






Route::get("/detallenuevaintervencionpanel/{id}", "IntervencionController@detallepanel")->middleware('auth');

Route::post("/detallenuevaIntervencionpanel","IntervencionController@editarpanel")->middleware('auth');

Route::post("/detallenuevaintervencionpanel", "IntervencionController@editarpanel")->middleware('auth');
Route::get("/victima/{id}", "IntervencionController@victima")->middleware('auth');

Route::get("/victimaintervencion/{idCaso}/{idVictima}","IntervencionController@victima")->middleware('auth');

Route::get("/detalleagregarIntervencion/{id}",function($id){
  session(["idCaso" => $id]);
  $casos = App\Caso::all();
  $instituciones = App\Institucion::all();
  $socioeconomicos = App\Socioeconomico::all();
  $departamentos = App\Departamento::all();
  $victimas= App\Victim::all();
  $ciudades= App\Ciudad::all();

  $intervenciones = DB::table("intervenciones")
   ->select(DB::raw("*"))
    ->orderBy(DB::raw("idVictim","ASC"))->orderBy(DB::raw("fecha_intervencion","ASC"))
    ->get();
  $provincias = App\Provincia::all();

  $organismos = App\Organismo::all();
  $institucion_oarticulas = App\Institucion_Oarticula::all();
  $delitos = App\Delito::all();
  $cavajs = App\Cavaj::all();
  $oarticulas = App\Oarticula::all();
  $casoActual = App\Caso::find(session("idCaso"));
  return view("detalleagregarIntervencion", compact("ciudades","oarticulas","cavajs","delitos","provincias","organismos","institucion_oarticulas","casos","instituciones","socioeconomicos","victimas","departamentos", "intervenciones", "casoActual"));
});
Route::post("/detalleagregarIntervencion","IntervencionPanelController@agregar");


Route::get("/detalleCaso/{id}", "CasoPanelController@detalle")->middleware('auth');
Route::post("/detalleCaso", "CasoPanelController@editar")->middleware('auth');
//PASAR DE INCIDENCIA A CASO//
Route::get("/detalleAcaso/{id}", "CasoPanelController@detalle")->middleware('auth');
Route::post("/detalleAcaso", "CasoPanelController@editardemandaAcaso")->middleware('auth');
//FIN PASAR DE INCIDENCIA A CASO//


Route::get("/detalleProfesional/{id}", "ProfesionalPanelController@detalle")->middleware('auth');
Route::post("/detalleProfesional", "ProfesionalPanelController@editar")->middleware('auth');
Route::get("/detalleProfesional/deleteProfesional/{id}", "ProfesionalPanelController@eliminar")->middleware('auth');
Route::get("/detallePersona/{id}", "PersonaPanelController@detalle")->middleware('auth');
Route::post("/detallePersona", "PersonaPanelController@editar")->middleware('auth');
Route::get("/detallePersona/deletePersona/{id}", "PersonaPanelController@eliminar")->middleware('auth');
//VISTA QUE SIRVE PARA LOS CICLOS DE LAS VICTIMAS, USAR LAS MISMAS PERSONAS YA AGREGADAS Y PODER EDITARLE SOLO EL VINCULO DE SE NECESARIO//
Route::get("/detallepersonavinculo/{id}","PersonaPanelController@detallepersona")->middleware('auth');
Route::post("/detallepersonavinculo", "PersonaPanelController@vinculopersona")->middleware('auth');
//EJE B: VICTIMA//
//CUANDO ELIJO UNA VICTIMA SE ESTA GUARDANDO EN SESSION EL IdCaso e idVictima PARA TRABAJAR CON ESA VICTIMA SELECCIONADA Y EDIATR SI ES NECESARIO//
Route::get("/victima/{idCaso}/{idVictima}","VictimaPanelController@victima")->middleware('auth');


Route::get("/detalleVictima/{id}", "VictimaPanelController@detalle")->middleware('auth');
Route::post("/detalleVictima", "VictimaPanelController@editar")->middleware('auth');
Route::get("/detalleVictima/deleteVictima/{id}", "VictimaPanelController@eliminar")->middleware('auth');
//EJE C: CONVIVIENTE//
Route::get("/detalleconviviente/{id}", "ConvivientePanelController@detalle")->middleware('auth');
Route::post("/detalleconviviente", "ConvivientePanelController@editar")->middleware('auth');
Route::get("/detalleconviviente/deleteconviviente/{id}", "ConvivientePanelController@eliminar")->middleware('auth');
//VISTA QUE SIRVE PARA LOS CICLOS DE LAS VICTIMAS, USAR LOS MISMAS CONVIVIENTES YA AGREGADAS Y PODER EDITARLE SOLO EL VINCULO DE SE NECESARIO//
Route::get("/detalleconvivientevinculo/{id}", "ConvivientePanelController@detalleconviviente")->middleware('auth');
Route::post("/detalleconvivientevinculo", "ConvivientePanelController@vinculoconviviente")->middleware('auth');
//EJE D:DELITO//
//Route::get("/detalleDelito/{id}", "HechoPanelController@detalle")->middleware('auth');
//Route::post("/detalleDelito", "HechoPanelController@editar")->middleware('auth');

//EJE E: IMPUTADO//

Route::get("/detalleimputado/{id}", "ImputadoPanelController@detalle")->middleware('auth');
Route::post("/detalleimputado", "ImputadoPanelController@editar")->middleware('auth');
Route::get("/detalleimputado/deleteimputado/{id}", "ImputadoPanelController@eliminar")->middleware('auth');

//VISTA QUE SIRVE PARA LOS CICLOS DE LAS VICTIMAS, USAR LOS MISMAS IMPUTADOS YA AGREGADAS Y PODER EDITARLE SOLO EL VINCULO DE SE NECESARIO//
Route::get("/detalleimputadovinculo/{id}", "ImputadoPanelController@detalleimputado")->middleware('auth');
Route::post("/detalleimputadovinculo", "ImputadoPanelController@editarimputado")->middleware('auth');
//EJE F: ORGANISMO//
Route::get("/detalleOrganismo/{id}", "InstitucionPanelController@detalle")->middleware('auth');
Route::post("/detalleOrganismo", "InstitucionPanelController@editar")->middleware('auth');
//EJE G: DOCUMENTOS//
Route::get("/deleteDocumento/{id}", "DocumentoPanelController@eliminar")->middleware('auth');
//RURA DETALLEAGREGA AGREGA en el C.Panel//
//AGREGA EJE A:PERSONA//
Route::get("/detalleagregarPersona",function(){
  $personas = App\Persona::all();
  $personas_nuevas = App\Persona_nueva::all();
  $casoActual = App\Caso::find(session("idCaso"));
  $victimActual = App\Victim::find(session("idVictim"));
  $casoActualenPersona = App\Persona::where("idCaso",session("idCaso"))->count();
  $cantVictimas = App\Victim::where("idCaso",session("idCaso"))->count();
  $cantdePersonas = App\Persona::where("idCaso",session("idCaso"))->count();
  
  $instituciones = App\Institucion::all();
  $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
return view("detalleagregarPersona",compact("casoActual","cantVictimas","casoActualenPersona","victimActual","personas","instituciones","institucionnav","cantdePersonas","personas_nuevas"));
})->middleware('auth');
Route::post("/detalleagregarPersona","PersonaPanelController@agregar")->middleware('auth');
//Route::post("/detalleagregarPersona/{id}","PersonaPanelController@editar")->middleware('auth');

//AGREGA EJE A: PROFESIONAL//

Route::get("/detalleagregarProfesional",function(){
    $profesionales = App\Profesional::all();
    
    $instituciones = App\Institucion::all();
    $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
    $usuarios = DB::table("usuarios")
    ->select(DB::raw("*"))
    ->orderBy(DB::raw("nombre_y_apellido","ASC"))
    ->get();
$profsinter=App\Profesional::where("idCaso",session("idCaso"))->get();
    $countprofsinter=App\Profesional::where("idCaso",session("idCaso"))->count();
    $usuarios = App\Usuario::where("rol","3")
    ->orderBy(DB::raw("nombre_y_apellido","ASC"))
    ->get();
    $array1[]="";
    $array2[]="";
       if($countprofsinter>0){    
           $array = array();
        foreach($usuarios as $usuario){
           foreach($profsinter as $profinter){           
if($profinter->nombre_profesional_interviniente==$usuario->id){
$array1[]=$usuario->id;}
else{
 $array2[]=$usuario->id;
    $array2=array_unique($array2); }
}}
foreach ($array1 as $ar1) {
 
if (($clave = array_search($ar1, $array2)) !== false) {
    unset($array2[$clave]);
}
if (($clave = array_search(
Auth::id(), $array2)) !== false) {
    unset($array2[$clave]);
}}
}  
return view("detalleagregarProfesional",compact("profesionales","usuarios","instituciones","institucionnav","array1","array2","countprofsinter"));
})->middleware('auth');
Route::post("/detalleagregarProfesional","ProfesionalPanelController@agregar")->middleware('auth');

//AGREGA EJE B:VICTIMA//

Route::get("/detalleagregarVictima",function(){
  $necesidades = App\Necesidad::all();
  $programas = App\Programa::all();
  $discapacidades = App\Discapacidad::all();
  $limitaciones = App\Limitacion::all();
  $victims= App\Victim::all();
  
  $instituciones = App\Institucion::all();
  $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
  return view("detalleagregarVictima", compact("necesidades","programas","discapacidades","limitaciones","victims","instituciones","institucionnav"));
})->middleware('auth');

Route::post("/detalleagregarVictima","VictimaPanelController@agregar")->middleware('auth');

//AGREGA EJE C: CONVIVIENTES//

Route::get("/detalleagregarconviviente",function(){
    $convivientes = App\Conviviente::all();
    
    $cantdeVictimas = App\Victim::where("idCaso",session("idCaso"))->count();
    $instituciones = App\Institucion::all();
    $victimActual = App\Victim::find(session("idVictim"));
    $casoActual = App\Caso::find(session("idCaso"));
     $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
     $convivientes_nuevos = App\Conviviente_nuevo::all();
  return view("detalleagregarconviviente",compact("convivientes_nuevos","cantdeVictimas","victimActual","convivientes","instituciones","institucionnav","casoActual"));
})->middleware('auth');

Route::post("/detalleagregarconviviente","ConvivientePanelController@agregar")->middleware('auth');

//AGREGA EJE E:IMPUTADO//

Route::get("/detalleagregarimputado",function(){
    $imputados = App\Imputado::all();
    $imputados_nuevos = App\Imputado_nuevo::all();
    
     $casoActual = App\Caso::find(session("idCaso"));
    $cantVictimas = App\Victim::where("idCaso",session("idCaso"))->count();
     $instituciones = App\Institucion::all();
     $victimActual = App\Victim::find(session("idVictim"));
    $institucionnav= App\Institucion::where("idCaso",session("idCaso"))->count();
  return view("detalleagregarimputado",compact("cantVictimas","victimActual","imputados","instituciones","institucionnav","imputados_nuevos","casoActual"));
})->middleware('auth');

Route::post("/detalleagregarimputado","ImputadoPanelController@agregar")->middleware('auth');

// AGREGA EJE G:DOCUMENTO//

Route::get("/detalleagregarDocumento",function(){
    $documentos = App\Documento::all();
  return view("detalleagregarDocumento",compact("documentos"));
})->middleware('auth');

Route::post("/detalleagregarDocumento","DocumentoPanelController@agregar")->middleware('auth');
Route::get("/eliminardocumento/{id}", "DocumentoPanelController@eliminardocumento")->middleware('auth');
Route::get("/eliminardoc/{id}", "DocumentoPanelController@eliminardoc")->middleware('auth');

//Route::post("/agregarDocumento","DocumentoPanelController@agregar");
//AGREGA EJE G: INTERVENCION//
//----------------------------FIN RUTAS DE EDICION Y ELIMINACION ( PANEL DE CONTROL)-------------------------//
//-----------------------------------INICIO DE RUTA PANEL DE CONTROL-------------------------------//
//INGRESO AL PANEL DE CONTROL, AL INGRESAR SE GRABA EN SESSION IdCaso EL ID DEL CASO CONSULTADO//
Route::get("/paneldecontrol/{id}",function($id){
  $caso = App\Caso::find($id);
    $user = Auth::user();
if ($user->hasRole('admin')) {
 // checkPermisos($caso);
session(["idCaso" => $id]);
$casoNombre=App\Caso::find($id)->getnombre_referencia();
$delitos = App\Delito::all();
$casoActual = App\Caso::find(session("idCaso"));
$delitoActual=App\Delito::find($casoActual->delito);
$cavajs = App\Cavaj::all();
$usuarios = App\Usuario::all();
$caso = App\Caso::find($id);
$hechos= App\Hecho::All();
$casos= App\Caso::All();
$imputados = App\Imputado::all();
$convivientes = App\Conviviente::all();
$victimas=App\Victim::all();
$personas=App\Persona::all();
$profesionales=App\Profesional::all();
$idCaso=$id;
$documentos = App\Documento::all();
$instituciones = App\Institucion::all();
$institucion = App\Institucion::find($id);
$organismo = App\Institucion::where("idCaso",$id)->get();
$intervenciones = App\Intervencion::all();
$personas_nuevas = App\Persona_nueva::all();
$convivientes_nuevos=App\Conviviente_nuevo::all();
$imputados_nuevos=App\Imputado_nuevo::all();
$instituciocount= App\Institucion::where("idCaso",session("idCaso"))->count();
$casoActual = App\Caso::find(session("idCaso"));
  return view("paneldecontrol",compact("imputados","casoNombre","convivientes","victimas","personas","profesionales", "caso","delitos","cavajs","usuarios","documentos","instituciones","hechos","intervenciones","organismo","idCaso","instituciocount","personas_nuevas","convivientes_nuevos","imputados_nuevos","casos","casoActual","delitoActual","user"));
}
if($user->hasRole('profesional')) {
  $user=Auth::user();
  $profesionales=App\Profesional::all();
  foreach ($profesionales as $profesional) {
   if($profesional->idCaso==$id &&$profesional->userID_create==NULL&& $profesional->nombre_profesional_interviniente==$user->getId()
    ||$profesional->idCaso==$id &&$profesional->userID_create!==NULL&& $profesional->userID_create==$user->getId()||$profesional->idCaso==$id &&$profesional->userID_create!==NULL&& $profesional->nombre_profesional_interviniente==$user->getId()){

  
session(["idCaso" => $id]);
$casoNombre=App\Caso::find($id)->getnombre_referencia();
$delitos = App\Delito::all();
$casoActual = App\Caso::find(session("idCaso"));
$delitoActual=App\Delito::find($casoActual->delito);
$cavajs = App\Cavaj::all();
$usuarios = App\Usuario::all();
$casos= App\Caso::All();
$caso = App\Caso::find($id);
$hechos= App\Hecho::All();
$imputados = App\Imputado::all();
$convivientes = App\Conviviente::all();
$victimas=App\Victim::all();
$personas=App\Persona::all();
$profesionales=App\Profesional::all();
$documentos = App\Documento::all();
$instituciones = App\Institucion::all();
$intervenciones = App\Intervencion::all();
$personas_nuevas = App\Persona_nueva::all();
$convivientes_nuevos=App\Conviviente_nuevo::all();
$imputados_nuevos=App\Imputado_nuevo::all();
$instituciocount= App\Institucion::where("idCaso",session("idCaso"))->count();
  return view("paneldecontrol",compact("profesional","imputados","casoNombre","convivientes","victimas","personas","profesionales", "caso","delitos","cavajs","usuarios","documentos","instituciones","hechos","intervenciones","personas_nuevas","convivientes_nuevos","imputados_nuevos","instituciocount","casos","casoActual","delitoActual","user"));
}}abort(403, "No tienes autorización para ingresar!");}



if($user->hasRole('user')&&$caso->sede==$user->getSede()&&$caso->userID_create==$user->getId()) {
session(["idCaso" => $id]);
$casoNombre=App\Caso::find($id)->getnombre_referencia();
$delitos = App\Delito::all();
$casoActual = App\Caso::find(session("idCaso"));
$delitoActual=App\Delito::find($casoActual->delito);
$cavajs = App\Cavaj::all();
$usuarios = App\Usuario::all();
$caso = App\Caso::find($id);
$hechos= App\Hecho::All();
$casos= App\Caso::All();
$imputados = App\Imputado::all();
$convivientes = App\Conviviente::all();
$victimas=App\Victim::all();
$personas=App\Persona::all();
$profesionales=App\Profesional::all();
$documentos = App\Documento::all();
$instituciones = App\Institucion::all();
$intervenciones = App\Intervencion::all();
$personas_nuevas = App\Persona_nueva::all();
$convivientes_nuevos=App\Conviviente_nuevo::all();
$imputados_nuevos=App\Imputado_nuevo::all();
$instituciocount= App\Institucion::where("idCaso",session("idCaso"))->count();
$casoActual = App\Caso::find(session("idCaso"));
  return view("paneldecontrol",compact("imputados","casoNombre","convivientes","victimas","personas","profesionales", "caso","delitos","cavajs","usuarios","documentos","instituciones","hechos","intervenciones","personas_nuevas","convivientes_nuevos","imputados_nuevos","instituciocount","casos","casoActual","delitoActual","user"));
}
else{abort(403, "No tienes autorización para ingresar.");}})->middleware('auth');


//----------------------------------PANEL DE CONTROL CASO-------------------------------------------------//
Route::get("/paneldecontrolcaso/{id}",function($id){
  $caso = App\Caso::find($id);
    $user = Auth::user();
if ($user->hasRole('admin')) {
 // checkPermisos($caso);
session(["idCaso" => $id]);
$casoNombre=App\Caso::find($id)->getnombre_referencia();
$delitos = App\Delito::all();
$casoActual = App\Caso::find(session("idCaso"));
$delitoActual=App\Delito::find($casoActual->delito);
$cavajs = App\Cavaj::all();
$usuarios = App\Usuario::all();
$caso = App\Caso::find($id);
$hechos= App\Hecho::All();
$casos= App\Caso::All();
$imputados = App\Imputado::all();
$convivientes = App\Conviviente::all();
$victimas=App\Victim::all();
$personas=App\Persona::all();
$profesionales=App\Profesional::all();
$idCaso=$id;
$documentos = App\Documento::all();
$instituciones = App\Institucion::all();
$institucion = App\Institucion::find($id);
$organismo = App\Institucion::where("idCaso",$id)->get();
$intervenciones = App\Intervencion::all();
$personas_nuevas = App\Persona_nueva::all();
$convivientes_nuevos=App\Conviviente_nuevo::all();
$imputados_nuevos=App\Imputado_nuevo::all();
$instituciocount= App\Institucion::where("idCaso",session("idCaso"))->count();
$casoActual = App\Caso::find(session("idCaso"));
  return view("paneldecontrolcaso",compact("imputados","casoNombre","convivientes","victimas","personas","profesionales", "caso","delitos","cavajs","usuarios","documentos","instituciones","hechos","intervenciones","organismo","idCaso","instituciocount","personas_nuevas","convivientes_nuevos","imputados_nuevos","casos","casoActual","delitoActual","user"));
}
if($user->hasRole('profesional')) {
session(["idCaso" => $id]);
$casoNombre=App\Caso::find($id)->getnombre_referencia();
$delitos = App\Delito::all();
$casoActual = App\Caso::find(session("idCaso"));
$delitoActual=App\Delito::find($casoActual->delito);
$cavajs = App\Cavaj::all();
$usuarios = App\Usuario::all();
$casos= App\Caso::All();
$caso = App\Caso::find($id);
$hechos= App\Hecho::All();
$imputados = App\Imputado::all();
$convivientes = App\Conviviente::all();
$victimas=App\Victim::all();
$personas=App\Persona::all();
$profesionales=App\Profesional::all();
$documentos = App\Documento::all();
$instituciones = App\Institucion::all();
$intervenciones = App\Intervencion::all();
$personas_nuevas = App\Persona_nueva::all();
$convivientes_nuevos=App\Conviviente_nuevo::all();
$imputados_nuevos=App\Imputado_nuevo::all();
$instituciocount= App\Institucion::where("idCaso",session("idCaso"))->count();
  return view("paneldecontrolcaso",compact("imputados","casoNombre","convivientes","victimas","personas","profesionales", "caso","delitos","cavajs","usuarios","documentos","instituciones","hechos","intervenciones","personas_nuevas","convivientes_nuevos","imputados_nuevos","instituciocount","casos","casoActual","delitoActual","user"));
}
if($user->hasRole('user')&&$caso->sede==$user->getSede()&&$caso->userID_create==$user->getId()) {
session(["idCaso" => $id]);
$casoNombre=App\Caso::find($id)->getnombre_referencia();
$delitos = App\Delito::all();
$casoActual = App\Caso::find(session("idCaso"));
$delitoActual=App\Delito::find($casoActual->delito);
$cavajs = App\Cavaj::all();
$usuarios = App\Usuario::all();
$caso = App\Caso::find($id);
$hechos= App\Hecho::All();
$casos= App\Caso::All();
$imputados = App\Imputado::all();
$convivientes = App\Conviviente::all();
$victimas=App\Victim::all();
$personas=App\Persona::all();
$profesionales=App\Profesional::all();
$documentos = App\Documento::all();
$instituciones = App\Institucion::all();
$intervenciones = App\Intervencion::all();
$personas_nuevas = App\Persona_nueva::all();
$convivientes_nuevos=App\Conviviente_nuevo::all();
$imputados_nuevos=App\Imputado_nuevo::all();
$instituciocount= App\Institucion::where("idCaso",session("idCaso"))->count();
$casoActual = App\Caso::find(session("idCaso"));
  return view("paneldecontrolcaso",compact("imputados","casoNombre","convivientes","victimas","personas","profesionales", "caso","delitos","cavajs","usuarios","documentos","instituciones","hechos","intervenciones","personas_nuevas","convivientes_nuevos","imputados_nuevos","instituciocount","casos","casoActual","delitoActual","user"));
}
else{abort(403, "No tienes autorización para ingresar.");}})->middleware('auth');


//----------------------------------PANEL DE CONTROL VICTIMA-------------------------------------------------//
Route::get("/paneldecontrolvictima/{id}",function($id){
  $caso = App\Caso::find($id);
    $user = Auth::user();
if ($user->hasRole('admin')) {
 // checkPermisos($caso);
session(["idCaso" => $id]);
$casoNombre=App\Caso::find($id)->getnombre_referencia();
$delitos = App\Delito::all();
$casoActual = App\Caso::find(session("idCaso"));
$delitoActual=App\Delito::find($casoActual->delito);
$cavajs = App\Cavaj::all();
$usuarios = App\Usuario::all();
$caso = App\Caso::find($id);
$hechos= App\Hecho::All();
$casos= App\Caso::All();
$imputados = App\Imputado::all();
$convivientes = App\Conviviente::all();
$victimas=App\Victim::all();
$personas=App\Persona::all();
$profesionales=App\Profesional::all();
$idCaso=$id;
$documentos = App\Documento::all();
$instituciones = App\Institucion::all();
$institucion = App\Institucion::find($id);
$organismo = App\Institucion::where("idCaso",$id)->get();
$intervenciones = App\Intervencion::all();
$personas_nuevas = App\Persona_nueva::all();
$convivientes_nuevos=App\Conviviente_nuevo::all();
$imputados_nuevos=App\Imputado_nuevo::all();
$instituciocount= App\Institucion::where("idCaso",session("idCaso"))->count();
$casoActual = App\Caso::find(session("idCaso"));
  $intervenciones = DB::table("intervenciones")
    ->select(DB::raw("*"))
    ->orderBy(DB::raw("idVictim","ASC"))->orderBy(DB::raw("fecha_intervencion","ASC"))
    ->get();
  return view("paneldecontrolvictima",compact("intervenciones","imputados","casoNombre","convivientes","victimas","personas","profesionales", "caso","delitos","cavajs","usuarios","documentos","instituciones","hechos","intervenciones","organismo","idCaso","instituciocount","personas_nuevas","convivientes_nuevos","imputados_nuevos","casos","casoActual","delitoActual","user"));
}
if($user->hasRole('profesional')) {
session(["idCaso" => $id]);
$casoNombre=App\Caso::find($id)->getnombre_referencia();
$delitos = App\Delito::all();
$casoActual = App\Caso::find(session("idCaso"));
$delitoActual=App\Delito::find($casoActual->delito);
$cavajs = App\Cavaj::all();
$usuarios = App\Usuario::all();
$casos= App\Caso::All();
$caso = App\Caso::find($id);
$hechos= App\Hecho::All();
$imputados = App\Imputado::all();
$convivientes = App\Conviviente::all();
$victimas=App\Victim::all();
$personas=App\Persona::all();
$profesionales=App\Profesional::all();
$documentos = App\Documento::all();
$instituciones = App\Institucion::all();
$intervenciones = App\Intervencion::all();
$personas_nuevas = App\Persona_nueva::all();
$convivientes_nuevos=App\Conviviente_nuevo::all();
$imputados_nuevos=App\Imputado_nuevo::all();
$instituciocount= App\Institucion::where("idCaso",session("idCaso"))->count();
  return view("paneldecontrolvictima",compact("imputados","casoNombre","convivientes","victimas","personas","profesionales", "caso","delitos","cavajs","usuarios","documentos","instituciones","hechos","intervenciones","personas_nuevas","convivientes_nuevos","imputados_nuevos","instituciocount","casos","casoActual","delitoActual","user"));
}
if($user->hasRole('user')&&$caso->sede==$user->getSede()&&$caso->userID_create==$user->getId()) {
session(["idCaso" => $id]);
$casoNombre=App\Caso::find($id)->getnombre_referencia();
$delitos = App\Delito::all();
$casoActual = App\Caso::find(session("idCaso"));
$delitoActual=App\Delito::find($casoActual->delito);
$cavajs = App\Cavaj::all();
$usuarios = App\Usuario::all();
$caso = App\Caso::find($id);
$hechos= App\Hecho::All();
$casos= App\Caso::All();
$imputados = App\Imputado::all();
$convivientes = App\Conviviente::all();
$victimas=App\Victim::all();
$personas=App\Persona::all();
$profesionales=App\Profesional::all();
$documentos = App\Documento::all();
$instituciones = App\Institucion::all();
$intervenciones = App\Intervencion::all();
$personas_nuevas = App\Persona_nueva::all();
$convivientes_nuevos=App\Conviviente_nuevo::all();
$imputados_nuevos=App\Imputado_nuevo::all();
$instituciocount= App\Institucion::where("idCaso",session("idCaso"))->count();
$casoActual = App\Caso::find(session("idCaso"));
  return view("paneldecontrolvictima",compact("imputados","casoNombre","convivientes","victimas","personas","profesionales", "caso","delitos","cavajs","usuarios","documentos","instituciones","hechos","intervenciones","personas_nuevas","convivientes_nuevos","imputados_nuevos","instituciocount","casos","casoActual","delitoActual","user"));
}
else{abort(403, "No tienes autorización para ingresar.");}})->middleware('auth');
//------------------------------FIN RUTA PANEL DE CONTROL------------------------------------------//
//------------------------------RUTA INFORME FINAL------------------------------------------//
Route::get("/informe/{id}",function($id){
    session(["idCaso" => $id]);
$delitos = App\Delito::all();
$casoActual = App\Caso::find(session("idCaso"));
$delitoActual=App\Delito::find($casoActual->delito);
$cavajs = App\Cavaj::all();
$usuarios = App\Usuario::all();
$caso = App\Caso::find($id);
$hechos= App\Hecho::All();
$imputados = App\Imputado::all();
$convivientes = App\Conviviente::all();
$victimas=App\Victim::all();
$departamentos=App\Departamento::all();
$personas=App\Persona::all();
$ciudades=App\Ciudad::all();
$profesionales=App\Profesional::all();
$documentos = App\Documento::all();
$oarticulas = App\Oarticula::all();
$instituciones = App\Institucion::all();
$intervenciones = App\Intervencion::all();
$institucion_oarticulas = App\Institucion_Oarticula::all();
$provincias = App\Provincia::all();
$organismos = App\Organismo::all();
$casoActual = App\Caso::find(session("idCaso"));
  return view("informe",compact("organismos","provincias","ciudades","oarticulas","institucion_oarticulas","departamentos","casoActual","imputados","convivientes","victimas","personas","profesionales", "caso","delitos","cavajs","usuarios","documentos","instituciones","hechos","intervenciones","casoActual","delitoActual"));
})->middleware('auth');
//------------------------------FIN RUTA INFORME demanda FINAL------------------------------------------//
Route::get("/informedemanda/{id}",function($id){
  session(["idDemanda" => $id]);
  $delitos = DB::table("delitos")
  ->select(DB::raw("*"))
  ->orderBy(DB::raw("nombre","ASC"))
  ->get();
  $cavajs = App\Cavaj::all();
$ciudades=App\Ciudad::all();
$documentos = App\Documento::all();
$provincias = App\Provincia::all();
$organismos = App\Organismo::all();
$demandaActual = App\Demanda::find($id);
$seguimientos = DB::table("seguimientos")
->select(DB::raw("*"))
->orderBy(DB::raw("fecha_seguimiento","ASC"))
->get();
$tipo_demandas = App\Tipo_demandas::all();
$oderivados = App\Oderivados::all();
  return view("informedemanda",compact("tipo_demandas","oderivados","seguimientos","organismos","provincias","ciudades","demandaActual","delitos","cavajs","documentos"));
})->middleware('auth');
Route::get("/informedemanda/deletedemanda/{id}", "DemandaController@eliminar")->middleware('auth');
Route::get("/demandaCaso/{id}", "DemandaController@PasarACaso")->middleware('auth');
Route::post("/demandaCaso/{id}", "DemandaController@Caso")->middleware('auth');
//------------------------------FIN RUTA INFORME FINAL------------------------------------------//
//------------------------------FIN RUTA INFORME derivacion FINAL------------------------------------------//
Route::get("/informederivacion/{id}",function($id){
  session(["idDerivacion" => $id]);
  $delitos = DB::table("delitos")
  ->select(DB::raw("*"))
  ->orderBy(DB::raw("nombre","ASC"))
  ->get();
  $cavajs = App\Cavaj::all();
$ciudades=App\Ciudad::all();
$documentos = App\Documento::all();
$provincias = App\Provincia::all();
$organismos = App\Organismo::all();
$derivacionActual = App\Derivacion::find($id);
$seguimientos = DB::table("seguimientos")
->select(DB::raw("*"))
->orderBy(DB::raw("fecha_seguimiento","ASC"))
->get();
$tipo_demandas = App\Tipo_demandas::all();
$oderivados = App\Oderivados::all();
  return view("informederivacion",compact("tipo_demandas","oderivados","seguimientos","organismos","provincias","ciudades","derivacionActual","delitos","cavajs","documentos"));
})->middleware('auth');
Route::get("/informederivacion/deletederivacion/{id}", "DerivacionController@eliminar")->middleware('auth');
//------------------------------FIN RUTA INFORME FINAL------------------------------------------//
Auth::routes();

Route::get('/homePanel', 'HomePanelController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register', function () {
   return Redirect::to("/")
       ->with('message', array('type' => 'success', 'text' => 'No es posible registrar usuarios '));
return ("register");
});
Route::get('/logout', function(){
    Session::flush();
    Auth::logout();
    return Redirect::to("/login")
      ->with('message', array('type' => 'success', 'text' => 'You have successfully logged out'));
});
//------------------------------DEMANDA------------------------------------------//
Route::get("/agregardemanda",function(){
  $provincias = App\Provincia::all();
  $ciudades = App\Ciudad::all();
  $delitos = DB::table("delitos")
  ->select(DB::raw("*"))
  ->orderBy(DB::raw("nombre","ASC"))
  ->get();
  $cavajs = App\Cavaj::all();
  $usuarios = App\Usuario::all();
  $organismos = App\Organismo::all();
  $departamentos = App\Departamento::all();

  return view("agregardemanda", compact("ciudades","provincias","delitos", "cavajs","usuarios","organismos","departamentos"));
})->middleware('auth');
Route::post("/agregardemanda","DemandaController@agregar")->middleware('auth');
//------------------------------DERIVACION------------------------------------------//
Route::get("/agregarderivacion",function(){
  $provincias = App\Provincia::all();
  $ciudades = App\Ciudad::all();
  $delitos = DB::table("delitos")
  ->select(DB::raw("*"))
  ->orderBy(DB::raw("nombre","ASC"))
  ->get();
  $tipo_demandas = App\Tipo_demandas::all();
  $oderivados = App\Oderivados::all();
  $organismos = App\Organismo::all();
  $seguimientos = App\Seguimiento::all();
  return view("agregarderivacion", compact("seguimientos","oderivados","ciudades","provincias","delitos", "tipo_demandas","organismos"));
})->middleware('auth');
Route::post("/agregarderivacion","DerivacionController@agregar")->middleware('auth');
Route::get("/agregarseguimiento/{id}",function($id){
  $delitos = DB::table("delitos")
  ->select(DB::raw("*"))
  ->orderBy(DB::raw("nombre","ASC"))
  ->get();
  $tipo_demandas = App\Tipo_demandas::all();
  $oderivados = App\Oderivados::all();
  $organismos = App\Organismo::all();
  $seguimientos = App\Seguimiento::all();
  $ciudades = App\Ciudad::all();
  $provincias = App\Provincia::all();
  $departamentos=App\Departamento::all();
  session(["idDerivacion" => $id]);
  $derivacionActual = App\Derivacion::find(session("idDerivacion"));
  return view("agregarseguimiento", compact("derivacionActual","seguimientos","oderivados","ciudades","provincias","delitos", "tipo_demandas","organismos","departamentos"));
})->middleware('auth');
Route::post("/agregarseguimiento","DerivacionController@cargarSeguimiento")->middleware('auth');

/* route chancge pass

Route::get('cambiarPassword/{usuario}', 'PassController@index')->middleware('auth');
Route::get('sendemail/{email}',function($email){
 $users=App\User::All();
   foreach ($users as $user) {
    if($email==$user->email){
  $data = array('usuario'=>$user->email,
    'contraseña'=>$user->NewPass
);}}
  Mail::send('emails.welcome',$data,function($message)
  {
  
    $message->from('calde07@gmail.com','Ministerio de Acceso a la Justicia');
    $message->to('xul27@hotmail.com')->subject('Login Aplicaciòn Vìctimas');
 });
return "tu email ha sido enviado exitosamente";
});
Enviar mail con usuario y contraseña, escribir el mail en la ruta y  enviar
configurar el mail en la vista que se encuentra aquì resources\views\emails\welcome.blade.php
Route::get('sendemail/{email}',function($email){
 $users=App\User::All();
   foreach ($users as $user) {
    if($email==$user->email){
      session(["email" => $user->email]);
  $data = array('usuario'=>$user->email,
    'contraseña'=>$user->NewPass);
}}
if($data){
  Mail::send('emails.welcome',$data,function($message)
  {
  
    $message->from('stemassaj@mjus.gba.gob.ar','Ministerio de Acceso a la Justicia');
    $message->to(session("email"))->subject('Login Aplicación Víctimas');
 });
return "EMAIL ENVIADO EXITOSAMENTE";
}
});

Password Change Routes...

$this->get('password/change', 'Auth\ChangePasswordController@showChangePasswordForm')->name('password.change');
$this->post('password/change', 'Auth\ChangePasswordController@change')->name('password.change.post');



descarga la tabla Casos
use App\Exports\CasosExport;
use App\Exports\VictimasExport;
use App\Exports\IncidenciasExport;
use App\Exports\DerivacionesExport;

 
Route::get('/excel', function (CasosExport $casosExport,VictimasExport $victimasExport,IncidenciasExport $incidenciasExport,DerivacionesExport $derivacionesExport) {
   $user = Auth::user();
if ($user->hasRole('admin')) {
   $casosExport->store('casos.xlsx','public');
   $victimasExport->store('victimas.xlsx','public');
   $incidenciasExport->store('incidencias.xlsx','public');
   $derivacionesExport->store('derivaciones.xlsx','public');

 return Redirect::to("/home")->with('message','DESCARGA EXITOSA!');
}else{abort(403, "No tienes autorización para ingresar.");}})->middleware('auth');






CREAR CLAVES ALEATORIAS PARA CADA USUARIO(TABLA USERS) Y HASHEARLAS

ejecutar el primer foreach, genera claves aleatorias para cada user, luego ejecutar el segundo foreach hashea. Trabaja sobre la tabla Users
Route::get("/hasheo", "PassController@index")->middleware('auth');
storage/victimas.xlsx
storage/casos.xlsx*/
