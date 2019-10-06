
<?php

session_start();

 ?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https:fonts.googleapis.com/css?family=Muli" rel="stylesheet">
      <link rel="stylesheet" href="https:stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" href="css/app.css">
      <script src="https:ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <title>Eje A: Datos institucionales</title>
      <style>
         .Auno,.Ados{float: left;
         width: 40%
         }
         .AunoDos{overflow: hidden;margin-left: 1%}
      </style>
   </head>
    <header>
      <section class="container jumbotron shadow p-3 mb-5 bg-white rounded"style="height: 150px" >
     @include('navbar')

                <a type="button"  href="/home" target="_self" style="width:100%; color:white;background-color:rgb(52, 144, 220);margin-bottom: -5%;margin-top: -12%" class="btn col-XL" class="btn btn-danger">IR A INICIO</button> </a><br><br>
      </section>        
      
   </header>
   <body>
      <h1 class="text-center" style="padding: 15px;">Eje A: Datos institucionales</h1>

      <section class="container jumbotron shadow p-3 mb-5 bg-white rounded">


       
         <form class="" action="/detalleCaso" method="post">
                {{csrf_field()}}
  <input type="hidden" name="idCaso" value="{{session("idCaso")}}">
          <input type="hidden" name="userID_modify" value="{{$caso->userID_modify}}">


<!-A1 Nombre de referencia->

        <div class="form-group {{ $errors->has('nombre_referencia') ? 'has-error' : ''}}">
        <label for="datos_nombre_referencia">A 1. Nombre de referencia:</label>
        <input type="text" class="form-control" name="nombre_referencia" id="datos_nombre_referencia" value="{{$caso->nombre_referencia}}">
           {!! $errors->first('nombre_referencia', '<p class="help-block" style="color:red";>:message</p>') !!}
        </div>

<!-A1 I Número de carpeta->

        <div class="form-group {{ $errors->has('nro_carpeta') ? 'has-error' : ''}}">
        <label>A 1 I. Número de carpeta (opcional): </label>
        <input type="text" class="form-control" name="nro_carpeta" value="{{$caso->nro_carpeta}}">
        {!! $errors->first('nro_carpeta', '<p class="help-block" style="color:red";>:message</p>') !!}
        </div>

<!-A2 Tipo de delito->

           <div class="form-group " id="tipodoc" {{ $errors->has('delito') ? 'has-error' : ''}}>
    <label for="">A 2. Tipo de delito:</label>
