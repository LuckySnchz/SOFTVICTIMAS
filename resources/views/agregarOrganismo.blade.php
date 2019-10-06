
<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" href="css/app.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <title>Eje F: Atención del caso</title>
      <style>
      </style>
   </head>
    <header>
      <section class="container jumbotron shadow p-3 mb-5 bg-white rounded"style="height: 150px" >
     @include('navbar')

                <a type="button"  href="/home" target="_self" style="width:100%; color:white;background-color:rgb(52, 144, 220);margin-bottom: -5%;margin-top: -12%" class="btn col-XL" class="btn btn-danger">IR A INICIO</button> </a><br><br>
      </section>        
      
   </header>

   <body>
      <h1 class="text-center" style="padding: 15px;">Eje F: Atención del caso.</h1>
      <h5 class="text-center" style="padding: -20px;">


      <label class="font-weight-bold">Caso: </label>
    {{$casoActual->nombre_referencia}}<br>


    <label class="font-weight-bold">Victima/s: </label>
 <strong style="color: red"><ul style="list-style:none">
           @foreach($victims as $victim)
             @if ($victim->idCaso == session("idCaso"))
               <li style="color: red;">

                       {{$victim->victima_nombre_y_apellido}}

               </li>
             @endif
           @endforeach
       </ul></strong></h5></div>
      <section class="container jumbotron shadow p-3 mb-5 bg-white rounded">
        
 @if ($errors->any())
          <div class="alert alert-danger">
         
{!! $errors->first('cual_otro_organismo', '<p class="help-block" style="color:red";>:message</p>') !!}

{!! $errors->first('socioeconomica_otro', '<p class="help-block" style="color:red";>:message</p>') !!}

{!! $errors->first('organismos_actual_otro', '<p class="help-block" style="color:red";>:message</p>') !!}

{!! $errors->first('fecha_de_solicitud', '<p class="help-block" style="color:red";>:message</p>') !!}


{!! $errors->first('letrado_designado', '<p class="help-block" style="color:red";>:message</p>') !!}
{!! $errors->first('pratocinio_conformidad', '<p class="help-block" style="color:red";>:message</p>') !!}

{!! $errors->first('colegio_departamental', '<p class="help-block" style="color:red";>:message</p>') !!}
{!! $errors->first('fecha_designacion', '<p class="help-block" style="color:red";>:message</p>') !!}
    
          </div>
        @endif
      <form class="" action="/agregarOrganismo" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="idCaso" value="{{session("idCaso")}}">

