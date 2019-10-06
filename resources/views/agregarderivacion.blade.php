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
      <title>Derivación de casos</title>
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
      <h1 class="text-center" style="padding: 15px;">Derivación:</h1>

      <section class="container jumbotron shadow p-3 mb-5 bg-white rounded">

        


         <form class="" action="/agregarderivacion" method="post">
                {{csrf_field()}}


<!-1 Fecha de ingreso->

<div class="form-group"
{{ $errors->has('fecha_ingreso') ? 'has-error' : ''}}>
<label>1. Fecha de Ingreso:</label>
<input type="date" class="form-control" name="fecha_ingreso" id="datos_fecha_ingreso" value="{{old('fecha_ingreso')}}">
{!! $errors->first('fecha_ingreso', '<p class="help-block" style="color:red";>:message</p>') !!}
</div>

<!-2 Nombre y apellido de la victima->

  <div class="form-group "{{ $errors->has('nombre_y_apellido') ? 'has-error' : ''}}>
  <label>2. Nombre y apellido de la víctima:</label>
  <input type="text" class="form-control" name="nombre_y_apellido" value="{{old('nombre_y_apellido')}}">
  {!! $errors->first('nombre_y_apellido', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

<!-3 Contacto->

  <div class="form-group "{{ $errors->has('contacto') ? 'has-error' : ''}}>
  <label for="">3. Contacto:</label>
  <input type="text" class="form-control" name="contacto" value="{{old('contacto')}}" rows="8" cols="80">
  {!! $errors->first('contacto', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

<!-4 Tipo de demanda->

           <div class="form-group " id="tipodoc" {{ $errors->has('tipo_demanda') ? 'has-error' : ''}}>
    <label>4. Tipo de demanda:</label>
<select class="form-control" name="tipo_demanda" onChange="selectOnChangeA2(this)">
              <option value="" selected=disabled>Seleccionar...</option>
              @foreach ($tipo_demandas as $demanda)
                @if(old("tipo_demanda")==$demanda->id)
                <option selected value="{{ $demanda->id }}">{{ $demanda->nombre}}</option>
              @else <option  value="{{ $demanda->id }}">{{ $demanda->nombre}}</option>
              @endif
            @endforeach
            </select>
    {!! $errors->first('tipo_demanda', '<p class="help-block" style="color:red";>:message</p>') !!}


    @if (old("tipo_demanda") == 17) <div id="cualA2" {{ $errors->has('otra_demanda') ? 'has-error' : ''}}>
    @else
    <div id="cualA2" style="display: none">
    @endif
    <label for="">Cuál?</label>
    <input name="otra_demanda"  id="otra_demanda" class="form-control" type="text" value="{{old("otra_demanda")}}">
    {!! $errors->first('otra_demanda', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>
    </div>

</div>

        <script>
           function selectOnChangeA2(sel) {
            if (sel.value=="17"){
              divC = document.getElementById("cualA2");
              divC.style.display = "";
            }else{
              divC = document.getElementById("cualA2");
              $('#otra_demanda').val('');
              divC.style.display="none";
            }
           }

        </script>


<!-5 Modalidad de ingreso->

  <div class="form-group"
  {{ $errors->has('modalidad_ingreso') ? 'has-error' : ''}}>
  <label for="modalidad_ingreso">5. Modalidad de Ingreso</label>
  <select class="form-control" name="modalidad_ingreso" id="modalidad_id" onChange="selectOnChangeA5A(this)">
            <option value="" selected=disabled>Seleccionar...</option>
            @if (old("modalidad_ingreso")==1)
              <option value="1" selected>Presentación espontánea</option>
            @else <option value="1" >Presentación espontánea</option>
            @endif

            @if (old("modalidad_ingreso")==2)
              <option value="2" selected>Intervención de oficio</option>
            @else <option value="2" >Intervención de oficio</option>
            @endif

            @if (old("modalidad_ingreso")==3)
              <option value="3" selected>Derivación de otro organismo</option>
            @else <option value="3" >Derivación de otro organismo</option>
            @endif
            @if (old("modalidad_ingreso")==4)
              <option value="4" selected>Se desconoce</option>
            @else <option value="4" >Se desconoce</option>
            @endif
  </select><br>
  {!! $errors->first('modalidad_ingreso', '<p class="help-block" style="color:red";>:message</p>') !!}

  @if(old("modalidad_ingreso") == 3) <div id="derivacion_otro_organismo_id" {{ $errors->has('organismo') ? 'has-error' : ''}}>


  @else<div class="form-group" id="derivacion_otro_organismo_id" style="display:none">
  @endif


<label>5.I Qué organismo derivó?</label>
<select class="form-control" name="organismo" id="organismo" onChange="selectOnChangeA5(this)">
        <option value="0" selected=disabled>Seleccionar...</option>
        @foreach ($organismos as $organismo)
          @if(old("organismo")==$organismo->id)
          <option selected value="{{ $organismo->id }}">{{ $organismo->nombre}}</option>
        @else <option  value="{{ $organismo->id }}">{{ $organismo->nombre}}</option>
        @endif
      @endforeach
      </select>
{!! $errors->first('organismo', '<p class="help-block" style="color:red";>:message</p>') !!}


@if (old("organismo") == 24) <div id="cualA5" {{ $errors->has('otro_organismo') ? 'has-error' : ''}}>
@else
<div id="cualA5" style="display: none">
@endif
<label for="">Cuál?</label>
<input name="otro_organismo"  id="otro_organismo" class="form-control" type="text" value="{{old("otro_organismo")}}">
{!! $errors->first('otro_organismo', '<p class="help-block" style="color:red";>:message</p>') !!}
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
          $('#otro_organismo').val('');
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
        $('#otro_organismo').val('');
        divC.style.display="none";
      }
     }

  </script>

  <!-6 Derivación->

      <div class="form-group " id="tipodoc" {{ $errors->has('derivacion') ? 'has-error' : ''}}>
      <label for="">6. Organismo al que se deriva:</label>
      <select class="form-control" name="derivacion" onChange="selectOnChangeD(this)">
        <option value="" selected=disabled>Seleccionar...</option>
        @foreach ($oderivados as $derivado)
        @if(old("derivacion")==$derivado->id)
        <option selected value="{{ $derivado->id }}">{{ $derivado->nombre}}</option>
        @else <option  value="{{ $derivado->id }}">{{ $derivado->nombre}}</option>
        @endif
        @endforeach
      </select>
      {!! $errors->first('derivacion', '<p class="help-block" style="color:red";>:message</p>') !!}


      @if (old("derivacion") == 26) <div id="cualD" {{ $errors->has('derivacion_otro') ? 'has-error' : ''}}>
      @else
      <div id="cualD" style="display: none">
      @endif
      <label for="">Cuál?</label>
      <input name="derivacion_otro"  id="derivacion_otro" class="form-control" type="text" value="{{old("derivacion_otro")}}">
      {!! $errors->first('derivacion_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
      </div>
      </div>

  </div>

          <script>
             function selectOnChangeD(sel) {
              if (sel.value=="26"){
                divC = document.getElementById("cualD");
                divC.style.display = "";
              }else{
                divC = document.getElementById("cualD");
                $('#derivacion_otro').val('');
                divC.style.display="none";
              }
             }

          </script>

<!-7 estado de la derivación->

<div class="form-group" {{ $errors->has('estado_derivacion') ? 'has-error' : ''}}>
<label>7. Estado de la derivación:</label>
 <select class="form-control" id="estado_derivacion" name="estado_derivacion">
      <option value="" selected=disabled>Seleccionar...</option>
      @if(old("estado_derivacion") == 1) <option value="1" selected>Resuelta</option>
      @else <option value="1" >Resuelta</option>@endif

      @if(old("estado_derivacion") == 2) <option value="2" selected>En proceso</option>
      @else <option value="2">En proceso</option>@endif

      @if(old("estado_derivacion") == 3) <option value="3" selected>Imposibilidad de contacto</option>
      @else <option value="3">Imposibilidad de contacto</option>@endif
</select>
{!! $errors->first('estado_derivacion', '<p class="help-block" style="color:red";>:message</p>') !!}
</div>


<!-BOTONES->
 <div class="btn-1"> <button style="width:100%" type="submit" class="btn btn-primary col-xL" name="button">Agregar/Enviar</button><br><br></div>
  </form>

  </section>
  

  </div>


  </body>
</html>
