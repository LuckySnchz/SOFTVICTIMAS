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

      <label class="font-weight-bold">Caso: </label>
    {{$casoActual->nombre_referencia}}<br>


    <label class="font-weight-bold">Victima: </label>
  {{$victimActual->victima_nombre_y_apellido}}</h5></div>

  <div class="" style="margin-left: 43.5%">
  <label class="font-weight-bold">Imputados para esta víctima: </label>
  <ul style="list-style:none">
  @foreach($imputados_nuevos as $imputado_nuevo)
@if($imputado_nuevo->idVictim==session("idVictim"))

 <li style="margin-left: -10%">
          @foreach($imputados as $imputado)
          @if($imputado->id==$imputado_nuevo->idImputado)
                  {{$imputado->nombre_y_apellido}}
                  @endif
                  @endforeach
                  

          </li>
                @endif

            @endforeach
</ul>

    </div>


      <!Listado de Imputados>

<!-- @if($cantVictimas>1)
 
 <div class="flex-container" style="display: flex;
  flex-direction: column;
 ">
  <label style="margin-left: 43.5%" class="font-weight-bold">Imputados de este Caso: </label>
<ul style="list-style:none">
      @foreach($imputados as $imputado)
        @if ($imputado->idCaso == session("idCaso"))
        <div style="text-align: center">
          <li>
            {{$imputado->nombre_y_apellido}}<br>
 
    <a type="button" href="/detalleimputadovinculo/{{$imputado->id}}" target="_self" style="width:250px;
  color:black;border: solid black 1px;background-color:#ffffcc;" class="btn btn-danger">Agregar Imputado</button> </a><br><br>

         <br>

          </li>
        </div>
        @endif
      @endforeach
  </ul>

@else
<div id="listado" style="display: none">
  @endif
</div>
</div>-->
<section class="container jumbotron shadow p-3 mb-5 bg-white rounded" >

  <form class="ejeC" action="/detalleagregarimputado" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="idCaso" value="{{session("idCaso")}}">
  <input type="hidden" name="idVictim" value="{{session("idVictim")}}">
  <input type="hidden" name="cantVictimas" value="{{$cantVictimas}}">


@if($cantVictimas>1)
 <div id="agregar"class="form-group"  {{ $errors->has('agregar_imputado') ? 'has-error' : ''}}>
      <label for="agregar_imputado">Desea agregar un imputado nuevo? </label>
      <select class="form-control" name="agregar_imputado" id="agregar_imputado" onChange="selectOnChangeA14I(this)">
            <option value="" selected=disabled>Seleccionar...</option>
              @if(old("agregar_imputado")==1)
              <option value="1" selected >Sí</option>
              @else <option value="1">Sí</option>@endif

              @if(old("agregar_imputado")==2)
              <option value="2" selected >No</option>
              @else  <option value="2" >No</option>@endif
              </select>
              {!! $errors->first('agregar_imputado', '<p class="help-block" style="color:red";>:message</p>') !!}

      @else
 <div id="agregar"class="form-group" style="display: none">
  @endif
</div></div>

      @if(old("agregar_imputado") == 1||$cantVictimas==1)
        <div id="agregar_imputado_si" {{ $errors->has('agregar_imputado_si') ? 'has-error' : ''}}>
        @else
          <div id="agregar_imputado_si" style="display: none;">
      @endif