<!-F1 Intervino otro organismo previamente->

  <div class="form-group" {{ $errors->has('organismos_intervinieron') ? 'has-error' : ''}}>
  <label for="modalidad_ingreso">F 1.¿intervinieron otros organismos previamente?</label>
  <select class="form-control" name="organismos_intervinieron" id="organismos_intervinieron" onChange="selectOnChangeF1(this)" >
        <option value="" selected=disabled>Seleccionar...</option>
        @if(old("organismos_intervinieron") == 1)<option value="1" selected>Sí</option>
        @else<option value="1" >Sí</option>@endif

        @if(old("organismos_intervinieron") == 2)<option value="2" selected>No</option>
        @else<option value="2" >No</option>@endif

  @if(old("organismos_intervinieron") == 3)<option value="3" selected>Intervino solo el organismo que derivó </option>
        @else<option value="3" >Intervino solo el organismo que derivó </option>@endif


  @if(old("organismos_intervinieron") == 4)<option value="4" selected>Se Desconoce</option>
        @else<option value="4" >Se Desconoce</option>@endif


        
  </select><br>
  {!! $errors->first('organismos_intervinieron', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
  <div id="mostrar_previo" style="display: none">
<label>F 1I Listado de organismos que intervinieron previamente:</label><br>
  <label for="">En caso de requerir, tildar todas las opciones que considere correspondientes.</label>
</div>
  @if(old("organismos_intervinieron") == 1)

  <div class="organismos_previos_si" id="organismos_previos_si" {{ $errors->has('oprevios') ? 'has-error' : ''}}>
 

  @foreach ($oprevios as $oprevio)
      <label class="form-check-inline form-check-label">

        @if(is_array(old("oprevios")) && in_array($oprevio->id, old("oprevios")))
        <input type="checkbox" value="{{ $oprevio->id }}" class="form-check-inline oprevio2" name="oprevios[]" checked>
        @else
        <input type="checkbox" value="{{ $oprevio->id }}" class="form-check-inline oprevio2" name="oprevios[]">
        @endif
      {{ $oprevio->nombre }}
      </label><br>
  @endforeach
  {!! $errors->first('oprevios', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  @else
    <div class="organismos_previos_si" style="display:none" id="organismos_previos_si">
    @foreach ($oprevios as $oprevio)
        <label class="form-check-inline form-check-label">
        <input type="checkbox" value="{{ $oprevio->id }}" class="form-check-inline oprevio2" name="oprevios[]">
        {{ $oprevio->nombre }}
        </label><br>
    @endforeach

    </div>
  @endif


@if (is_array(old("oprevios")) && in_array("24", old("oprevios")))
  <div id="cualF1" {{ $errors->has('cual_otro_organismo') ? 'has-error' : ''}}>
@else
  <div id="cualF1" style="display: none">
@endif

  <label for="">Cuál?</label>
  <input class="form-control" name="cual_otro_organismo" id="cual_otro_organismo" type="text" value="{{old("cual_otro_organismo")}}">
  {!! $errors->first('cual_otro_organismo', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
  <br>
  </div>

 <script type="text/javascript">
        var limita = document.querySelectorAll(".oprevio2")
        var otro = limita[limita.length-1]

        otro.onclick = function(){
               $('#cual_otro_organismo').val('');
            $("#cualF1").toggle()
         }
         </script>
  <script>
     function selectOnChangeF1(sel) {
      if (sel.value=="1"){
          divC = document.getElementById("organismos_previos_si");
          divC.style.display = "";

 divC = document.getElementById("mostrar_previo");
          divC.style.display = "";
        }

          if (sel.value=="2"||sel.value=="3"||sel.value=="4"){
            divC = document.getElementById("organismos_previos_si");
            divC.style.display = "none";
            var checkboxes = divC.querySelectorAll('input');
             divC = document.getElementById("mostrar_previo");
          divC.style.display = "none";


            checkboxes.forEach(function (oneCheckbox) {
              oneCheckbox.checked = false;
            });
           document.querySelector('#cualF1').style.display = 'none';
           document.querySelector('#cual_otro_organismo').val(''); 
                 divC = document.getElementById("mostrar_previo");
          divC.style.display = "none"; 
      }}

  </script>


  <!-F2 Asistencia requerida->

    <div class="form-group" {{ $errors->has('requiere_asistencia') ? 'has-error' : ''}}>
    <label for="patrocinio">F 2.Requiere algún tipo de asistencia?</label>
    <select class="form-control" name="requiere_asistencia" onChange="selectOnChangeF2(this)">
        <option value=""selected=disabled>Seleccionar...</option>
        @if(old("requiere_asistencia") == 1) <option value="1" selected>Sí</option>
        @else<option value="1">Sí</option>@endif

        @if(old("requiere_asistencia") == 2) <option value="2" selected>No</option>
        @else<option value="2">No</option>@endif

        @if(old("requiere_asistencia") == 3) <option value="3" selected>Se Desconoce</option>
        @else<option value="3">Se Desconoce</option>@endif

    </select>
    {!! $errors->first('requiere_asistencia', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>
   


  @if(old("requiere_asistencia") == 1)

 <div class="tipo_asistencia" id="tipo_asistencia" {{ $errors->has('asitencias') ? 'has-error' : ''}}>
  @foreach ($asistencias as $asistencia)
      <label class="form-check-inline form-check-label">
        @if(is_array(old("asistencias")) && in_array($asistencia->id, old("asistencias")))
        <input type="checkbox" value="{{$asistencia->id }}"  class="form-check-inline tipoSocio" name="asistencias[]" checked>
        @else
        <input type="checkbox" value="{{ $asistencia->id }}"  class="form-check-inline tipoSocio " name="asistencias[]">
        @endif
      {{ $asistencia->nombre }}
      </label><br>
  @endforeach
  {!! $errors->first('asistencias', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  @else
    <div class="tipo_asistencia" style="display:none" id="tipo_asistencia">
    @foreach ($asistencias as $asistencia)
        <label class="form-check-inline form-check-label">
        <input type="checkbox" value="{{ $asistencia->id }}"   class="form-check-inline tipoSocio" name="asistencias[]">
        {{ $asistencia->nombre }}
        </label><br>
    @endforeach

    </div>
  @endif

    @if(is_array(old("asistencias")) && in_array(3, old("asistencias")))

    <div id="socioeco" {{ $errors->has('socioeconomicos') ? 'has-error' : ''}}>

    <label>F 2 II. Tipo de asistencia socioeconómica:</label>
    <label for="">En caso de requerir, tildar todas las opciones que considere correspondientes.</label><br>

      @foreach ($socioeconomicos as $socioeconomico)
        <label class="form-check-inline form-check-label">
          @if(is_array(old("socioeconomicos")) && in_array($socioeconomico->id,old("socioeconomicos")))
        <input type="checkbox" value="{{ $socioeconomico->id }}" class="form-check-inline socioOtro" name="socioeconomicos[]" checked>
      @else
        <input type="checkbox" value="{{ $socioeconomico->id }}" class="form-check-inline socioOtro" name="socioeconomicos[]">
      @endif
        {{ $socioeconomico->nombre }}
      </label><br>
      @endforeach
   {!! $errors->first('socioeconomicos', '<p class="help-block" style="color:red";>:message</p>') !!}   
    <br>
  </div>


  @else
    <div id="socioeco" style="display:none" >
    <label>F 2I. Tipo de asistencia socioeconómica:</label>
    <label for="">En caso de requerir, tildar todas las opciones que considere correspondientes.</label><br>
      @foreach ($socioeconomicos as $socioeconomico)
        <label class="form-check-inline form-check-label">
        <input type="checkbox" value="{{ $socioeconomico->id }}" class="form-check-inline socioOtro" name="socioeconomicos[]">
        {{ $socioeconomico->nombre }}
      </label><br>
      @endforeach
  </div>

  @endif



  @if (is_array(old("socioeconomicos")) && in_array("6", old("socioeconomicos")))
    <div id="cualF2I" {{ $errors->has('socioeconomica_otro') ? 'has-error' : ''}}>
    <label for="socioeconomica_otro_cualF2I">Cuál?:</label>
    <input class="form-control" name="socioeconomica_otro" type="text" id="socioeconomica_otro_cualF2I" value="{{old("socioeconomica_otro")}}">
    {!! $errors->first('socioeconomica_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>
  @else
    <div id="cualF2I"style="display:none">
    <label for="socioeconomica_otro_cualF2I">Cuál?:</label>
    <input class="form-control" name="socioeconomica_otro" value="{{old("socioeconomica_otro")}}" type="text" id="socioeconomica_otro_cualF2I">
    </div>
  @endif
</div>

 <script type="text/javascript">
        var limita = document.querySelectorAll(".socioOtro")
        var otro = limita[limita.length-1]

        otro.onclick = function(){
               $('#socioeconomica_otro_cualF2I').val('');
            $("#cualF2I").toggle()
         }
         </script>
  <script>
           function selectOnChangeF2(sel) {
                          if (sel.value=="1"){
                              divC = document.getElementById("tipo_asistencia");
                              divC.style.display = "";

                            }

                            if (sel.value=="2"||sel.value=="3"){
                                divC = document.getElementById("tipo_asistencia");
                                divC.style.display = "none";
                              var checkboxes = divC.querySelectorAll('input');


            checkboxes.forEach(function (oneCheckbox) {
              oneCheckbox.checked = false;
            })


                              divf2 = document.getElementById("socioeco");
                              divf2.style.display = "none";
                              var checkboxes = divf2.querySelectorAll('input');


                              checkboxes.forEach(function (oneCheckbox) {
                                oneCheckbox.checked = false;
                              })

                              document.querySelector('#cualF2I').style.display = 'none';

                              document.querySelector('#socioeconomica_otro_cualF2I').val('');
                              }


                        }


         </script>



  <script type="text/javascript">

    var socio = document.querySelectorAll(".socioOtro")
    var otro2 = socio[socio.length-1]

    otro2.onclick = function(){
       document.querySelector('#socioeconomica_otro_cualF2I').value = '';
        $("#cualF2I").toggle();

     }
  </script>



  <script type="text/javascript">
    var tipo = document.querySelectorAll(".tipoSocio")
    var tipo2 = tipo[tipo.length-1]


    tipo2.onclick = function(){
    
        $("#socioeco").toggle();
         
              divf2 = document.getElementById("socioeco");
                          
                              var checkboxes = divf2.querySelectorAll('input');


                              checkboxes.forEach(function (oneCheckbox) {
                                oneCheckbox.checked = false;
                              })

                              document.querySelector('#cualF2I').style.display = 'none';

                              document.querySelector('#socioeconomica_otro_cualF2I').value = '';
                              }


            
  
     
  </script>

                  






                


  <!-F3 Organismo que articula->

  <div class="form-group" {{ $errors->has('organismo_articula_si_no') ? 'has-error' : ''}}>
  <label>F 3.¿Actualmente articula con algún organismo?</label>
  <select class="form-control" name="organismo_articula_si_no" id="organismo_articula_si_no" onChange="selectOnChangeF3A(this)" >
        <option value="" selected=disabled>Seleccionar...</option>
        @if(old("organismo_articula_si_no") == 1)<option value="1" selected>Sí</option>
        @else<option value="1" >Sí</option>@endif

        @if(old("organismo_articula_si_no") == 2)<option value="2" selected>No</option>
        @else<option value="2" >No</option>@endif

          @if(old("organismo_articula_si_no") == 3)<option value="3" selected>Se desconoce</option>
          @else<option value="3" >Se desconoce</option>@endif

  </select><br>
  {!! $errors->first('organismo_articula_si_no', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>


@if(old("organismo_articula_si_no") == 1)

  <div class="form-group"  id="organismo_articula_si" {{ $errors->has('oarticulas') ? 'has-error' : ''}}>
  @else
    <div class="form-group" id="organismo_articula_si" style="display:none">
    @endif

  <div >
  <label>F 3 1. Organismos con los que se articula actualmente:</label>
  <label for="">En caso de requerir, tildar todas las opciones que considere correspondientes.</label><br>
  <div class="Auno">
    @foreach ($oarticulas as $oarticula)
    <label class="form-check-inline form-check-label">
      @if(is_array(old("oarticulas")) && in_array($oarticula->id, old("oarticulas")))
    <input type="checkbox" value="{{ $oarticula->id }}" class="form-check-inline oarticula2" name="oarticulas[]" checked>
  @else
    <input type="checkbox" value="{{ $oarticula->id }}" class="form-check-inline oarticula2" name="oarticulas[]">
  @endif
    {{ $oarticula->nombre }}
    </label><br>
    @endforeach

  </div>
  </div>
  {!! $errors->first('oarticulas', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

@if (is_array(old("oarticulas")) && in_array("24", old("oarticulas")))
  <div id="cualF3" {{ $errors->has('organismos_actual_otro') ? 'has-error' : ''}}>
@else
<div id="cualF3"style="display:none">
@endif
  <label for="organismos_actual_otro_cualF4">Cuál?:</label>
  <input class="form-control" name="organismos_actual_otro" type="text" id="organismos_actual_otro_cualF3" value="{{old("organismos_actual_otro")}}">
  {!! $errors->first('organismos_actual_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>


  <script>
     function selectOnChangeF3A(sel) {
      if (sel.value=="1"){
          divC = document.getElementById("organismo_articula_si");
          divC.style.display = "";}


          if (sel.value=="2"||sel.value=="3"){
            divC = document.getElementById("organismo_articula_si");
            divC.style.display = "none";
            var checkboxes = divC.querySelectorAll('input');


            checkboxes.forEach(function (oneCheckbox) {
              oneCheckbox.checked = false;
            })

            document.querySelector('#cualF3').style.display = 'none';

            document.querySelector('#organismos_actual_otro_cualF3').vaL('');
      }


     }

  </script>

  <script type="text/javascript">
    var oprevios = document.querySelectorAll(".oarticula2")
    var otro = oprevios[oprevios.length-1]

    otro.onclick = function(){
      document.querySelector('#organismos_actual_otro_cualF3').value = '';
        $("#cualF3").toggle()



     }
  </script>


  <!-F4 Tiene abogado particular->

    <div class="form-group" {{ $errors->has('abogado_particular') ? 'has-error' : ''}}>
    <label for="abogado_particular">F 4.¿Cuenta con abogado particular?:</label>
    <select class="form-control" onChange="selectOnChangeF4(this)" name="abogado_particular" id="abogado_particular">

      <option value="" selected=disabled>Seleccionar...</option>

      @if(old("abogado_particular") == 1) <option value="1" selected>Sí</option> @else<option value="1" >Sí</option>@endif
      @if(old("abogado_particular") == 2) <option value="2" selected>No</option>
      @else<option value="2" >No</option>@endif
      @if(old("abogado_particular") == 3) <option value="3" selected>Se desconoce</option>
      @else<option value="3">Se desconoce</option>@endif
    </select>
    {!! $errors->first('abogado_particular', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>




<!-F5 Patrocinio jurídico->


@if(old("abogado_particular") == 2||old("abogado_particular")==3)
  <div class="form-group" id="Patro"  {{ $errors->has('pratocinio_gratuito') ? 'has-error' : ''}}>
  @else
    <div class="form-group" id="Patro" style="display:none">
  @endif



  <label for="patrocinio">F 5.Patrocinio jurídico gratuito:</label>
  <select class="form-control" name="pratocinio_gratuito" id="pratocinio_gratuito" onChange="selectOnChangeF6(this)">

<option value="" selected=disabled>Seleccionar...</option>
      @if(old("pratocinio_gratuito") == 1) <option value="1" selected>Requiere</option>
      @else<option value="1">Requiere</option>@endif

      @if(old("pratocinio_gratuito") == 2) <option value="2" selected>A la espera de designación</option>
      @else<option value="2">A la espera de designación</option>@endif

      @if(old("pratocinio_gratuito") == 3) <option value="3" selected>Designado</option>
      @else<option value="3">Designado</option>@endif

      @if(old("pratocinio_gratuito") == 4) <option value="4" selected>No requiere</option>
      @else<option value="4">No requiere</option>@endif

       @if(old("pratocinio_gratuito") == 5) <option value="4" selected>Se Desconoce</option>
      @else<option value="5">Se Desconoce</option>@endif

  </select>
  {!! $errors->first('pratocinio_gratuito', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  @if(old("pratocinio_gratuito") == 1 || old("pratocinio_gratuito") == 2)
    <div class="form-group" id="solicitud" {{ $errors->has('fecha_de_solicitud') ? 'has-error' : ''}}>
  @else
    <div class="form-group" id="solicitud" style="display:none">
  @endif
  <label>F 5 I. Fecha de solicitud:</label>
  <input type="date" class="form-control" name="fecha_de_solicitud" id="fecha_de_solicitud" value="{{old("fecha_de_solicitud")}}">
  <label id="bloqueo1" class="form-check-label">Se desconoce</label>
  <input type="checkbox" onchange="checkf51(this)" id="bloqueof5" name="fecha_de_solicitud_se_desconoce" value="Se desconoce">
  {!! $errors->first('fecha_de_solicitud', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>


<script type="text/javascript">
function selectOnChangeF4(sel) {
 if (sel.value=="2" || sel.value=="3"){
     divf4 = document.getElementById("Patro");
     divf4.style.display = "";
   divf42 = document.getElementById("fecha_de_solicitud");
       divf42.style.display = "";
        divf44 = document.getElementById("bloqueof5");
       divf44.style.display = "";
   }

 if (sel.value=="1") {
       divf4 = document.getElementById("Patro");
       divf4.style.display = "none";
       $('#pratocinio_gratuito').val('');
       divf46 = document.getElementById("solicitud");
       divf46.style.display = "none";     
       $('#fecha_de_solicitud').val('');
       divf43 = document.getElementById("fecha_de_solicitud");
       divf43.style.display = "none";
       document.getElementById("bloqueof5").checked=false;
       divf44 = document.getElementById("bloqueof5");
       divf44.style.display = "none";

       cualF6 = document.getElementById("cualF6");
       cualF6.style.display = "none"; 
       $("#letrado_designado").val('');
     
       document.getElementById("bloqueof7").checked=false;

       $("#pratocinio_gratuito-designado").val('');
      
      $('#colegio_departamental').val('');
       document.getElementById("bloqueo5").checked=false;

     $('#fecha_designacion_si').val('');
       divf43 = document.getElementById("fecha_designacion_si");
       divf43.style.display = "none";      
       document.getElementById("bloqueo54").checked=false; 

             
     

        

     }
     }
</script>

  
<script type="text/javascript">

   function checkf51(checkbox)
   {
       if (checkbox.checked)
       {
           $('#fecha_de_solicitud').val('1900-01-01');
           document.getElementById('fecha_de_solicitud').setAttribute("readonly", "readonly");

       }else
           {
               $('#fecha_de_solicitud').val('');
               document.getElementById('fecha_de_solicitud').removeAttribute("readonly");
           }
   }

</script>



  @if(old("pratocinio_gratuito") == 3)

  <div id="cualF6" >

    @else
  <div id="cualF6" style="display: none">
   @endif

{!! $errors->first('letrado_designado', '<p class="help-block" style="color:red";>:message</p>') !!}
<div id="solicitud_designado" {{ $errors->has('fecha_solicitud_designacion') ? 'has-error' : ''}}>
    <label for="">F 5 I. Fecha de Solicitud: </label>
    <input type="date" class="form-control" id="fecha_solicitud_designacion" name="fecha_solicitud_designacion" value="{{old('fecha_solicitud_designacion')}}">
    <label for="bloqueo5I" class="form-check-label">Se desconoce</label>
    <input type="checkbox" id="bloqueo5I" name="fecha_solicitud_designacion_desconoce" value="Se desconoce" onchange="checkF5I(this)">
    <script>
         function checkF5I(checkbox)
         {
             if (checkbox.checked)
             {
                 $('#fecha_solicitud_designacion').val('1900-01-01');
                 document.getElementById('fecha_solicitud_designacion').setAttribute("readonly", "readonly");
             }else
                 {
                     $('#fecha_solicitud_designacion').val('');
                     document.getElementById('fecha_solicitud_designacion').removeAttribute("readonly");
                 }
         }
      </script>
    {!! $errors->first('fecha_solicitud_designacion', '<p class="help-block" style="color:red";>:message</p>') !!}
<br><br>
</div>
<div id="designado" {{ $errors->has('letrado_designado') ? 'has-error' : ''}}>
  <label for="letrado_designado">F 5 II. Nombre y Apellido del letrado designado:</label>
  <input type="text" class="form-control" name="letrado_designado" id="letrado_designado" 
   value="{{old('letrado_designado')}}">
  <label  class="form-check-label">Se desconoce</label>
  <input type="checkbox" id="bloqueof7" name="letrado_designado" value="Se desconoce" onchange="checkC111(this)">
  

   <script>
                     function checkC111(checkbox)
                     {
                         if (checkbox.checked)
                             {
                                 $('#letrado_designado').val('Se desconoce');
                                 document.getElementById('letrado_designado').setAttribute("readonly", "readonly");

                             }else
                                 {
                                     $('#letrado_designado').val('');
                                     document.getElementById('letrado_designado').removeAttribute("readonly");
                                 }
                     }
                  </script>
             

</div><br>



    <!-F5 2>
  <div class="form-group " id="conformidad" {{ $errors->has('pratocinio_conformidad') ? 'has-error' : ''}}>
  <label for="pratocinio_conformidad">F 5 III.¿La víctima está conforme con la asistencia recibida por parte del letrado designado?:</label>
  <select class="form-control" name="pratocinio_conformidad" id="pratocinio_gratuito-designado" >
  <option value="" selected=disabled>Seleccionar...</option>
          @if(old("pratocinio_conformidad") == 1) <option value="1" selected>Sí</option>
          @else<option value="1" >Sí</option>@endif
          @if(old("pratocinio_conformidad") == 2) <option value="2" selected>No</option>
          @else<option value="2" >No</option>@endif
          @if(old("pratocinio_conformidad") == 3) <option value="3" selected>Se desconoce</option>
          @else<option value="3">Se desconoce</option>@endif
  </select>
  {!! $errors->first('pratocinio_conformidad', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
  <br>
    <!-F5 3>
  <div class="form-group" id="colegio" {{ $errors->has('colegio_departamental') ? 'has-error' : ''}}>
  <label for="colegio_departamental">F 5 IV.Colegio Departamental:</label>
  <select class="form-control" name="colegio_departamental" id="colegio_departamental">

   <option value="" selected=disabled>Seleccionar...</option>
    @foreach ($departamentos as $departamento)
      @if(old("colegio_departamental")==$departamento->id)
      <option selected value="{{ $departamento->id }}">{{ $departamento->nombre}}</option>
    @else <option  value="{{ $departamento->id }}">{{ $departamento->nombre}}</option>
    @endif
  @endforeach
  </select>
  {!! $errors->first('colegio_departamental', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
  <div id="designacion_si"{{ $errors->has('fecha_designacion') ? 'has-error' : ''}}>

     <label>F 5 V. Fecha de designación:  </label>

  
    <input type="date" class="form-control" id="fecha_designacion_si" name="fecha_designacion" value="{{old('fecha_designacion')}}">
 

      <label  class="form-check-label">Se desconoce</label>
    <input type="checkbox" id="bloqueo54" name="fecha_designacion_desconoce" value="Se desconoce" onchange="checkB54(this)">

    {!! $errors->first('fecha_designacion', '<p class="help-block" style="color:red";>:message</p>') !!}
    
</div>

</div>
  <br>

  <div class="btn-1"> <button style="width:100%" type="submit" class="btn btn-primary col-xL" name="button">Agregar/Enviar</button><br><br></div>
              </form>

      </section>




<script type="text/javascript">
  function selectOnChangeF6(sel) {
   if (sel.value=="1" || sel.value=="2"){
       divf4 = document.getElementById("solicitud");
       divf4.style.display = "";
               cualF6 = document.getElementById("cualF6");
       cualF6.style.display = "none"; 
       $("#letrado_designado").val('');
     
       document.getElementById("bloqueof7").checked=false;

       $("#pratocinio_gratuito-designado").val('');
      
      $('#colegio_departamental').val('');
       document.getElementById("bloqueo5").checked=false;

 $('#fecha_solicitud_designacion').val('');
       divf43 = document.getElementById("fecha_solicitud_designacion");
       divf43.style.display = "none";      
       document.getElementById("bloqueo5I").checked=false; 
      
    $('#fecha_designacion_si').val('');
       divf43 = document.getElementById("fecha_designacion_si");
       divf43.style.display = "none";      
       document.getElementById("bloqueo54").checked=false; 

    
         }
       else {
         divf4 = document.getElementById("solicitud");
         divf4.style.display = "none";
         
         document.getElementById("bloqueof5").checked=false;
         $('#fecha_de_solicitud').val('');
         document.getElementById('fecha_de_solicitud').removeAttribute("readonly");


       }


if (sel.value=="3"){
      cualF6 = document.getElementById("cualF6");
       cualF6.style.display = "";

      }

 if (sel.value=="4") {
      cualF6 = document.getElementById("cualF6");
       cualF6.style.display = "none"; 
       $("#letrado_designado").val('');
     
       document.getElementById("bloqueof7").checked=false;

       $("#pratocinio_gratuito-designado").val('');
      
      $('#colegio_departamental').val('');
       document.getElementById("bloqueo5").checked=false;


       $('#fecha_designacion_si').val('');
       divf43 = document.getElementById("fecha_designacion_si");
       divf43.style.display = "none";      
       document.getElementById("bloqueo54").checked=false; 
     

      $('#fecha_solicitud_designacion').val('');
       divf43 = document.getElementById("fecha_solicitud_designacion");
       divf43.style.display = "none";      
       document.getElementById("bloqueo5I").checked=false; 

        }



       }
  </script>
  <script>
         function checkB54(checkbox)
         {
             if (checkbox.checked)
             {
                 $('#fecha_designacion_si').val('1900-01-01');
                 document.getElementById('fecha_designacion_si').setAttribute("readonly", "readonly");
             }else
                 {
                     $('#fecha_designacion_si').val('');
                     document.getElementById('fecha_designacion_si').removeAttribute("readonly");
                 }
         }
      </script>
            <script>
               function muestroCualF2I() {
                   var checkBox = document.getElementById("checkeadoF2I");
                   var text = document.getElementById("cualF2I");
                   if (checkBox.checked == true){
                       text.style.display = "block";
                   } else {
                      $('#socioeconomica_otro_cualF2I').val('');
                      text.style.display = "none";
                   }
               }

            </script>
            <script>
               function muestrosocioeco(){
                   var checkBox = document.getElementById("checkeadosocioeco");
                   var text = document.getElementById("socioeco");
                   if (checkBox.checked == true){
                       text.style.display = "block";
                   } else {
                      document.getElementById("Salud").checked= false;
                      document.getElementById("Educacion").checked= false;
                      document.getElementById("Trabajo").checked= false;
                      document.getElementById("Vivienda").checked= false;
                      document.getElementById("Vincular").checked= false;
                      document.getElementById("checkeadoF2I").checked= false;
                      $('#socioeconomica_otro_cualF2I').val('');
                      var text2 = document.getElementById("cualF2I");
                      text.style.display = "none";
                       text2.style.display = "none";
                   }
               }

            </script>
            <script>
               function muestroCualF4() {
                   var checkBox = document.getElementById("checkeadoF4");
                   var text = document.getElementById("cualF4");
                   if (checkBox.checked == true){
                       text.style.display = "block";
                   } else {
                      $('#organismos_actual_otro_cualF4').val('');
                      text.style.display = "none";
                   }
               }

            </script>
            <script>
               function checkD2(checkbox)
               {
                   if (checkbox.checked)
                   {
                       $('#victima_fecha_hecho').val('1900-01-01');
                       document.getElementById('victima_fecha_hecho').setAttribute("readonly", "readonly");
                   }else
                       {
                           $('#victima_fecha_hecho').val('');
                           document.getElementById('victima_fecha_hecho').removeAttribute("readonly");
                       }
               }
            </script>
            

      

    
  


      
         

   </body>
</html>