<select class="form-control" name="delito" onChange="selectOnChangeA2(this)">
              <option value="" selected=disabled>Seleccionar...</option>
              @foreach ($delitos as $delito)
                @if($caso->delito==$delito->id)
                <option selected value="{{ $delito->id }}">{{ $delito->nombre}}</option>
              @else <option  value="{{ $delito->id }}">{{ $delito->nombre}}</option>
              @endif
            @endforeach
            </select>
    {!! $errors->first('delito', '<p class="help-block" style="color:red";>:message</p>') !!}


    @if ($caso->delito == 36||$errors->first('otro_delito')) 
    <div id="cualA2" {{ $errors->has('otro_delito') ? 'has-error' : ''}}>
    @else
    <div id="cualA2" style="display: none">
    @endif
    <label for="">Cuál?</label>
    <input name="otro_delito"  id="otro_delito" class="form-control" type="text" value="{{$caso->otro_delito}}">
    {!! $errors->first('otro_delito', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>
    </div>

</div>

        <script>
           function selectOnChangeA2(sel) {


            if (sel.value=="36"){
              divC = document.getElementById("cualA2");
              divC.style.display = "";
            }else{
              divC = document.getElementById("cualA2");
              $('#otro_delito').val('');
              divC.style.display="none";
            }
           }

        </script>

<!-A3 Descripción del caso->

        <div class="form-group {{ $errors->has('descripcion_caso') ? 'has-error' : ''}}">
        <label for="breve_descripcion_caso">A 3. Breve descripción del caso:</label>

    <textarea class="form-control"id="descripcion_caso" name="descripcion_caso">{{$caso->descripcion_caso}}</textarea>

        {!! $errors->first('descripcion_caso', '<p class="help-block" style="color:red";>:message</p>') !!}
        </div>
  
<!-A4 Fecha de ingreso->

        <div class="form-group"
        {{ $errors->has('fecha_ingreso') ? 'has-error' : ''}}>
        <label for="datos_fecha_ingreso">A 4. Fecha de Ingreso:</label>
        <input type="date" class="form-control" name="fecha_ingreso" id="datos_fecha_ingreso" value="{{$caso->fecha_ingreso}}">
        {!! $errors->first('fecha_ingreso', '<p class="help-block" style="color:red";>:message</p>') !!}
        </div>

<!-A5 Modalidad de ingreso->


   <!-A5 Modalidad de ingreso->

        <div class="form-group"
        {{ $errors->has('modalidad_ingreso') ? 'has-error' : ''}}>
        <label for="modalidad_ingreso">A 5. Modalidad de Ingreso</label>
        <select class="form-control" name="modalidad_ingreso" id="modalidad_id" onChange="selectOnChangeA5A(this)">
                  <option value="" selected=disabled>Seleccionar...</option>
                  @if ($caso->modalidad_ingreso==1)
                    <option value="1" selected>Presentación espontánea</option>
                  @else <option value="1" >Presentación espontánea</option>
                  @endif

                  @if ($caso->modalidad_ingreso==2)
                    <option value="2" selected>Intervención de oficio</option>
                  @else <option value="2" >Intervención de oficio</option>
                  @endif

                  @if ($caso->modalidad_ingreso==3)
                    <option value="3" selected>Derivación de otro organismo</option>
                  @else <option value="3" >Derivación de otro organismo</option>
                  @endif
        </select><br>
        {!! $errors->first('modalidad_ingreso', '<p class="help-block" style="color:red";>:message</p>') !!}

        @if($caso->modalidad_ingreso== 3||$errors->first('organismo'))

         <div id="derivacion_otro_organismo_id" {{ $errors->has('organismo') ? 'has-error' : ''}}>


        @else<div class="form-group" id="derivacion_otro_organismo_id" style="display:none">
        @endif


  <label>A 5.I Qué organismo derivó?</label>
<select class="form-control" name="organismo" id="organismo" onChange="selectOnChangeA5(this)">

               <option value="" selected=disabled>Seleccionar...</option>
              @foreach ($organismos as $organismo)
                @if($caso->organismo==$organismo->id)
                <option selected value="{{ $organismo->id }}">{{ $organismo->nombre}}</option>
              @else <option  value="{{ $organismo->id }}">{{ $organismo->nombre}}</option>
              @endif
            @endforeach
            </select>

 {!! $errors->first('organismo', '<p class="help-block" style="color:red";>:message</p>') !!}


    @if ($caso->organismo== 24||$errors->first('cual_otro_organismo'))
     <div id="cualA5" {{ $errors->has('cual_otro_organismo') ? 'has-error' : ''}}>
    @else
    <div id="cualA5" style="display: none">
    @endif
    <label for="">Cuál?</label>
    <input name="cual_otro_organismo"  id="cual_otro_organismo" class="form-control" type="text" 
    value="{{$cual_otro_organismo}}">
    {!! $errors->first('cual_otro_organismo', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>
    </div>



</div>
      <script>
         function selectOnChangeA5A(sel) {
          if (sel.value=="3"){
              divC = document.getElementById("derivacion_otro_organismo_id");
              divC.style.display = "";}


              if (sel.value=="1"||sel.value=="2"||sel.value=="0"){
                divC = document.getElementById("derivacion_otro_organismo_id");
                divC.style.display = "none";

                document.querySelector('#cualA5').style.display = 'none';
                $('#cual_otro_organismo').val('');
                 $('#organismo').val('0');
          }
         }
      </script>

        <script>
           function selectOnChangeA5(sel) {


            if (sel.value=="24"){
              divC = document.getElementById("cualA5");
              divC.style.display = "";
            }else{
              divC = document.getElementById("cualA5");
              $('#cual_otro_organismo').val('');
              divC.style.display="none";
            }
           }

        </script>



<!-A6 CAVAJ Interviniente->
    <div class="form-group" {{ $errors->has('cavaj') ? 'has-error' : ''}}>
    <label for="">A 6. CAVAJ interviniente:</label><br>
    <select class="form-control" name="cavaj">
        <option value="" selected=disabled>Seleccionar...</option>
        @foreach ($cavajs as $cavaj)
            @if($caso->cavaj==$cavaj->id)
            <option selected value="{{ $cavaj->id }}">{{ $cavaj->nombre}}</option>
            @else <option  value="{{ $cavaj->id }}">{{ $cavaj->nombre}}</option>
            @endif
        @endforeach
    </select>
    {!! $errors->first('cavaj', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>

<!-A7 Comisaría interviniente->

            <div class="form-group " for="comisaria"{{ $errors->has('comisaria') ? 'has-error' : ''}}>
               <label >A 7. Comisaría interviniente:</label>
               <input type="text" class="form-control" name="comisaria" value="{{$caso->comisaria}}">
            {!! $errors->first('comisaria', '<p class="help-block" style="color:red";>:message</p>') !!}
            </div>

<!-A8 Denuncias previas->

          <div class="form-group "for=""{{ $errors->has('denuncias_previas') ? 'has-error' : ''}}>
               <label for="denuncias_previas">A 8.¿Hubo denuncias previas vinculadas a la temática del tipo de delito actual?:</label>
               <select class="form-control" name="denuncias_previas">
                  <option value="" selected=disabled>Seleccionar...</option>
                  @if($caso->denuncias_previas == 1) <option value="1" selected>Sí</option>
                  @else<option value="1" >Sí</option>@endif

                  @if($caso->denuncias_previas== 2) <option value="2" selected>No</option>
                  @else<option value="2" >No</option>@endif

                  @if($caso->denuncias_previas == 3) <option value="3" selected>Se desconoce</option>
                  @else<option value="3" >Se desconoce</option>@endif
               </select>
               {!! $errors->first('denuncias_previas', '<p class="help-block" style="color:red";>:message</p>') !!}
            </div>

<!-A9 Departamento judicial->


        <div class="form-group "{{ $errors->has('departamento_judicial') ? 'has-error' : ''}}>
            <label for="departamento_judicial">A 9.Departamento judicial:</label>

            <select class="form-control" name="departamento_judicial">
            <option value="" selected=disabled>Seleccionar...</option>
          @foreach ($departamentos as $departamento)
            @if($caso->departamento_judicial==$departamento->id)
            <option selected value="{{ $departamento->id }}">{{ $departamento->nombre}}</option>
          @else <option  value="{{ $departamento->id }}">{{ $departamento->nombre}}</option>
          @endif
        @endforeach
        </select>
            {!! $errors->first('departamento_judicial', '<p class="help-block" style="color:red";>:message</p>') !!}
          </div>

<!-A10 Estado->

  <div class="form-group "{{ $errors->has('estado') ? 'has-error' : ''}}>
  <label for="">A 10. Estado:</label>
  <select class="form-control" name="estado" onChange="selectOnChangeA12(this)">
          <option value="" selected=disabled>Seleccionar...</option>
          @if($caso->estado == 1)<option value="1" selected>Activo</option>
          @else<option value="1" >Activo</option>@endif
          @if($caso->estado == 2)<option value="2" selected>Pasivo</option>
          @else<option value="2" >Pasivo</option>@endif
  </select>
  {!! $errors->first('estado', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

@if($caso->estado == 2||$errors->first('motivospasivos')||$errors->first('cual_otro_motivospasivos'))
  <div id="pase_pasivo" {{ $errors->has('motivospasivos') ? 'has-error' : ''}}>
  @else
    <div id="pase_pasivo" style="display:none">
    @endif

               <label for="">A10 I. Motivo de pase a pasivo:</label>
               <select class="form-control" onChange="selectOnChangeA12bis(this)" name="motivospasivos" id="motivo_pase_pasivo">
                 <option value="" selected=disabled>Seleccionar...</option>
                  @if($caso->motivospasivos== 1) <option value="1" selected>No hay demanda</option>
                  @else<option value="1" >No hay demanda</option>@endif

                  @if($caso->motivospasivos == 2) <option value="2" selected>Deja de requerir intervención</option> @else<option value="2" >Deja de requerir intervención</option>@endif

                  @if($caso->motivospasivos== 3) <option value="3" selected>Imposibilidad de contacto</option>
                  @else<option value="3" >Imposibilidad de contacto</option>@endif

                    @if($caso->motivospasivos == 4) <option value="4" selected>Sentencia judicial</option>
                    @else<option value="4" >Sentencia judicial</option>@endif

                  @if($caso->motivospasivos == 5) <option class="otropasivo" value="5" selected>Otro</option>
                  @else<option class="otropasivo" value="5" >Otro</option>@endif
               </select>
        {!! $errors->first('motivospasivos', '<p class="help-block" style="color:red";>:message</p>') !!}
            </div><br>

    @if($caso->motivospasivos == 5||$errors->first('cual_otro_motivospasivos'))
      <div id="cualA12" {{ $errors->has('cual_otro_motivospasivos') ? 'has-error' : ''}}>
      @else
        <div id="cualA12" style="display: none">
        @endif

     <label for="">Cuál?</label>
     <div class="">
        <input class="form-control" name="cual_otro_motivospasivos" type="text" id="motivo_pase_pasivo_cual" value="{{$caso->cual_otro_motivospasivo}}">
     </div>
     {!! $errors->first('cual_otro_motivospasivos', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

      <script>
         function selectOnChangeA12(sel) {

                                 if (sel.value=="2"){
                divC = document.getElementById("pase_pasivo");
                divC.style.display = "";

              }
              else{
               divC = document.getElementById("pase_pasivo");
               $('#motivo_pase_pasivo').val(' ');
               divC.style.display = "none";
               divC = document.getElementById("cualA12");
               $('#motivo_pase_pasivo_cual').val('');
             divC.style.display = "none";}}
             </script>
      <script>
         function selectOnChangeA12bis(sel) {
           if (sel.value=="5"){
             divC = document.getElementById("cualA12");
             divC.style.display = "";}
             else{
                divC = document.getElementById("cualA12");
                $('#motivo_pase_pasivo_cual').val('');

                divC.style.display = "none";}
                  }
                  </script>
      <script type="text/javascript">
              var option4 = document.querySelector(".otropasivo")

              option4.onclick = function(){
                  $("#cualA12").toggle()

               }
            </script>

<!-A11 Nombre y apellido de la victima->

  <div class="form-group "{{ $errors->has('nombre_y_apellido_de_la_victima') ? 'has-error' : ''}}>
  <label for="">A 11. Nombre y apellido de la víctima:</label>
  <input type="text" class="form-control" name="nombre_y_apellido_de_la_victima" id="victima_nombre_y_apellido" value="{{$caso->nombre_y_apellido_de_la_victima}}">
  {!! $errors->first('nombre_y_apellido_de_la_victima', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
  <br>

  <!-D1 Tipo de fecha->

      <div class="form-group" {{ $errors->has('fecha_delito') ? 'has-error' : ''}}>
      <label>A 12. Tipo de fecha del hecho:</label>
       <select class="form-control" id="fecha_delito" name="fecha_delito" onChange="selectOnChangeD1(this)">

            <option value="" selected=disabled>Seleccionar...</option>
            @if($caso->fecha_delito == 1) <option value="1" selected>Fecha específica</option>
            @else <option value="1" >Fecha específica</option>@endif

            @if($caso->fecha_delito == 2) <option value="2" selected>Otro</option>
            @else <option value="2" >Otro</option>@endif

            @if($caso->fecha_delito == 3) <option value="3" selected>Se desconoce</option>
            @else <option value="3" >Se desconoce</option>@endif
      </select>
      {!! $errors->first('fecha_delito', '<p class="help-block" style="color:red";>:message</p>') !!}
      </div>




  <!-D2 Fecha del hecho->
   @if($caso->fecha_delito== 1||$errors->first('fecha_hecho'))
    <div class="form-group" id="fecha_si"{{ $errors->has('fecha_hecho_si') ? 'has-error' : ''}}>
    @else
      <div class="form-group" id="fecha_si" style="display:none">
    @endif

 
       <label for="">A 12 I. Fecha del hecho: </label>
      <input type="date" class="form-control" id="fecha_hecho" name="fecha_hecho" value="{{$caso->fecha_hecho}}">
      <label for="bloqueo3" class="form-check-label">Se desconoce</label>
      <input type="checkbox" id="bloqueo3" name="fecha_hecho_desconoce" value="Se desconoce" onchange="checkB3(this)">
      {!! $errors->first('fecha_hecho', '<p class="help-block" style="color:red";>:message</p>') !!}
      </div>
    </div>

        <script>
           function checkB3(checkbox)
           {
               if (checkbox.checked)
               {
                   $('#fecha_hecho').val('1900-01-01');
                   document.getElementById('fecha_hecho').setAttribute("readonly", "readonly");
               }else
                   {
                       $('#fecha_hecho').val('');
                       document.getElementById('fecha_hecho').removeAttribute("readonly");
                   }
           }
        </script>
    <script>
            function selectOnChangeD1(sel) {
                     if (sel.value=="1"){
                         divCD1 = document.getElementById("fecha_si");
                         divCD1.style.display = "";
                           $('#fecha_hecho_otro').val('');
                           divCD2 = document.getElementById("fecha_delito_otro");

                         divCD2.style.display="none";
                     }
                 if (sel.value=="2"){
                         divCD2 = document.getElementById("fecha_delito_otro");
                         divCD2.style.display = "";
                          $('#fecha_hecho').val('');
                         divCD1 = document.getElementById("fecha_si");
                         divCD1.style.display="none";
                      
                       
                     }



                   }
          </script>


    @if($caso->fecha_delito == 2||$errors->first('fecha_hecho_otro'))
    <div class="form-group" id="fecha_delito_otro" {{ $errors->has('fecha_hecho_otro') ? 'has-error' : ''}}>
    @else
      <div class="form-group" id="fecha_delito_otro"  style="display:none">
    @endif
      <label for="">A 12 I. Descripción de periodo de fechas del hecho: </label>
      <input type="text" style="height: 100px" class="form-control" id="fecha_hecho_otro" name="fecha_hecho_otro" value="{{$caso->fecha_hecho_otro}}"><br>
      {!! $errors->first('fecha_hecho_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
      </div>



 <!<A 13 País del hecho->


    <div class="form-group" {{ $errors->has('pais_hecho') ? 'has-error' : ''}}>
    <label for="countryId2">A 13. País del hecho:</label>
    <select name="pais_hecho" class="countries2 order-alpha form-control" id="countryId2">
      <option value="" selected=disabled>Seleccionar...</option>
      @if($caso->pais_hecho ==1)
      <option value="1" selected>Argentina</option>
      @else
      <option value="1" >Argentina</option>
      @endif
      @if($caso->pais_hecho==2)
      <option value="2" selected>Se Desconoce</option>
      @else
      <option value="2" >Se Desconoce</option>
      @endif
      @if($caso->pais_hecho ==3)
      <option value="3" selected>Otro</option>
      @else
      <option value="3" >Otro</option>
      @endif
     
    </select>
    <br>
    {!! $errors->first('pais_hecho', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>

   @if($caso->pais_hecho == 3||$errors->first('pais_hecho_otro'))
  <div class="form-group" id="otro_pais" {{ $errors->has('pais_hecho_otro') ? 'has-error' : ''}}>
    @else
    <div class="form-group" id="otro_pais" style="display: none">
@endif
  <label for="">A 13. Otro pais del hecho:</label>
  <input type="text" class="form-control" name="pais_hecho_otro" id="pais_hecho_otro" value="{{$caso->pais_hecho_otro}}">
  {!! $errors->first('pais_hecho_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
  <br>
     
    </select>
    <br>
    {!! $errors->first('pais_hecho_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>



<!-A14 Provincia del hecho->

   @if($caso->pais_hecho == 1||$errors->first('provincia_hecho'))
    <div class="form-group" id="provincia_hecho" {{ $errors->has('provincia_hecho') ? 'has-error' : ''}}>
  @else
  <div class="form-group" id="provincia_hecho" style="display: none">
    @endif
    <label for="stateId2">A 14. Provincia del hecho:</label>
    <select name="provincia_hecho" class="states2 order-alpha form-control" id="stateId2" onChange="selectOnChangePcia(this)">
    <option value="" selected=disabled>Seleccionar...</option>

   
    @foreach ($provincias as $provincia)
      @if ($caso->provincia_hecho ==$provincia->id)
      <option  selected value="{{$provincia->id}}">{{$provincia->nombre}}</option>
      @else
      <option value="{{$provincia->id}}">{{$provincia->nombre}}</option>
      @endif
    @endforeach
    </select>
 
      {!! $errors->first('provincia_hecho', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>




<!-A15 Localidad del hecho->



 @if(($caso->provincia_hecho) ==1 && ($caso->pais_hecho)==1||$errors->first('localidad_hecho'))

 <div class="form-group" id="localidad_hecho" {{ $errors->has('localidad_hecho') ? 'has-error' : ''}}>
  @else

<div class="form-group" id="localidad_hecho" style="display: none" >
@endif
    <label for="cityId2">D 15. Localidad del hecho:</label>
    <select name="localidad_hecho" class="cities2 order-alpha form-control" id="cityId2">
    <option value="" selected=disabled>Seleccionar...</option>
   
    @foreach ($ciudades as $ciudad)
      @if ($caso->localidad_hecho ==$ciudad->id)
      <option class="opcionProvincia provincia{{$ciudad->idPcia}}" style="display:none" value="{{$ciudad->id}}" selected>{{$ciudad->localidad_nombre}}</option>
      @else
      <option class="opcionProvincia provincia{{$ciudad->idPcia}}" style="display:none" value="{{$ciudad->id}}">{{$ciudad->localidad_nombre}}</option>
      @endif
    @endforeach
    </select>
  
    {!! $errors->first('localidad_hecho', '<p class="help-block" style="color:red";>:message</p>') !!}
   </div>

 <script type="text/javascript">
    document.querySelector("#countryId2").onchange = function() {
      var value = this.options[this.selectedIndex].value;
      if (value=="1"){
        
           divC = document.getElementById("provincia_hecho");
                divC.style.display = "";

                   $('#pais_hecho_otro').val('');
                   divCo= document.getElementById("otro_pais");
                      divCo.style.display="none";
                       

              }

 if (value=="2"){divCp = document.getElementById("provincia_hecho");
               $('#stateId2').val('');
                divCp.style.display = "none"; 
               
               divCl = document.getElementById("localidad_hecho");
               $('#cityId2').val('');
                divCl.style.display = "none";

          
                      $('#pais_hecho_otro').val('');
                   divCo= document.getElementById("otro_pais");
                      divCo.style.display="none";
                       
               }

               if (value=="3"){
        
           divC = document.getElementById("otro_pais");
                divC.style.display = "";

                divCp = document.getElementById("provincia_hecho");
               $('#stateId2').val('');
                divCp.style.display = "none"; 
               
               divCl = document.getElementById("localidad_hecho");
               $('#cityId2').val('');
                divCl.style.display = "none";

              }
            }
    </script>





<script type="text/javascript">
    document.querySelector("#stateId2").onchange = function() {
      var value = this.options[this.selectedIndex].value;

                  if ((value=="1")||(value=="2")||(value=="3")||(value=="4")||
                                  (value=="5")||(value=="6")||(value=="7")||(value=="8")||
                                  (value=="9")||(value=="10")||(value=="11")||(value=="12")||
                                  (value=="13")||(value=="14")||(value=="15")||(value=="16")||
                                  (value=="17")||(value=="18")||(value=="19")||(value=="20")||
                                  (value=="21")||(value=="22")||(value=="23")||(value=="24")){
                divC = document.getElementById("localidad_hecho");
              $('#localidad_hecho').val(' ');
     
  
                divC.style.display = "";

              

              }
if (value=="25"){

                divC = document.getElementById("localidad_hecho");
                divC.style.display = "none";
            
$('#cityId2').val(' ');
              }
      var opciones = document.querySelectorAll(".opcionProvincia");

      for (var i = 0; i < opciones.length; i++) {
        opciones[i].style.display = "none";
      }

      var opciones = document.querySelectorAll(".provincia" + value);

      for (var i = 0; i < opciones.length; i++) {
        opciones[i].style.display = "block";
      }
 

    }
  </script>
 
  <div class="btn-1"> <button type="submit" class="btn btn-primary col-xl" name="button"  >Agregar/Enviar</button><br><br></div>
 </form>
  </section>

<!-BOTONES->
 
 
  </body>
</html>