<!E1 Nombre y apellido Imputado>

  <h3>Datos del Imputado:</h3>
  <div class="form-group" {{ $errors->has('imputado_nombre_y_apellido') ? 'has-error' : ''}}>
  <label for="">E 1. Nombre y apellido:</label>
  <input type="text" class="form-control" name="imputado_nombre_y_apellido" id="imputado_nombre_y_apellido" value="{{old("imputado_nombre_y_apellido")}}"><br>
  <label for="bloqueo1" class="form-check-label">Se desconoce</label>
  <input type="checkbox" id="bloqueo1" name="imputado_nombre_y_apellido" value="Se desconoce" onchange="checkE1(this)">
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
  <input type="text" class="form-control" name="apodo" id="apodo" value="{{old("apodo")}}">
  <label for="bloqueo6" class="form-check-label">Se desconoce</label>
  <input type="checkbox" id="bloqueo6" name="apodo" value="Se desconoce" onchange="checkEApodo(this)">
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
  <select class="form-control" id="tipodocumento_id" name="tipo_documento_id" onChange="selectOnChangeE2(this)">
      <option value="" selected=disabled>Seleccionar...</option>
      @if(old("tipo_documento_id") ==1)<option value="1" selected>D.N.I.</option> @else<option value="1" >D.N.I.</option>@endif

      @if(old("tipo_documento_id") ==2)<option value="2" selected>Documento Extranjero</option>
      @else<option value="2">Documento Extranjero</option>@endif

      @if(old("tipo_documento_id") ==3)<option value="3" selected>Libreta Cívica</option>
      @else<option value="3">Libreta Cívica</option>@endif

      @if(old("tipo_documento_id") ==4)<option value="4" selected>Libreta de Enrolamiento</option>
      @else<option value="4" >Libreta de Enrolamiento</option>@endif

      @if(old("tipo_documento_id") ==5)<option value="5" selected>Pasaporte</option>
      @else<option value="5">Pasaporte</option>@endif

      @if(old("tipo_documento_id") ==6)<option value="6" selected>Residencia Precaria</option>
      @else<option value="6">Residencia Precaria</option> @endif

      @if(old("tipo_documento_id") ==7)<option value="7" selected>Se Desconoce</option>
      @else<option value="7">Se Desconoce</option> @endif

      @if(old("tipo_documento_id") ==8)<option value="8" selected>No posee</option>
      @else<option value="8">No posee</option>@endif

      @if(old("tipo_documento_id") ==9)<option value="9" selected>Otro</option>
      @else<option value="9">Otro</option>@endif
  </select>
  {!! $errors->first('tipo_documento_id', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  @if(old("tipo_documento_id") == 9)
    <div id="cualE2" {{ $errors->has('tipo_documento_otro') ? 'has-error' : ''}}>
  @else
    <div id="cualE2" style="display: none">
  @endif

  <label for="">Cual?</label>

  <input name="tipo_documento_otro"  id="imputado_tipo_documento_otro" class="form-control" type="text" value="{{old("tipo_documento_otro")}}">
  {!! $errors->first('tipo_documento_otro', '<p class="help-block" style="color:red";>:message</p>') !!}

  </div>

                  <script>
                     function selectOnChangeE2(sel) {
                      if (sel.value=="9"){
                        divC = document.getElementById("cualE2");
                        divC.style.display = "block";
                      }if (sel.value=="1" || sel.value=="2"|| sel.value=="3"|| sel.value=="4"|| sel.value=="5"|| sel.value=="6"|| sel.value=="7"|| sel.value=="8"){
                        divC = document.getElementById("cualE2");

                        $('#tipo_documento_otro').val('');
                        divC.style.display="none";
                      }
                  


                      if (sel.value=="7" || sel.value=="8"){
                        divC = document.getElementById("nrodoc");
                        divC.style.display = "none";
                        $('#documento_nro').val('');
                      }if (sel.value=="1" || sel.value=="2"|| sel.value=="3"|| sel.value=="4"|| sel.value=="5"|| sel.value=="6"|| sel.value=="9"){
                        divC = document.getElementById("nrodoc");
                        divC.style.display = "block";
                        
                        document.getElementById("bloqueo4").checked=false;
                      }
                     }

                  </script>


<!E4 Nro documento>
 @if(old("tipo_documento_id") ==1||old("tipo_documento_id") ==2||old("tipo_documento_id") ==3||old("tipo_documento_id") ==4||old("tipo_documento_id") ==5||old("tipo_documento_id") ==6||old("tipo_documento_id") ==9)
  <div class="form-group" id="nrodoc" {{ $errors->has('documento_nro') ? 'has-error' : ''}}>
    @else
     <div class="form-group" id="nrodoc" style="display: none"> 
      @endif
  <label for="">E 4. Nro Documento:</label>
  <input type="text" class="form-control" name="documento_nro" placeholder="" id="imputado_documento" value="{{old("documento_nro")}}">
  <label for="bloqueo3" class=" form-check-inline form-check-label"> </label>Se desconoce</label>
  <input type="checkbox" id="bloqueo4" class="form-check-inline" name="documento_nro" value="0" onchange="checkE3(this)">

  {!! $errors->first('documento_nro', '<p class="help-block" style="color:red";>:message</p>') !!}
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
  <label for="">E 5. Vinculación con la víctima:</label>
  <select  class="form-control vinculo" onChange="selectOnChangeE4(this)" name="vinculo_victima">
      <option value="" selected=disabled>Seleccionar...</option>
      @if(old("vinculo_victima") == 1) <option value="1" selected>Familiar</option>
      @else <option value="1" >Familiar</option>@endif

      @if(old("vinculo_victima") == 2) <option value="2" selected>Pareja</option>
      @else<option value="2" >Pareja</option>@endif

      @if(old("vinculo_victima") == 3) <option value="3" selected>Amistad</option>
      @else<option value="3" >Amistad</option>@endif

      @if(old("vinculo_victima") == 4) <option value="4" selected>Conocido</option>
      @else<option value="4" >Conocido</option>@endif

      @if(old("vinculo_victima") == 5) <option value="5" selected>Sin vínculo</option>
      @else<option value="4" >Sin Vínculo</option>@endif

      @if(old("vinculo_victima") == 6) <option value="6" selected>Otro</option>
      @else<option value="6" >Otro</option>@endif

      @if(old("vinculo_victima") == 7) <option value="7" selected>Se desconoce</option>
      @else<option value="7" >Se desconoce</option>@endif
  </select>
  {!! $errors->first('vinculo_victima', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  @if(old("vinculo_victima") == 6)
    <div id="cualE4" {{ $errors->has('vinculo_otro') ? 'has-error' : ''}}>
  @else
    <div id="cualE4" style="display: none">
  @endif

  <label for="vinculo_otro">Cuál?</label>
  <input type="text" class="form-control vinculo_otro" name="vinculo_otro" id="vinculo_otro" value="{{old("vinculo_otro")}}">
  {!! $errors->first('vinculo_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
  <br>

    <script>
                     function selectOnChangeE4(sel) {
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
  <input type="text" class="form-control" name="caratulacion_judicial" id="caratulacion_judicial" value="{{old("caratulacion_judicial")}}">
  {!! $errors->first('caratulacion_judicial', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

<!E7 Existencia de antecedentes penales>

  <div class="form-group" {{ $errors->has('antecedentes_id') ? 'has-error' : ''}}>
  <label for="antecedentes_id">E 7. Existencia de antecedentes penales:</label>
  <select  onChange="selectOnChangeE7(this)" class="form-control vinculo" name="antecedentes_id">
        <option value="" selected=disabled>Seleccionar...</option>
        @if(old("antecedentes_id") == 1) <option value="1" selected>Sí</option>
        @else <option value="1" >Sí</option>@endif

        @if(old("antecedentes_id") == 2) <option value="2" selected>No</option>
        @else <option value="2" >No</option>@endif

        @if(old("antecedentes_id") == 3) <option value="3" selected>Se desconoce</option>
        @else <option value="3" >Se desconoce</option>@endif
  </select>
  {!! $errors->first('antecedentes_id', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  @if(old("antecedentes_id") == 1)
    <div class="form-group" id="antecedentesD" {{ $errors->has('antecedentes') ? 'has-error' : ''}}>
  @else
    <div class="form-group" id="antecedentesD" style="display: none">
  @endif


  <label for="">E 7. I. Descripción de los antecedentes: </label>
  <input type="text" class="form-control" name="antecedentes" id="antecedentes" value="{{old("antecedentes")}}">
  <label for="bloqueo6" class="form-check-label">Se desconoce</label>
  <input type="checkbox" id="bloqueo7" name="antecedentes" value="Se desconoce" onchange="checkEAn(this)">
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
<select  onChange="selectOnChangeE8(this)" class="form-control vinculo" name="detenido">
      <option value="" selected=disabled>Seleccionar...</option>
      @if(old("detenido") == 1) <option value="1" selected>Sí</option>
      @else <option value="1" >Sí</option>@endif

      @if(old("detenido") == 2) <option value="2" selected>No</option>
      @else <option value="2" >No</option>@endif

      @if(old("detenido") == 3) <option value="3" selected>Se desconoce</option>
      @else <option value="3" >Se desconoce</option>@endif
</select>
{!! $errors->first('detenido', '<p class="help-block" style="color:red";>:message</p>') !!}
</div>

@if(old("detenido") == 1)
  <div class="form-group" id="detenido" {{ $errors->has('lugar_de_alojamiento') ? 'has-error' : ''}}>
@else
  <div class="form-group" id="detenido" style="display: none">
@endif


<label for="">E 8. I. Lugar de alojamiento: </label>
<input type="text" class="form-control" name="lugar_de_alojamiento" id="lugar_de_alojamiento" value="{{old("lugar_de_alojamiento")}}">
<label for="bloqueo6" class="form-check-label">Se desconoce</label>
<input type="checkbox" id="bloqueo8" name="lugar_de_alojamiento" value="Se desconoce" onchange="checkELu(this)">
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
  <select  class="form-control vinculo" name="defensor_particular">
        <option value="" selected=disabled>Seleccionar...</option>
        @if(old("defensor_particular") == 1) <option value="1" selected>Sí</option>
        @else <option value="1" >Sí</option>@endif

        @if(old("defensor_particular") == 2) <option value="2" selected>No</option>
        @else <option value="2" >No</option>@endif

        @if(old("defensor_particular") == 3) <option value="3" selected>Se desconoce</option>
        @else <option value="3" >Se desconoce</option>@endif
  </select>
  {!! $errors->first('defensor_particular', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>


<!E10 Defensoría>

  <div class="form-group" {{ $errors->has('defensoria_numero') ? 'has-error' : ''}}>
  <label for="">E 10. Defensoría N°: </label>
  <input type="text" class="form-control" name="defensoria_numero" id="defensoria_numero" value="{{old("defensoria_numero")}}">
  <label for="bloqueo6" class="form-check-label">Se desconoce</label>
  <input type="checkbox" id="bloqueo6" name="defensoria_numero" value="Se desconoce" onchange="checkE6(this)">
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

<!-E12 Causa o Id Judicial->

  <div class="form-group "{{ $errors->has('causa_id_judicial') ? 'has-error' : ''}}>
         <label for="causa_id_judicial">E 12. N° Causa o Id Judicial:</label>
         <input type="text" class="form-control" name="causa_id_judicial" value="{{old('causa_id_judicial')}}">
    {!! $errors->first('causa_id_judicial', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
</div>
</div>

<!BOTONES>


  <div class="btn-1"> <button style="width:100%" type="submit" class="btn btn-primary col-xL" name="button">Agregar/Enviar</button><br><br></div>

  </form>
  </section>
 <!-- <div  class="btn-4">   <button  style="width:100%" class="btn btn-primary col-xL" name="button" onclick="window.open('agregarVictima', 'width=800,height=600')";>AGREGAR NUEVA VICTIMA</button><br><br></div>
  <div class="btn-4">   <button  style="width:100%;color:white;background-color:rgb(137, 210, 14)" class="btn col-xL" name="button" onclick="window.open('agregarOrganismo', 'width=800,height=600')";>SIGUIENTE</button><br><br></div>-->

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
