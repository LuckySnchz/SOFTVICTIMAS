
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
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <title>Eje B: Caracterización de la victima y su contexto</title>
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

     <h1 class="text-center" style="padding: 15px;">Eje B: Caracterización de la victima y su contexto </h1>

     <section class="container jumbotron shadow p-3 mb-5 bg-white rounded">
 

@if ($errors->any())
          <div class="alert alert-danger">
  {!! $errors->first('tienedoc', '<p class="help-block" style="color:red";>:message</p>') !!}
 {!! $errors->first('tipodocumento', '<p class="help-block" style="color:red";>:message</p>') !!}
  {!! $errors->first('tipo_documento_otro', '<p class="help-block" style="color:red";>:message</p>') !!}

{!! $errors->first('residenciaprecaria', '<p class="help-block" style="color:red";>:message</p>') !!}

{!! $errors->first('victima_numero_documento', '<p class="help-block" style="color:red";>:message</p>') !!}    
          </div>
        @endif
       

 <form class="" action="/detalleVictima" method="post">
      {{ csrf_field() }}
   
      <input type="hidden" name="idCaso" value="{{session("idCaso")}}">
    <input type="hidden" name="idVictima" value="{{session("idVictima")}}"> 
<input type="hidden" name="userID_modify" value="{{$victim->userID_modify}}">
<!B1 Victima Nombre y Apellido>

    <div class="form-group"{{ $errors->has('victima_nombre_y_apellido') ? 'has-error' : ''}}>
  

    <label for="">B 1. Nombre y apellido:</label>
  


    <input type="text" class="form-control" name="victima_nombre_y_apellido" id="victima_nombre_y_apellido" value="{{$victima_nombre_y_apellido}}">
    <label for="bloqueo1" class="form-check-label">Se desconoce</label>

    <input type="checkbox" id="bloqueo1" name="victima_nombre_y_apellido" value="Se desconoce" onchange="checkC1(this)">
    {!! $errors->first('victima_nombre_y_apellido', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>

    <script>
         function checkC1(checkbox)
         {
             if (checkbox.checked)
                 {
                     $('#victima_nombre_y_apellido').val('Se desconoce');
                     document.getElementById('victima_nombre_y_apellido').setAttribute("readonly", "readonly");
                 }else
                     {
                         $('#victima_nombre_y_apellido').val('');
                         document.getElementById('victima_nombre_y_apellido').removeAttribute("readonly");
                     }
         }
      </script>

<!-B 2. telefono>

       <div class="form-group"{{ $errors->has('telefono_victima') ? 'has-error' : ''}}>


    @if(old('telefono_victima')=="0")

<label >B 2. teléfono Víctima:</label><br>
<strong><span>*Celulares sin el 15.Característica sólo cuatro dígitos, de ser necesario  incluir el 0. Ejemplo: 0221-350-20-45, Ejemplo Capital Federal: 0116-344-58-28:</span></strong>

    <input name="telefono_victima" style="background-color: #e9ecef;color:black" value="{{$victim->telefono_victima}}"   id="telefono_victima" class="form-control" placeholder="Ingresar 10 dígitos, el sisrema le dará el formato 221-463-2683 o 114-563-2889" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
onKeypress="addDashesPhoneUno(this)" type="tel" readonly="readonly"/>

    <label class="form-check-label">Se desconoce</label>
    <input name="telefono_victima" value="000-000-0000" id="bloqueo1" type="checkbox" checked onchange="checkA14(this)">
    @else

<label for="edad">B 2. teléfono Víctima:</label><br>
<strong><span>*Celulares sin el 15.Característica sólo cuatro dígitos, de ser necesario  incluir el 0. Ejemplo: 0221-350-20-45, Ejemplo Capital Federal: 0116-344-58-28:</span></strong>
    <input type="tel" name="telefono_victima" style="background-color: white;color:black" value="{{$victim->telefono_victima}}"   id="telefono_victima" class="form-control" pplaceholder="Ingresar 10 dígitos, el sisrema le dará el formato 221-463-2683 o 114-563-2889" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
onKeypress="addDashesPhoneUno(this)" required >

    <label class="form-check-label" >Se desconoce</label>
    <input name="telefono_victima" value="000-000-0000" id="bloqueo1" type="checkbox" onchange="checkA14(this)">
  @endif

    {!! $errors->first('telefono_victima', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>


</script>
<script type="text/javascript">
  function addDashesPhoneUno(f1) {
  var r1 = /(\D+)/g,
  npa1 = '',
  nxx1 = '',
  last41 = '';
  f1.value = f1.value.replace(r1, '');
  npa1 = f1.value.substr(0, 3);
  nxx1 = f1.value.substr(3, 3);
  last41 = f1.value.substr(6, 4);
  f1.value = npa1 + '-' + nxx1 + '-' + last41;
}
</script>
<script type="text/javascript">
       function checkA14(checkbox) {
          if (checkbox.checked)
                {
                    $('#telefono_victima').val('Se Desconoce');
                    document.getElementById('telefono_victima').setAttribute("readonly","readonly");
                    document.getElementById('telefono_victima').style.background="#e9ecef";
                    divAY= document.getElementById("telefono_victima").disabled=true;

           }
           else{
                    $('#telefono_victima').val('');
                  document.getElementById('telefono_victima').style.background="white";
                    document.getElementById('telefono_victima').removeAttribute("readonly");
                  divA = document.getElementById("telefono_victima").disabled=false;

           }}
    </script>


<!-B 2. telefono>

       <div class="form-group"{{ $errors->has('otro_telefono_victima') ? 'has-error' : ''}}>


    @if(old('otro_telefono_victima')=="0")

<label >B 2 I. Otro teléfono Víctima:</label><br>
<strong><span>*Celulares sin el 15.Característica sólo cuatro dígitos, de ser necesario  incluir el 0. Ejemplo: 0221-350-20-45, Ejemplo Capital Federal: 0116-344-58-28:</span></strong>

    <input name="otro_telefono_victima" style="background-color: #e9ecef;color:black" value="{{$victim->otro_telefono_victima}}"   id="otro_telefono_victima" class="form-control" placeholder="Ingresar 10 dígitos, el sisrema le dará el formato 221-463-2683 o 114-563-2889" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
onKeypress="addDashesPhoneDos(this)" type="tel" readonly="readonly"/><br>

    <label class="form-check-label">Se desconoce</label>
    <input name="otro_telefono_victima" value="000-000-0000" id="bloqueo2" type="checkbox" checked onchange="checkA15(this)">
    @else

<label for="edad">B 2. Otro teléfono Víctima:</label><br>
<strong><span>*Celulares sin el 15.Característica sólo cuatro dígitos, de ser necesario  incluir el 0. Ejemplo: 0221-350-20-45, Ejemplo Capital Federal: 0116-344-58-28:</span></strong>
    <input type="tel" name="otro_telefono_victima" style="background-color: white;color:black" value="{{$victim->otro_telefono_victima}}"   id="otro_telefono_victima" class="form-control" placeholder="Ingresar 10 dígitos, el sisrema le dará el formato 221-463-2683 o 114-563-2889" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
onKeypress="addDashesPhoneDos(this)" required >

    <label class="form-check-label" >Se desconoce</label>
    <input name="otro_telefono_victima" value="000-000-0000" id="bloqueo2" type="checkbox" onchange="checkA15(this)">
  @endif

    {!! $errors->first('otro_telefono_victima', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>


</script>

<script type="text/javascript">
  function addDashesPhoneDos(f2) {
  var r2 = /(\D+)/g,
  npa2 = '',
  nxx2 = '',
  last42= '';
  f2.value = f2.value.replace(r2, '');
  npa2 = f2.value.substr(0, 3);
  nxx2 = f2.value.substr(3, 3);
  last42 = f2.value.substr(6, 4);
  f2.value = npa2 + '-' + nxx2 + '-' + last42;
}
</script>


<script type="text/javascript">
       function checkA15(checkbox) {
          if (checkbox.checked)
                {
                    $('#otro_telefono_victima').val('Se Desconoce');
                    document.getElementById('otro_telefono_victima').setAttribute("readonly","readonly");
                    document.getElementById('otro_telefono_victima').style.background="#e9ecef";
                    divAY= document.getElementById("otro_telefono_victima").disabled=true;

           }
           else{
                    $('#otro_telefono_victima').val('');
                  document.getElementById('otro_telefono_victima').style.background="white";
                    document.getElementById('otro_telefono_victima').removeAttribute("readonly");
                  divA = document.getElementById("otro_telefono_victima").disabled=false;

           }}
    </script>


<!-DOMICILIO Y LOCALIDAD DE LA VICTIMA>


<div class="form-group" id="localidad_hecho" {{ $errors->has('localidad_hecho') ? 'has-error' : ''}}>

    <label for="cityId2">B 2III. Localidad:</label>
    <select class="form-control" name="localidad_hecho" onChange="selectOnChangeA2(this)">
              <option value="" selected=disabled>Seleccionar...</option>
              @foreach ($ciudades as $ciudad)
             @if($localidad_hecho==$ciudad->id)
                <option selected value="{{ $ciudad->id }}">{{ $ciudad->localidad_nombre}}</option>
              @else <option  value="{{ $ciudad->id }}">{{ $ciudad->localidad_nombre}}</option>
              @endif
            @endforeach
            </select>

  
    {!! $errors->first('localidad_hecho', '<p class="help-block" style="color:red";>:message</p>') !!}
   </div><br><br>























<!-B 2II. Domicilio>

     <div class="form-group" {{ $errors->has('domicilio_victima_asistida') ? 'has-error' : ''}}>
    <label for="">B 2II Domicilio de la víctima:</label>

    <input type="text" class="form-control" name="domicilio_victima_asistida" id="domicilio_victima_asistida" value="{{$victim->domicilio_victima_asistida}}">

    <label for="bloqueo1" class="form-check-label">Se desconoce</label>
    <input type="checkbox" id="bloqueo1" name="domicilio_victima_asistida" value="Se desconoce" onchange="checkA14IV(this)">
    {!! $errors->first('domicilio_victima_asistida', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>

    <script>
         function checkA14IV(checkbox)
         {
             if (checkbox.checked)
                 {
                     $('#domicilio_victima_asistida').val('Se desconoce');
                     document.getElementById('domicilio_victima_asistida').setAttribute("readonly", "readonly");
                 }else
                     {
                         $('#domicilio_victima_asistida').val('');
                         document.getElementById('domicilio_victima_asistida').removeAttribute("readonly");
                     }
         }
      </script>




<!B3 Género>

    <div class="form-group"{{ $errors->has('genero') ? 'has-error' : ''}}>
    <label for="">B 3. Género:</label>
    <select class="form-control" name="genero" onChange="selectOnChangeB2(this)">
        <option value="" selected=disabled>Seleccionar...</option>
        @if($genero ==1))
        <option value="1" selected>Mujer Cis</option>
        @else
        <option value="1">Mujer Cis</option>
        @endif

        @if ($genero ==2)
        <option value="2" selected>Mujer Trans</option>
        @else
        <option value="2" >Mujer Trans</option>
        @endif

        @if ($genero ==3)
        <option value="3" selected>Varon Cis</option>
        @else
        <option value="3" >Varon Cis</option>
        @endif

        @if ($genero ==4)
        <option value="4" selected>Varon Trans</option>
        @else
        <option value="4" >Varon Trans</option>
        @endif

        @if ($genero ==5)
        <option value="5" selected>Otro</option>
        @else
        <option value="5" >Otro</option>
        @endif
    </select>
    {!! $errors->first('genero', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>



<!B4 Fecha de nacimiento>

    <div class="form-group"{{ $errors->has('victima_fecha_nacimiento') ? 'has-error' : ''}}>
    <label for="">B 4. Fecha de nacimiento: </label>
    <input type="date" class="form-control" id="victima_fecha_nacimiento" name="victima_fecha_nacimiento" value="{{$victima_fecha_nacimiento}}">
    <label for="bloqueo3" class="form-check-label">Se desconoce</label>
    <input type="checkbox" id="bloqueo3" name="victima_fecha_nacimiento_desconoce" value="Se desconoce" onchange="checkB3(this)">
    {!! $errors->first('victima_fecha_nacimiento', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>

      <script>
         function checkB3(checkbox)
         {
             if (checkbox.checked)
             {
                 $('#victima_fecha_nacimiento').val('1900-01-01');
                 document.getElementById('victima_fecha_nacimiento').setAttribute("readonly", "readonly");
             }else
                 {
                     $('#victima_fecha_nacimiento').val('');
                     document.getElementById('victima_fecha_nacimiento').removeAttribute("readonly");
                 }
         }
      </script>

<!B5 Edad>


    <div class="form-group"{{ $errors->has('victima_edad') ? 'has-error' : ''}}>

    @if($victima_edad=="0")
      <label for="victima_edad">B 5. Edad:</label>
    <input name="victima_edad"  style="background-color: #e9ecef;color:black"value="{{$victima_edad}}" onchange="mostrarValorB4(this.value);" id="victima_edad" class="form-control" type="text" readonly="readonly"/><br>


    <label class="form-check-label" >Se desconoce</label>
    <input name="victima_edad" value="0" id="bloqueo1" type="checkbox" checked onchange="checkB4(this)">


    @else

  <label for="victima_edad">B 5. Edad:</label>
    <input name="victima_edad" style="background-color: white;color: black" value="{{$victima_edad}}" onchange="mostrarValorB4(this.value);" id="victima_edad" class="form-control" type="text"><br>
    <label class="form-check-label" >Se desconoce</label>
    <input name="victima_edad" value="0" id="bloqueo1" type="checkbox" onchange="checkB4(this)">
  @endif

    {!! $errors->first('victima_edad', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>


</script>

<script type="text/javascript">
       function checkB4(checkbox) {
          if (checkbox.checked)
                {
                    $('#victima_edad').val('Se Desconoce');
                    document.getElementById('victima_edad').setAttribute("readonly","readonly");
                    document.getElementById('victima_edad').style.background="#e9ecef";
                    $('#franjaetaria_id').val('7');

                    divAY= document.getElementById("victima_edad").disabled=true;

           }
           else{
                    $('#victima_edad').val('');
                    document.getElementById('victima_edad').style.background="white";
                    document.getElementById('victima_edad').removeAttribute("readonly");
                    $('#franjaetaria_id').val('').disabled=false;
                  divA = document.getElementById("victima_edad").disabled=false;

           }}
    </script>


<!B6 Franja Etaria>

    <div class="form-group"{{ $errors->has('franjaetaria') ? 'has-error' : ''}}>
    <label for="">B 6. Franja Etaria</label>
    <select name="franjaetaria" id="franjaetaria_id" class="form-control" value="">
          <option value="" selected=disabled>Seleccionar...</option>
            @if($franjaetaria == 1) <option value="1" selected>0 a 11 años</option> @else <option value="1">0 a 11 años</option> @endif
            @if($franjaetaria  == 2) <option value="2" selected>12 a 18 años</option> @else <option value="2" >12 a 18 años</option> @endif
            @if($franjaetaria  == 3) <option value="3" selected>19 a 30 años</option> @else <option value="3" >19 a 30 años</option> @endif
            @if($franjaetaria  == 4) <option value="4" selected>31 a 50 años</option> @else <option value="4" >31 a 50 años</option> @endif
            @if($franjaetaria  == 5) <option value="5" selected>51 a 65 años</option> @else <option value="5" >51 a 65 años</option> @endif
            @if($franjaetaria  == 6) <option value="6" selected>65 años o más</option>@else <option value="6" >65 años o más</option> @endif
            @if($franjaetaria  == 7) <option value="7" selected>Se desconoce</option> @else <option value="7" >Se desconoce</option> @endif
          <!-- no hago un array en este caso porque toma los valores una funcion de javascript -->
    </select>
    {!! $errors->first('franjaetaria', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>
    <!-- de acuerdo al valor que se seleccione le asigno una franja etaria  -->
    <script type="text/javascript">
       var mostrarValorB4 = function(x){
        if(x==0){
            dicv=document.getElementById('victima_edad').value=1;
        }
       if(x<12){
           document.getElementById('franjaetaria_id').value=1;


       }
       if(x>11){if(x<19){

       	document.getElementById('franjaetaria_id').value=2;}
       }

       if(x>18){if(x<31){
       	document.getElementById('franjaetaria_id').value=3;}
       }

       if(x>30){if(x<51){
       	document.getElementById('franjaetaria_id').value=4;}
       }

       if(x>50){if(x<66){
       	document.getElementById('franjaetaria_id').value=5;}
       }

       if(x>65){
       	document.getElementById('franjaetaria_id').value=6;}
       }
    </script>

<!B7 Documentación>

    <div class="form-group"{{ $errors->has('tienedoc') ? 'has-error' : ''}}>
    <label for="">B 7. ¿Cuenta con alguna documentación que permita acreditar su identidad?:</label>
    <select class="form-control" name="tienedoc" id="tienedoc" onChange="selectOnChangeB6(this)">
            <option value="" selected=disabled>Seleccionar...</option>
            @if ($tienedoc == 1)<option value="1" selected>Posee</option> @else <option value="1">Posee</option> @endif

            @if ($tienedoc == 3)<option value="3" selected>No posee</option>
            @else <option value="3" >No posee</option> @endif

            @if ($tienedoc == 5)<option value="5" selected>En tramite</option> @else <option value="5">En tramite</option>@endif

            @if ($tienedoc == 6)<option value="6" selected>Se desconoce</option> @else<option value="6" >Se desconoce</option> @endif
    </select>
    {!! $errors->first('tienedoc', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>



 <script>
         function selectOnChangeB6(sel) {
          if (sel.value=="1"||sel.value=="5"){
              divV = document.getElementById("que_doc");
              divV.style.display = "";
              divV = document.getElementById("que_doc8");
              divV.style.display = "";}



              if (sel.value=="3"||sel.value=="6"){
                divV = document.getElementById("que_doc");
                divV.style.display = "none";
                divV = document.getElementById("que_doc8");
                divV.style.display = "none";
                divVC = document.getElementById("cual_b2");
              $('#victima_tipo').val('');
              divVC.style.display="none";
              $('#tipodocumento').val('0');
              $('#victima_numero_documento').val('');


          }
         }
      </script>



<!B8 Tipo documentación>
@if ($tienedoc == 1||$tienedoc == 5||$errors->has('tipodocumento')||$errors->has('tipo_documento_otro'))
 <div id="que_doc" {{ $errors->has('tipodocumento') ? 'has-error' : ''}}>
    @else
    <div id="que_doc" style="display: none">
    @endif

    <label for="">B 8. Tipo de documentación:</label>
    <select class="form-control" id="tipodocumento" name="tipodocumento" onChange="selectOnChangeB7(this)">
        <option value="" selected=disabled>Seleccionar...</option>
        @if($tipodocumento ==1)<option value="1" selected>D.N.I.</option> @else<option value="1" >D.N.I.</option>@endif

        @if($tipodocumento ==2)<option value="2" selected>Documento Extranjero</option>
        @else<option value="2">Documento Extranjero</option>@endif

        @if($tipodocumento ==3)<option value="3" selected>Libreta Cívica</option>
        @else<option value="3">Libreta Cívica</option>@endif

        @if($tipodocumento==4)<option value="4" selected>Libreta de Enrolamiento</option>
        @else<option value="4" >Libreta de Enrolamiento</option>@endif

        @if($tipodocumento ==5)<option value="5" selected>Pasaporte</option>
        @else<option value="5">Pasaporte</option>@endif

        @if($tipodocumento ==6)<option value="6" selected>Residencia Precaria</option>
        @else<option value="6">Residencia Precaria</option> @endif

        @if($tipodocumento ==7)<option value="7" selected>Se Desconoce</option>
        @else<option value="7">Se Desconoce</option> @endif

        @if($tipodocumento ==8)<option value="8" selected>No posee</option>
        @else<option value="8">No posee</option>@endif

        @if($tipodocumento ==9)<option value="9" selected>Otro</option>
        @else<option value="9">Otro</option>@endif
    </select>
    {!! $errors->first('tipodocumento', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>

    @if ($tipodocumento == 9)||$errors->has('tipo_documento_otro')
    <div id="cual_b2" {{ $errors->has('tipo_documento_otro') ? 'has-error' : ''}}>
    @else
    <div id="cual_b2" style="display: none">
    @endif
    <label for="">Cuál?</label>
    <input name="tipo_documento_otro"  id="victima_tipo" class="form-control" type="text" value="{{$tipo_documento_otro}}" onclick="cual_b5()">
    {!! $errors->first('tipo_documento_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>
    </div>


    @if ($tipodocumento == 6) <div id="cual_b14">
    @else <div id="cual_b14" style="display: none">
    @endif

    <label for="">B 8.I Estado de la residencia precaria</label>
    <select class="form-control" id="residenciaprecaria_id" name="residenciaprecaria" class="form-control">
            <option value="" selected=disabled>Seleccionar...</option>
            @if($residenciaprecaria == 1)<option value="1" selected>Vigente</option>
            @else <option value="1">Vigente</option>@endif

            @if($residenciaprecaria == 2)<option value="2" selected>Vencida</option>
            @else <option value="2">Vencida</option>@endif

            @if($residenciaprecaria == 3)<option value="3" selected>Se desconoce</option>
            @else <option value="3">Se desconoce</option>@endif
    </select>
    {!! $errors->first('residenciaprecaria', '<p class="help-block" style="color:red";>:message</p>') !!}
    <br>
    </div>
        <script>
           function selectOnChangeB7(sel) {
                              if (sel.value=="6"){
                                  divC = document.getElementById("cual_b14");
                                  divC.style.display = "";
                              }else{
                                  divC = document.getElementById("cual_b14");
                                  $('#residenciaprecaria_id').val('');
                                  divC.style.display="none";
                              }
                              
                              
            if (sel.value=="7"||sel.value=="8"){
              divC8= document.getElementById("victima_numero_documento");
              $('#victima_numero_documento').val('');
                                  divC8.style.display = "none";
                                     divC88= document.getElementById("ndoc");
                                      divC88.style.display = "none";

            }else{
              divC88= document.getElementById("ndoc");
                                      divC88.style.display = "";
             divC888= document.getElementById("victima_numero_documento");
             divC888.style.display = "";
            }
           	if (sel.value=="9"){
           		divC = document.getElementById("cual_b2");
           		divC.style.display = "";
           	}else{
           		divC = document.getElementById("cual_b2");
           		$('#victima_tipo').val('');
           		divC.style.display="none";
           	}
           }

        </script>

<!B9 Nro documento>
@if ($tienedoc == 1||$tienedoc == 5||$errors->has('tipodocumento')||$errors->has('tipo_documento_otro'))
 <div id="que_doc8" {{ $errors->has('tipodocumento') ? 'has-error' : ''}}>
    @else
    <div id="que_doc8" style="display: none">
    @endif
    <div class="form-group" {{ $errors->has('victima_numero_documento') ? 'has-error' : ''}}>
<div id="ndoc">

    @if($victima_numero_documento =="0")

 <label for="">B 9. Nro Documento:</label>
    <input name="victima_numero_documento" value="{{$victima_numero_documento}}"   id="victima_numero_documento" class="form-control"style="background-color: #e9ecef;color:black" type="text" readonly="readonly"/><br>

    <label class="form-check-label" >Se desconoce</label>
    <input name="victima_numero_documento" value="0" id="bloqueo1" type="checkbox" checked onchange="checkB8(this)">

    @else
     <label for="">B 9. Nro Documento:</label>
        <input name="victima_numero_documento" style="background-color: white;color:black" value="{{$victima_numero_documento}}"   id="victima_numero_documento" class="form-control" type="text"><br>

    <label class="form-check-label" >Se desconoce</label>
    <input name="victima_numero_documento" value="0" id="bloqueo1" type="checkbox" onchange="checkB8(this)">
  @endif

    {!! $errors->first('victima_numero_documento', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>
</div>
</div>


<script type="text/javascript">
       function checkB8(checkbox) {
          if (checkbox.checked)
                {
                    $('#victima_numero_documento').val('Se Desconoce');
                    document.getElementById('victima_numero_documento').setAttribute("readonly","readonly");
                      document.getElementById('victima_numero_documento').style.background="#e9ecef";
                    divAY= document.getElementById("victima_numero_documento").disabled=true;

           }
           else{
                    $('#victima_numero_documento').val('');
document.getElementById('victima_numero_documento').style.background="white";
                    document.getElementById('victima_numero_documento').removeAttribute("readonly");
                  divA = document.getElementById("victima_numero_documento").disabled=false;

           }}
    </script>



<!B10 Nivel educativo>

    <div class="form-group"{{ $errors->has('niveleducativo') ? 'has-error' : ''}}>
    <label for="">B 10. Máximo nivel educativo alcanzado:</label>
    <select class="form-control" name="niveleducativo">
          <option value="" selected=disabled>Seleccionar...</option>
          @if($niveleducativo == 1)<option value="1" selected>Sin instrucción formal</option>
          @else <option value="1" >Sin instrucción formal</option>@endif

          @if($niveleducativo == 2)<option value="2" selected>Primario incompleto</option>
          @else <option value="2" >Primario incompleto</option>@endif

          @if($niveleducativo == 3)<option value="3" selected>Primario completo</option>
          @else <option value="3" >Primario completo</option>@endif

          @if($niveleducativo == 4)<option value="4" selected>Secundario incompleto</option>
          @else <option value="4" >Secundario incompleto</option>@endif

          @if($niveleducativo == 5)<option value="5" selected>Secundario completo</option>
          @else <option value="5">Secundario completo</option>@endif

          @if($niveleducativo == 6)<option value="6" selected>Terciario-Universitario incompleto</option>
          @else <option value="6" >Terciario-Universitario incompleto</option>@endif

          @if($niveleducativo == 7) <option value="7" selected>Terciario-Universitario completo</option>
          @else <option value="7" >Terciario-Universitario completo</option>@endif

          @if($niveleducativo == 8) <option value="8" selected>Se desconoce</option>
          @else<option value="8" >Se desconoce</option>@endif
    </select>
    {!! $errors->first('niveleducativo', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>

<!B11 Condiciones de trabajo>

  <div class="form-group"{{ $errors->has('condiciones_de_trabajo') ? 'has-error' : ''}}>
  <label for="modalidad_id">B 11.Condiciones de trabajo:</label>
  <select class="form-control" name="condiciones_de_trabajo" style="background-color: grey;color:white" id="condiciones_de_trabajo">
      <option value="" selected=disabled>Seleccionar...</option>
      @if($condiciones_de_trabajo == 1) <option value="1" selected>Desocupado(a)</option>
      @else <option value="1" >Desocupado(a)</option>@endif

      @if($condiciones_de_trabajo == 2) <option value="2" selected>Empleo informal</option>
      @else <option value="2" >Empleo informal</option>@endif

      @if($condiciones_de_trabajo == 3) <option value="3" selected>Empleo formal</option>
      @else <option value="3" >Empleo formal</option>@endif

      @if($condiciones_de_trabajo == 4) <option value="4" selected>Población Inactiva (jubilados, menores de edad, pensionados, etc.)</option>
      @else <option value="4" >Población Inactiva (jubilados, menores de edad, pensionados, etc.)</option>@endif

      @if($condiciones_de_trabajo == 5) <option value="5" selected>Se desconoce</option>
      @else <option value="5" >Se desconoce</option>@endif
  </select>
  {!! $errors->first('condiciones_de_trabajo', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

<!B12 Necesidades insatisfechas>
<div class="form-group"{{ $errors->has('necesidades_socioeconomicas_insatisfechas') ? 'has-error' : ''}}>
  <label for="modalidad_id">B 12.¿Tiene necesidades socioeconómicas insatisfechas?:</label>
  <select class="form-control" name="necesidades_socioeconomicas_insatisfechas" id="necesidades_insatisfechas" onChange="selectOnChangeB11(this)" style="background-color: grey;color:white">
              <option value="" selected=disabled>Seleccionar...</option>
              @if($necesidades_socioeconomicas_insatisfechas == 1)<option value="1" selected>Sí</option>
              @else<option value="1" >Sí</option>@endif
              @if($necesidades_socioeconomicas_insatisfechas == 2)<option value="2" selected>No</option>
              @else<option value="2" >No</option>@endif
              @if($necesidades_socioeconomicas_insatisfechas == 3)<option value="3" selected>Se desconoce</option>
              @else<option value="3" >Se desconoce</option>@endif
  </select>
  {!! $errors->first('necesidades_socioeconomicas_insatisfechas', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

@if($necesidades_socioeconomicas_insatisfechas == 1||$errors->has('necesidades'))
  <div class="form-group" id="necesidades_insatisfechas_si"
  {{ $errors->has('necesidades') ? 'has-error' : ''}}>
  <label>B 12 I. Necesidades socioeconómicas insatisfechas: </label><br>
  <label>En caso de requerir, tildar todas las opciones que considere correspondientes.</label><br>
              @foreach ($necesidades as $necesidad)
                <label class="form-check-inline form-check-label">
                 @if ($victim->necesidadesIds()->contains($necesidad->id))
                    <input type="checkbox" value="{{ $necesidad->id }}" id="{{ $necesidad->id }}" class="form-check-inline neceSocio" name="necesidades[]" checked>
                  @else

                <input type="checkbox" value="{{ $necesidad->id }}" id="{{ $necesidad->id }}" class="form-check-inline neceSocio" name="necesidades[]">
              @endif
                {{ $necesidad->nombre }}
                </label><br>
              @endforeach


  {!! $errors->first('necesidades', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

@else
  <div class="form-group" id="necesidades_insatisfechas_si" style="display:none">
  <label>B 12 I. Necesidades socioeconómicas insatisfechas: </label><br>
  <label>En caso de requerir, tildar todas las opciones que considere correspondientes.</label><br>
              @foreach ($necesidades as $necesidad)
                <label class="form-check-inline form-check-label">
               @if ($victim->necesidadesIds()->contains($necesidad->id))
                  <input type="checkbox" value="{{ $necesidad->id }}" class="form-check-inline neceSocio" name="necesidades[]" checked>
                @else
                <input type="checkbox" value="{{ $necesidad->id }}" class="form-check-inline neceSocio" name="necesidades[]">
                @endif
                {{ $necesidad->nombre }}
                </label><br>
              @endforeach
  </div>
  @endif

 @if ($victim->necesidadesIds()->contains(8)||$errors->has('necesidades_socioeconomicas_insatisfechas_otro'))
    <div id="cualB11" {{ $errors->has('necesidades_socioeconomicas_insatisfechas_otro') ? 'has-error' : ''}}>
    <label for="">Cual?</label>
    <input type="text" class="form-control" name="necesidades_socioeconomicas_insatisfechas_otro" value="{{$necesidades_socioeconomicas_insatisfechas_otro}}" id="necesidades_insatisfechas_otro">
    {!! $errors->first('necesidades_socioeconomicas_insatisfechas_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div><br>
  @else

  <div id="cualB11" style="display:none">
  <label for="">Cual?</label>
  <input type="text" class="form-control" name="necesidades_socioeconomicas_insatisfechas_otro" value="{{$necesidades_socioeconomicas_insatisfechas_otro}}" id="necesidades_insatisfechas_otro">
  </div><br>
  @endif

  <script type="text/javascript">
    var varios = document.querySelectorAll(".neceSocio")

    var otro = varios[varios.length-1]

    otro.onclick = function(){
       $('#necesidades_insatisfechas_otro').val('');
        $("#cualB11").toggle()



     }
  </script>


         <script>
            function selectOnChangeB11(sel) {
             if (sel.value=="1"){
                 divC = document.getElementById("necesidades_insatisfechas_si");
                 divC.style.display = "";}


                 if (sel.value=="2"||sel.value=="3"){
                   divC = document.getElementById("necesidades_insatisfechas_si");
                   divC.style.display = "none";
                   var checkboxes = divC.querySelectorAll('input');


                   checkboxes.forEach(function (oneCheckbox) {
                     oneCheckbox.checked = false;
                   })

                   document.querySelector('#cualB11').style.display = 'none';

                   document.querySelector('#necesidades_insatisfechas_otro').value = '';
             }}

         </script>

<!B13 PROGRAMAS SUBSIDIO>

<div class="form-group"{{ $errors->has('programa_subsidio') ? 'has-error' : ''}}>
   <label for="modalidad_id">B 13.¿Percibe algún tipo de programa o subsidio social?:</label>
   <select class="form-control" name="programa_subsidio" id="programa_subsidio" onChange="selectOnChangeB12(this)" style="background-color: grey;color:white">
              <option value="" selected=disabled>Seleccionar...</option>
              @if($programa_subsidio == 1)<option value="1" selected>Sí</option>
              @else<option value="1" >Sí</option>@endif
              @if($programa_subsidio == 2)<option value="2" selected>No</option>
              @else<option value="2" >No</option>@endif
              @if($programa_subsidio == 3)<option value="3" selected>Se desconoce</option>
              @else<option value="3" >Se desconoce</option>@endif
  </select>
  {!! $errors->first('programa_subsidio', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

@if($programa_subsidio == 1||$errors->has('programas'))
  <div class="form-group" id="programa_subsidio_si"
  {{ $errors->has('programas') ? 'has-error' : ''}}>
 <label>B 13 I. ¿Cuál?  </label><br>
   <label class="" >En caso de requerir, tildar todas las opciones que considere correspondientes.</label><br>
              @foreach ($programas as $programa)
                <label class="form-check-inline form-check-label">
                  @if ($victim->programasIds()->contains($programa->id))
                    <input type="checkbox" value="{{ $programa->id }}" id="{{ $programa->id }}" class="form-check-inline progra2" name="programas[]" checked>
                  @else

                <input type="checkbox" value="{{ $programa->id }}" id="{{ $programa->id }}" class="form-check-inline progra2" name="programas[]">
              @endif
                {{ $programa->nombre }}
                </label><br>
              @endforeach


  {!! $errors->first('programas', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

@else
  <div class="form-group" id="programa_subsidio_si" style="display:none">
<label>B 13 I. ¿Cuál?  </label><br>
   <label class="" >En caso de requerir, tildar todas las opciones que considere correspondientes.</label><br>
              @foreach ($programas as $programa)
                <label class="form-check-inline form-check-label">
              @if ($victim->programasIds()->contains($programa->id))
                  <input type="checkbox" value="{{ $programa->id }}" class="form-check-inline progra2" name="programas[]" checked>
                @else
                <input type="checkbox" value="{{ $programa->id }}" class="form-check-inline progra2" name="programas[]">
                @endif
                {{ $programa->nombre }}
                </label><br>
              @endforeach
              </div>
              @endif

 @if ($victim->programasIds()->contains(5)||$errors->has('programa_subsidio_otro'))
    <div id="cualB12" {{ $errors->has('programa_subsidio_otro') ? 'has-error' : ''}}>
    <label for="">Cual?</label>
    <input type="text" class="form-control" name="programa_subsidio_otro" value="{{$programa_subsidio_otro}}" id="programa_subsidio_otro">
    {!! $errors->first('programa_subsidio_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div><br>
  @else

  <div id="cualB12" style="display:none">
  <label for="">Cual?</label>
  <input type="text" class="form-control" name="programa_subsidio_otro" value="{{$programa_subsidio_otro}}" id="programa_subsidio_otro">
  </div><br>
  @endif

  <script type="text/javascript">
    var varios = document.querySelectorAll(".progra2")

    var otro = varios[varios.length-1]

    otro.onclick = function(){
       $('#programa_subsidio_otro').val('');
        $("#cualB12").toggle()



     }
  </script>


         <script>
            function selectOnChangeB12(sel) {
             if (sel.value=="1"){
                 divCB12 = document.getElementById("programa_subsidio_si");
                 divCB12.style.display = "";}


                 if (sel.value=="2"||sel.value=="3"){
                   divCB12 = document.getElementById("programa_subsidio_si");
                   divCB12.style.display = "none";
                   var checkboxes = divCB12.querySelectorAll('input');


                   checkboxes.forEach(function (oneCheckbox) {
                     oneCheckbox.checked = false;
                   })

                   document.querySelector('#cualB12').style.display = 'none';

                   document.querySelector('#programa_subsidio_otro').value = '';
             }}

         </script>
  
<!B14 Embarazo>


@if(($genero ==1) || ($genero ==4) || ($genero ==5)||$errors->has('embarazorelevamiento'))
  <div class="form-group">
  @else
  <div class="form-group"id="embarazo" style="display:none" {{ $errors->has('embarazorelevamiento') ? 'has-error' : ''}}>
  @endif
  <label for="">B 14. Embarazo al inicio de la asistencia:</label>
  <select class="form-control" id="embarazorelevamiento_id" name="embarazorelevamiento">
          <option value="" selected=disabled>Seleccionar...</option>
          @if ($embarazorelevamiento == 1) <option value="1" selected>Si</option>
          @else <option value="1" >Si</option> @endif
          @if ($embarazorelevamiento== 2) <option value="2" selected>No</option>
          @else <option value="2" >No</option> @endif
  </select>
  {!! $errors->first('embarazorelevamiento', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  <script>
     function selectOnChangeB2(sel) {
      if (sel.value=="1" || sel.value=="4" || sel.value=="5"){
          divC = document.getElementById("embarazo");
          divC.style.display = "";}


          if (sel.value=="2"||sel.value=="3"){
            divC = document.getElementById("embarazo");
            divC.style.display = "none";
            var selection = divC.querySelectorAll('option');


            selection.forEach(function (option) {
              option.selected = false;
            })


      }


     }

  </script>



<!B15 Discapacidad>
<div class="form-group" {{ $errors->has('tiene_discapacidad') ? 'has-error' : ''}}>
<label for="">B 15. ¿Presenta algún tipo de discapacidad?</label><br>
<select class="form-control"  name="tiene_discapacidad" onChange="selectOnChangeB14(this)" style="background-color: grey;color:white">
        <option value="" selected=disabled>Seleccionar...</option>
        @if ($tiene_discapacidad == 1) <option value="1" selected>Si</option>
        @else <option value="1" >Si</option> @endif
        @if ($tiene_discapacidad == 2) <option value="2" selected>No</option>
        @else <option value="2" >No</option> @endif
          @if ($tiene_discapacidad == 3) <option value="3" selected>Se desconoce</option>
          @else <option value="3" >Se desconoce</option> @endif
</select>
{!! $errors->first('tiene_discapacidad', '<p class="help-block" style="color:red";>:message</p>') !!}
</div>

@if($tiene_discapacidad == 1||$errors->has('discapacidades'))
<div class="form-group" id="b14Hidden"{{ $errors->has('discapacidades') ? 'has-error' : ''}}>
    <label for="">B15 I Que tipo de discapacidad?
      En caso de requerir, tildar todas las opciones que considere correspondientes.</label><br>
        @foreach ($discapacidades as $discapacidad)
            <label class="form-check-inline form-check-label">
             @if ($victim->discapacidadesIds()->contains($discapacidad->id))
            <input type="checkbox" value="{{ $discapacidad->id }}" id="{{$discapacidad->nombre }}" class="form-check-inline discap" name="discapacidades[]" checked>
          @else
            <input type="checkbox" value="{{ $discapacidad->id }}" id="{{$discapacidad->nombre }}" class="form-check-inline discap" name="discapacidades[]">
          @endif
            {{ $discapacidad->nombre }}
            </label><br>
        @endforeach

    {!! $errors->first('discapacidades', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>
@else

<div class="form-group" id="b14Hidden" style="display: none">
    <label for="">B15 I Que tipo de discapacidad?
      En caso de requerir, tildar todas las opciones que considere correspondientes.</label><br>
        @foreach ($discapacidades as $discapacidad)
            <label class="form-check-inline form-check-label">
             @if ($victim->discapacidadesIds()->contains($discapacidad->id))
            <input type="checkbox" value="{{ $discapacidad->id }}" id="{{$discapacidad->nombre }}" class="form-check-inline discap" name="discapacidades[]" checked>
          @else
            <input type="checkbox" value="{{ $discapacidad->id }}" id="{{$discapacidad->nombre }}" class="form-check-inline discap" name="discapacidades[]">
          @endif
            {{ $discapacidad->nombre }}
            </label><br>
        @endforeach

    </div>
@endif


    <script>
         function selectOnChangeB14(sel)
         {
           var divC14 = document.querySelector("#b14Hidden");
           if (sel.value == 1) {
             divC14.style.display = 'block';
           } if (sel.value == 2||sel.value == 3){
             
             var checkboxes = divC14.querySelectorAll('input');
             checkboxes.forEach(function (element) {
               element.checked = false;
             });
             divC14.style.display = 'none';
           }


         }
     </script>
     <script type="text/javascript">
    


$('#desconoce').click(function () {
    if($(this).is(":checked")){
        $('#físico-motriz').prop('disabled', true);
        $('#físico-motriz').prop('checked', false);
        $('#intelectual-adaptativo').prop('disabled', true);
        $('#intelectual-adaptativo').prop('checked', false);
        $('#psíquica').prop('disabled', true);
        $('#psíquica').prop('checked', false);
        $('#sensorial').prop('disabled', true);
        $('#sensorial').prop('checked', false);
    }else{
        $('.discap').prop('disabled', false);
    }
    
 });
             
          
       

</script>
<!B16 Lesiones físicas>

    <div class="form-group"{{ $errors->has('tienelesion') ? 'has-error' : ''}}>
    <label class="">B 16. ¿Presenta lesiones físicas visibles? </label>
    <select class="form-control" id="tienelesion" name="tienelesion" onChange="selectOnChangeB15(this)" style="background-color: grey;color:white">
            <option value="" selected=disabled>Seleccionar...</option>
            @if($tienelesion== 1)<option value="1" selected>Si</option>
            @else<option value="1" >Si</option>@endif
            @if($tienelesion == 2)<option value="2" selected>No</option>
            @else<option value="2" >No</option>@endif
            @if($tienelesion == 3)<option value="3" selected>Se desconoce</option>
            @else<option value="3" >Se desconoce</option>@endif
    </select>
    {!! $errors->first('tienelesion', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>

@if($tienelesion == 1||$errors->has('tipo_lesion'))
  <div class="" id="cualB15" {{ $errors->has('tipo_lesion') ? 'has-error' : ''}}>
  @else
    <div class="" id="cualB15" style="display: none">
    @endif

    <label class="">Tipo de lesión:</label>

    <input name="tipo_lesion" placeholder="" id="victima_lesion" class="form-control" type="text" value="{{$tipo_lesion}}">
    {!! $errors->first('tipo_lesion', '<p class="help-block" style="color:red";>:message</p>') !!}
    <br>
  </div>

      <script>
         function selectOnChangeB15(sel) {
                  if (sel.value=="1"){
                      divC = document.getElementById("cualB15");
                      divC.style.display = "";
                  }else{
                      divC = document.getElementById("cualB15");
                      $('#victima_lesion').val('');
                      divC.style.display="none";
                  }}

      </script>

<!B17 Enfermedades crónicas>

    <div class="form-group"{{ $errors->has('enfermedadcronica') ? 'has-error' : ''}}>
    <label class="">B 17. ¿Tiene enfermedades crónicas?</label>
    <select class="form-control" id="enfermedadcronica" name="enfermedadcronica" onChange="selectOnChange16(this)" style="background-color: grey;color:white">
            <option value="" selected=disabled>Seleccionar...</option>
            @if($enfermedadcronica == 1)<option value="1" selected>Si</option>
            @else<option value="1" >Si</option>@endif
            @if($enfermedadcronica == 2)<option value="2" selected>No</option>
            @else<option value="2" >No</option>@endif
            @if($enfermedadcronica == 3)<option value="3" selected>Se desconoce</option>
            @else<option value="3" >Se desconoce</option>@endif
    </select>
    {!! $errors->first('enfermedadcronica', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>

    @if($enfermedadcronica == 1||$errors->has('tipo_enfermedad_cronica'))
    <div class="" id="victima_tipo_enfermedad_cronica" {{ $errors->has('tipo_enfermedad_cronica') ? 'has-error' : ''}}>
    @else
    <div class="" id="victima_tipo_enfermedad_cronica" style="display: none">
      @endif

    <label class="">B 17 I. Tipo de enfermedad crónica:</label>
    <input name="tipo_enfermedad_cronica" placeholder="Enfermedad crónica" id="victima_enfermedad_cronica" class="form-control" type="text" value="{{$tipo_enfermedad_cronica}}" style="background-color: grey;color:white">
    {!! $errors->first('tipo_enfermedad_cronica', '<p class="help-block" style="color:red";>:message</p>') !!}
    <br>
    </div>


      <script>
         function selectOnChange16(sel) {
           if (sel.value=="1"){
                divC = document.getElementById("victima_tipo_enfermedad_cronica");
                divC.style.display = "";}

                 if (sel.value=="2"){
                      divC = document.getElementById("victima_tipo_enfermedad_cronica");
                      $('#victima_enfermedad_cronica').val('');
                      divC.style.display = "none";}
                      if (sel.value=="3"){
                           divC = document.getElementById("victima_tipo_enfermedad_cronica");
                           $('#victima_enfermedad_cronica').val('');
                           divC.style.display = "none";}


         }
      </script>





<!B18 Limitaciones>

<div class="form-group"{{ $errors->has('tiene_limitacion') ? 'has-error' : ''}}>
<label>B 18. ¿Presenta algún tipo de limitación para comunicarse? </label><br>
<select class="form-control" name="tiene_limitacion" OnChange="selectOnChangeB17(this)" style="background-color: grey;color:white">
        <option value="" selected=disabled>Seleccionar...</option>
        @if($tiene_limitacion == 1)<option value="1" selected>Si</option>
        @else<option value="1" >Si</option>@endif
        @if($tiene_limitacion == 2)<option value="2" selected>No</option>
        @else<option value="2" >No</option>@endif
        @if($tiene_limitacion == 3)<option value="3" selected>Se desconoce</option>
        @else<option value="3" >Se desconoce</option>@endif
</select>
{!! $errors->first('tiene_limitacion', '<p class="help-block" style="color:red";>:message</p>') !!}
</div>

@if($tiene_limitacion == 1||$errors->has('limitaciones')||$errors->has('limitacion_otro'))
  <div class="form-group" id="limitacionesSi" {{ $errors->has('limitaciones') ? 'has-error' : ''}}>
    <label>En caso de requerir, tildar todas las opciones que considere correspondientes.</label><br>
    <div>
      @foreach ($limitaciones as $limitacion)
          <label class="form-check-inline form-check-label">
       @if ($victim->limitacionesIds()->contains($limitacion->id))
              <input type="checkbox" value="{{ $limitacion->id }}" class="form-check-inline limi2" name="limitaciones[]" checked>
          @else
              <input type="checkbox" value="{{ $limitacion->id }}" class="form-check-inline limi2" name="limitaciones[]">
          @endif
              {{ $limitacion->nombre }}
              </label><br>
      @endforeach
    {!! $errors->first('limitaciones', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>
@else
<div class="form-group" id="limitacionesSi" style="display:none">
    <label>En caso de requerir, tildar todas las opciones que considere correspondientes.</label><br>
    <div>
      @foreach ($limitaciones as $limitacion)
          <label class="form-check-inline form-check-label">
         @if ($victim->limitacionesIds()->contains($limitacion->id))
              <input type="checkbox" value="{{ $limitacion->id }}" class="form-check-inline limi2" name="limitaciones[]" checked>
          @else
              <input type="checkbox" value="{{ $limitacion->id }}" class="form-check-inline limi2" name="limitaciones[]">
          @endif
              {{ $limitacion->nombre }}
              </label><br>
      @endforeach
    </div>
@endif



   @if ($victim->limitacionesIds()->contains(4)||$errors->has('limitacion_otro'))
      <div id="cualB17" {{ $errors->has('limitacion_otro') ? 'has-error' : ''}}>
      @else
        <div id="cualB17" style="display:none">
      @endif
      <label for="">Cual?</label>
      <input type="text" class="form-control" name="limitacion_otro"  id="victima_limitacion_otra" value="{{$limitacion_otro}}">
      {!! $errors->first('limitacion_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
      </div>
      <br><br>
    </div>
       <script type="text/javascript">
        var limita = document.querySelectorAll(".limi2")
        var otro = limita[limita.length-1]

        otro.onclick = function(){
               $('#victima_limitacion_otra').val('');
            $("#cualB17").toggle()
         }
         </script>

      <script>
         function selectOnChangeB17(sel) {
          if (sel.value=="1"){
              divC = document.getElementById("limitacionesSi");
              divC.style.display = "";}


              if (sel.value=="2"||sel.value=="3"){
                divCB17 = document.getElementById("limitacionesSi");
                divCB17.style.display = "none";
                var checkboxes = divCB17.querySelectorAll('input');


                checkboxes.forEach(function (oneCheckbox) {
                  oneCheckbox.checked = false;
                })

                document.querySelector('#cualB17').style.display = 'none';

                document.querySelector('#victima_limitacion_otra').value = '';
          }


         }

      </script>


<!-B19 Persona asistida es la víctima?->

  <div class="form-group"{{ $errors->has('persona_asistida') ? 'has-error' : ''}}>
  <label for="persona_asistida">B 19. ¿Es la persona asistida la víctima directa?:</label>
  <select class="form-control" name="persona_asistida">
      <option value="" selected=disabled>Seleccionar...</option>
          @if($persona_asistida == 1)<option value="1"selected>Sí</option>
          @else<option value="1">Sí</option>@endif

          @if($persona_asistida == 2)<option value="2"selected>No</option>
          @else<option value="2">No</option>@endif
  </select>
  {!! $errors->first('persona_asistida', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  <!-B20 Mas Personas asistidas relacionadas a la víctima?->

    <div class="form-group"{{ $errors->has('otras_personas_asistidas') ? 'has-error' : ''}}>
    <label>B 20. ¿Se asisten a mas personas relacionadas a la víctima?:</label>
    <select class="form-control" name="otras_personas_asistidas">
        <option value="" selected=disabled>Seleccionar...</option>
            @if($otras_personas_asistidas == 1)<option value="1"selected>Sí</option>
            @else<option value="1">Sí</option>@endif

            @if($otras_personas_asistidas == 2)<option value="2"selected>No</option>
            @else<option value="2">No</option>@endif
    </select>
    {!! $errors->first('otras_personas_asistidas', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>





<!BOTONES>

    <div class="botones">
    <div class="btn-1"> <button type="submit" class="btn btn-primary col-xl" name="button"  >Agregar/Enviar</button><br><br></div>
    </div>
    </form>
    </section>
 







    </body>
 </html>
