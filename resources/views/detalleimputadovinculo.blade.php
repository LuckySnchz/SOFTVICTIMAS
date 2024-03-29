<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" href="css/app.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <title>Eje E: Datos del imputado</title>
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

  <h1 class="text-center" style="padding: 15px;">Eje E: Datos del imputado</h1>


    <div class="divpersona" id="divpersona">  <h2 class="text-center" style="padding: -20px;">Imputados</h2><h5 class="text-center" style="padding: -20px;">

      </h5></div>

  <form class="ejeC" action="/detalleimputadovinculo" method="post">
  {{ csrf_field() }}
   <input type="hidden" name="idCaso" value="{{session("idCaso")}}">
  <input type="hidden" name="idImputado" value="{{session("idImputado")}}">
  <input type="hidden" name="userID_modify" value="{{$imputado->userID_modify}}">
  <input type="hidden" name="idVictim" value="{{session("idVictim")}}">



<section class="container jumbotron shadow p-3 mb-5 bg-white rounded" >

<!E1 Nombre y apellido Imputado>

  <h3>Datos del Imputado:</h3>
  <div class="form-group" {{ $errors->has('imputado_nombre_y_apellido') ? 'has-error' : ''}}>
  <label for="">E 1. Nombre y apellido:</label>
  <input disabled type="text" class="form-control" name="imputado_nombre_y_apellido" id="imputado_nombre_y_apellido" value="{{$nombre_y_apellido}}"><br>
  <label for="bloqueo1" class="form-check-label">Se desconoce</label>
  <input disabled type="checkbox" id="bloqueo1" name="imputado_nombre_y_apellido" value="Se desconoce" onchange="checkE1(this)">
  {!! $errors->first('imputado_nombre_y_apellido', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
      <script>
                     function checkE1(checkbox)
                     {
                         if (checkbox.checked)
                             {
                                 $('#imputado_nombre_y_apellido').val('Se desconoce');
                                 document.getElementById('imputado_nombre_y_apellido').setAttribute("readonly", "readonly");
                             }else
                                 {
                                     $('#imputado_nombre_y_apellido').val('');
                                     document.getElementById('imputado_nombre_y_apellido').removeAttribute("readonly");
                                 }
                     }
                  </script>

<!E2 Apodo>
  <div class="form-group" {{ $errors->has('apodo') ? 'has-error' : ''}}>
  <label for="">E 2. Apodo: </label>
  <input disabled type="text" class="form-control" name="apodo" id="apodo" value="{{$apodo}}">
  <label for="bloqueo6" class="form-check-label">Se desconoce</label>
  <input disabled type="checkbox" id="bloqueo6" name="apodo" value="Se desconoce" onchange="checkEApodo(this)">
  {!! $errors->first('apodo', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
          <script>
               function checkEApodo(checkbox)
               {
                  if (checkbox.checked)
                      {
                          $('#apodo').val('Se desconoce');
                          document.getElementById('apodo').setAttribute("readonly", "readonly");
                      }else
                          {
                              $('#apodo').val('');
                              document.getElementById('apodo').removeAttribute("readonly");
                          }
               }
            </script>







<!E3 Tipo de documentación>

  <div class="form-group " id="tipodoc" {{ $errors->has('tipo_documento_id') ? 'has-error' : ''}}>
  <label for="">E 3. Documentación:</label>
  <select disabled class="form-control" id="tipo_documento_id" name="tipo_documento_id" onChange="selectOnChangeE2(this)">
      <option value="" selected=disabled>Seleccionar...</option>
      @if($tipo_documento_id==1)<option value="1" selected>D.N.I.</option> @else<option value="1" >D.N.I.</option>@endif

      @if($tipo_documento_id ==2)<option value="2" selected>Documento Extranjero</option>
      @else<option value="2">Documento Extranjero</option>@endif

      @if($tipo_documento_id ==3)<option value="3" selected>Libreta Cívica</option>
      @else<option value="3">Libreta Cívica</option>@endif

      @if($tipo_documento_id ==4)<option value="4" selected>Libreta de Enrolamiento</option>
      @else<option value="4" >Libreta de Enrolamiento</option>@endif

      @if($tipo_documento_id ==5)<option value="5" selected>Pasaporte</option>
      @else<option value="5">Pasaporte</option>@endif

      @if($tipo_documento_id ==6)<option value="6" selected>Residencia Precaria</option>
      @else<option value="6">Residencia Precaria</option> @endif

      @if($tipo_documento_id ==7)<option value="7" selected>Se Desconoce</option>
      @else<option value="7">Se Desconoce</option> @endif

      @if($tipo_documento_id ==8)<option value="8" selected>No posee</option>
      @else<option value="8">No posee</option>@endif

      @if($tipo_documento_id ==9)<option value="9" selected>Otro</option>
      @else<option value="9">Otro</option>@endif
  </select>
  {!! $errors->first('tipo_documento_id', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  @if($tipo_documento_id == 9)
    <div id="cualE2" {{ $errors->has('imputado_tipo_documento_otro') ? 'has-error' : ''}}>
  @else
    <div id="cualE2" style="display: none">
  @endif

  <label for="">Cual?</label>
  <div class="">
  <input  disabled name="imputado_tipo_documento_otro"  id="imputado_tipo_documento_otro" class="form-control" type="text" value="{{$tipo_documento_otro}}">
  {!! $errors->first('imputado_tipo_documento_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
  </div>

                  <script>
                     function selectOnChangeE2(sel) {
                     	if (sel.value=="9"){
                     		divC = document.getElementById("cualE2");
                     		divC.style.display = "";
                     	}else{
                     		divC = document.getElementById("cualE2");
                     		$('#imputado_tipo_documento_otro').val('');
                     		divC.style.display="none";
                     	}
                     

                


                     	if (sel.value=="7" || sel.value=="8"){
                     		divC = document.getElementById("nrodoc");
                     		divC.style.display = "none";
                        $('#imputado_documento').val('');
                     	}else{
                        divC = document.getElementById("nrodoc");
                     		divC.style.display = "";
                        document.getElementById("imputado_documento").removeAttribute("readonly");
                        document.getElementById("bloqueo4").checked=false;
                     	}
                     }

                  </script>


<!E4 Nro documento>

  <div class="form-group" id="nrodoc" {{ $errors->has('imputado_documento') ? 'has-error' : ''}}>
  <label for="">E 4. Nro Documento:</label>
  <input disabled type="text" class="form-control" name="imputado_documento" placeholder="" id="imputado_documento" value="{{$documento_nro}}">
  <label for="bloqueo3" class=" form-check-inline form-check-label"> </label>Se desconoce</label>
  <input disabled type="checkbox" id="bloqueo4" class="form-check-inline" name="imputado_documento" value="0" onchange="checkE3(this)">

  {!! $errors->first('imputado_documento', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
                  <script>
                     function checkE3(checkbox)
                     {
                         if (checkbox.checked)
                         {
                             $('#imputado_documento').val('Se desconoce');
                             document.getElementById('imputado_documento').setAttribute("readonly", "readonly");

                         }else
                             {
                                 $('#imputado_documento').val('');
                                 document.getElementById('imputado_documento').removeAttribute("readonly");

                             }
                     }
                  </script>
                  <br>

<!E5 Vinculación con la victima>

  <div class="form-group" {{ $errors->has('vinculo_victima') ? 'has-error' : ''}}>
  <label for="vinculo_id">E 5. Vinculación con la víctima:</label>
  <select  style="background-color: red; color:black"  class="form-control vinculo" onChange="selectOnChangeE4(this)" name="vinculo_victima"  id="vinculo_victima">
      <option value="" selected=disabled>Seleccionar...</option>
      @if($vinculo_victima == 1) <option value="1" selected>Familiar</option>
      @else <option value="1" >Familiar</option>@endif

      @if($vinculo_victima == 2) <option value="2" selected>Pareja</option>
      @else<option value="2" >Pareja</option>@endif

      @if($vinculo_victima == 3) <option value="3" selected>Amistad</option>
      @else<option value="3" >Amistad</option>@endif

      @if($vinculo_victima == 4) <option value="4" selected>Conocido</option>
      @else<option value="4" >Conocido</option>@endif

      @if($vinculo_victima == 5) <option value="5" selected>Sin vínculo</option>
      @else<option value="4" >Sin Vínculo</option>@endif

      @if($vinculo_victima == 6) <option value="6" selected>Otro</option>
      @else<option value="6" >Otro</option>@endif

      @if($vinculo_victima == 7) <option value="7" selected>Se desconoce</option>
      @else<option value="7" >Se desconoce</option>@endif
  </select>
  {!! $errors->first('vinculo_id', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  @if($vinculo_victima == 6||$errors->has('vinculo_otro'))
    <div id="cualE4" {{ $errors->has('vinculo_otro') ? 'has-error' : ''}}>
  @else
    <div id="cualE4" style="display: none">
  @endif

  <label for="vinculo_otro">Cuál?</label>
  <input type="text" class="form-control vinculo_otro" name="vinculo_otro" id="vinculo_otro" value="{{$vinculo_otro}}">
  {!! $errors->first('vinculo_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
  <br>

    <script>
                     function selectOnChangeE4(sel) {
                      if (sel.value=="1"||sel.value=="2"||sel.value=="3"||sel.value=="4"||sel.value=="5"||sel.value=="6"||sel.value=="7"){
              divCcc = document.getElementById("vinculo_victima");
       divCcc.style.backgroundColor = 'white';
           }
                     							 if (sel.value=="6"){
                     									 divC = document.getElementById("cualE4");
                     									 divC.style.display = "";
                     							 }else{
                     									 divC = document.getElementById("cualE4");
                     									 $('#vinculo_otro').val('');
                     									 divC.style.display="none";
                     							 }}
                  </script>

<!E6 Caratulación judicial>

  <div class="form-group" {{ $errors->has('caratulacion_judicial') ? 'has-error' : ''}}>
  <label for="caratulacion_judicial">E 6. Caratulación judicial:</label>
  <input disabled type="text" class="form-control" name="caratulacion_judicial" id="caratulacion_judicial" value="{{$caratulacion_judicial}}">
  {!! $errors->first('caratulacion_judicial', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

<!E7 Existencia de antecedentes penales>

  <div class="form-group" {{ $errors->has('antecedentes_id') ? 'has-error' : ''}}>
  <label for="antecedentes_id">E 7. Existencia de antecedentes penales:</label>
  <select disabled  onChange="selectOnChangeE7(this)" class="form-control vinculo" name="antecedentes_id">
        <option value="" selected=disabled>Seleccionar...</option>
        @if($antecedentes_id == 1) <option value="1" selected>Sí</option>
        @else <option value="1" >Sí</option>@endif

        @if($antecedentes_id == 2) <option value="2" selected>No</option>
        @else <option value="2" >No</option>@endif

        @if($antecedentes_id  == 3) <option value="3" selected>Se desconoce</option>
        @else <option value="3" >Se desconoce</option>@endif
  </select>
  {!! $errors->first('antecedentes_id', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  @if($antecedentes_id  == 1)
    <div class="form-group" id="antecedentesD" {{ $errors->has('antecedentes') ? 'has-error' : ''}}>
  @else
    <div class="form-group" id="antecedentesD" style="display: none">
  @endif


  <label for="">E 7. I. Descripción de los antecedentes: </label>
  <input disabled type="text" class="form-control" name="antecedentes" id="antecedentes" value="{{$antecedentes}}">
  <label for="bloqueo6" class="form-check-label">Se desconoce</label>
  <input disabled type="checkbox" id="bloqueo7" name="antecedentes" value="Se desconoce" onchange="checkEAn(this)">
  {!! $errors->first('antecedentes', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  <script>
     function selectOnChangeE7(sel) {


      if (sel.value=="2" || sel.value=="3"){
        divC = document.getElementById("antecedentesD");
        divC.style.display = "none";
        $('#antecedentes').val('');
      }else{
        divC = document.getElementById("antecedentesD");
        divC.style.display = "";
        document.getElementById("antecedentes").removeAttribute("readonly");
        document.getElementById("bloqueo7").checked=false;
      }
     }

  </script>
          <script>
               function checkEAn(checkbox)
               {
               		if (checkbox.checked)
               				{
               						$('#antecedentes').val('Se desconoce');
               						document.getElementById('antecedentes').setAttribute("readonly", "readonly");
               				}else
               						{
               								$('#antecedentes').val('');
               								document.getElementById('antecedentes').removeAttribute("readonly");
               						}
               }
            </script>

<!E8 Detenido>

<div class="form-group" {{ $errors->has('detenido') ? 'has-error' : ''}}>
<label>E 8. Está detenido?:</label>
<select disabled onChange="selectOnChangeE8(this)" class="form-control vinculo" name="detenido">
      <option value="" selected=disabled>Seleccionar...</option>
      @if($detenido == 1) <option value="1" selected>Sí</option>
      @else <option value="1" >Sí</option>@endif

      @if($detenido == 2) <option value="2" selected>No</option>
      @else <option value="2" >No</option>@endif

      @if($detenido == 3) <option value="3" selected>Se desconoce</option>
      @else <option value="3" >Se desconoce</option>@endif
</select>
{!! $errors->first('detenido', '<p class="help-block" style="color:red";>:message</p>') !!}
</div>

@if($detenido == 1)
  <div class="form-group" id="detenido" {{ $errors->has('lugar_de_alojamiento') ? 'has-error' : ''}}>
@else
  <div class="form-group" id="detenido" style="display: none">
@endif


<label for="">E 8. I. Lugar de alojamiento: </label>
<input disabled type="text" class="form-control" name="lugar_de_alojamiento" id="lugar_de_alojamiento" value="{{$lugar_de_alojamiento}}">
<label for="bloqueo6" class="form-check-label">Se desconoce</label>
<input disabled type="checkbox" id="bloqueo8" name="lugar_de_alojamiento" value="Se desconoce" onchange="checkELu(this)">
{!! $errors->first('lugar_de_alojamiento', '<p class="help-block" style="color:red";>:message</p>') !!}
</div>

<script>
   function selectOnChangeE8(sel) {


    if (sel.value=="2" || sel.value=="3"){
      divC = document.getElementById("detenido");
      divC.style.display = "none";
      $('#lugar_de_alojamiento').val('');
    }else{
      divC = document.getElementById("detenido");
      divC.style.display = "";
      document.getElementById("lugar_de_alojamiento").removeAttribute("readonly");
      document.getElementById("bloqueo8").checked=false;
    }
   }

</script>

        <script>
             function checkELu(checkbox)
             {
                if (checkbox.checked)
                    {
                        $('#lugar_de_alojamiento').val('Se desconoce');
                        document.getElementById('lugar_de_alojamiento').setAttribute("readonly", "readonly");
                    }else
                        {
                            $('#lugar_de_alojamiento').val('');
                            document.getElementById('lugar_de_alojamiento').removeAttribute("readonly");
                        }
             }
          </script>


  <!E9 Defensor particular>

  <div class="form-group" {{ $errors->has('defensor_particular') ? 'has-error' : ''}}>
  <label>E 9. Cuenta con defensor particular?:</label>
  <select disabled  class="form-control vinculo" name="defensor_particular">
        <option value="" selected=disabled>Seleccionar...</option>
        @if($defensor_particular == 1) <option value="1" selected>Sí</option>
        @else <option value="1" >Sí</option>@endif

        @if($defensor_particular == 2) <option value="2" selected>No</option>
        @else <option value="2" >No</option>@endif

        @if($defensor_particular == 3) <option value="3" selected>Se desconoce</option>
        @else <option value="3" >Se desconoce</option>@endif
  </select>
  {!! $errors->first('defensor_particular', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>


<!E10 Defensoría>

  <div class="form-group" {{ $errors->has('defensoria_numero') ? 'has-error' : ''}}>
  <label for="">E 10. Defensoría N°: </label>
  <input disabled type="text" class="form-control" name="defensoria_numero" id="defensoria_numero" value="{{$defensoria_nro}}">
  <label for="bloqueo6" class="form-check-label">Se desconoce</label>
  <input disabled type="checkbox" id="bloqueo6" name="defensoria_numero" value="Se desconoce" onchange="checkE6(this)">
  {!! $errors->first('defensoria_numero', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
          <script>
               function checkE6(checkbox)
               {
               		if (checkbox.checked)
               				{
               						$('#defensoria_numero').val('Se desconoce');
               						document.getElementById('defensoria_numero').setAttribute("readonly", "readonly");
               				}else
               						{
               								$('#defensoria_numero').val('');
               								document.getElementById('defensoria_numero').removeAttribute("readonly");
               						}
               }
            </script>

<!-E11 Fiscalia/juzgado a cargo->

  <div class="form-group"
     {{ $errors->has('fiscalia_juzgado') ? 'has-error' : ''}}>
     <label for="datos_ente_judicial">E 11. Fiscalía/Juzgado a cargo:</label>
     <input type="text" class="form-control" name="fiscalia_juzgado" id="datos_ente_judicial" value="{{old('fiscalia_juzgado')}}">
 {!! $errors->first('fiscalia_juzgado', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

<!-E12I Causa o Id Judicial->

  <div class="form-group "{{ $errors->has('causa_id_judicial') ? 'has-error' : ''}}>
         <label for="causa_id_judicial">E 12 I. N° Causa o Id Judicial:</label>
         <input type="text" class="form-control" name="causa_id_judicial" id="causa_id_judicial"value="{{$causa_id_judicial}}">
  


<label for="bloqueo12I" class="form-check-label">Se desconoce</label>
  <input type="checkbox" id="bloqueo12I" name="causa_id_judicial" value="Se desconoce" onchange="checkE12I(this)">
    {!! $errors->first('causa_id_judicial', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
      <script>
                     function checkE12I(checkbox)
                     {
                         if (checkbox.checked)
                             {
                                 $('#causa_id_judicial').val('Se desconoce');
                                 document.getElementById('causa_id_judicial').setAttribute("readonly", "readonly");
                             }else
                                 {
                                     $('#causa_id_judicial').val('');
                                     document.getElementById('causa_id_judicial').removeAttribute("readonly");
                                 }
                     }
                  </script>

<!-E12 II Causa o Id Judicial->

  <div class="form-group "{{ $errors->has('otra_causa_id_judicial') ? 'has-error' : ''}}>
         <label for="otra_causa_id_judicial">E 12 II. N° Causa o Id Judicial:</label>
         <input type="text" class="form-control" name="otra_causa_id_judicial" id="otra_causa_id_judicial" value="{{$otra_causa_id_judicial}}">
 <label for="bloqueo12II" class="form-check-label">Se desconoce</label>

  <input type="checkbox" id="bloqueo12II" name="otra_causa_id_judicial" value="Se desconoce" onchange="checkE12II(this)">
    {!! $errors->first('otra_causa_id_judicial', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
      <script>
                     function checkE12II(checkbox)
                     {
                         if (checkbox.checked)
                             {
                                 $('#otra_causa_id_judicial').val('Se desconoce');
                                 document.getElementById('otra_causa_id_judicial').setAttribute("readonly", "readonly");
                             }else
                                 {
                                     $('#otra_causa_id_judicial').val('');
                                     document.getElementById('otra_causa_id_judicial').removeAttribute("readonly");
                                 }
                     }
                  </script>

<!-E12 III Causa o Id Judicial->

  <div class="form-group "{{ $errors->has('otra_otra_causa_id_judicial') ? 'has-error' : ''}}>
         <label for="otra_otra_causa_id_judicial">E 12 III. N° Causa o Id Judicial:</label>
         <input type="text" class="form-control" name="otra_otra_causa_id_judicial" id="otra_otra_causa_id_judicial" value="{{$otra_otra_causa_id_judicial}}">
         <label for="bloqueo12I" class="form-check-label">Se desconoce</label>
     <input type="checkbox" id="bloqueo12III" name="otra_otra_causa_id_judicial" value="Se desconoce" onchange="checkE12III(this)">
    {!! $errors->first('otra_otra_causa_id_judicial', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
      <script>
                     function checkE12III(checkbox)
                     {
                         if (checkbox.checked)
                             {
                                 $('#otra_otra_causa_id_judicial').val('Se desconoce');
                                 document.getElementById('otra_otra_causa_id_judicial').setAttribute("readonly", "readonly");
                             }else
                                 {
                                     $('#otra_otra_causa_id_judicial').val('');
                                     document.getElementById('otra_otra_causa_id_judicial').removeAttribute("readonly");
                                 }
                     }
                  </script>

</div>
</div>

<!BOTONES>


  <div class="btn-1"> <button style="width:100%" type="submit" class="btn btn-primary col-xL" name="button">Agregar/Enviar</button><br><br></div>

  </form>
  </section>

<script>
         function selectOnChangeA14I(sel) {

           if (sel.value=="1"){
             divC = document.getElementById("agregar_imputado_si");
             divC.style.display = "";}
             else{
                divC = document.getElementById("agregar_imputado_si");

                divC.style.display = "none";}
          }

</script>
      <script>
         var nueva_entrada = $('.padre').html();

         $("#anadir").click(function(){
             $(".padre").append(nueva_entrada);
         });

         $("#borra").click(function(){
         $('.hijo').last().remove();
         swal('Se borro un imputado');
         });
      </script>
      <script>
         var msg = '';
         var exist = '';
         if(exist){
           swal(msg);
         }
          </script>

      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   </body>
</html>
