
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
      <title>Eje C: Referentes Afectivos</title>
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

    <section class="container jumbotron shadow p-3 mb-5 bg-white rounded" >
  <div class="divpersona" id="divpersona"> 
   <h2 class="text-center" style="padding: -20px;">Eje D: Referentes Afectivos</h2>
   <h5 class="text-center" style="padding: -20px;">


      <label class="font-weight-bold">Caso: </label>
    {{$casoActual->nombre_referencia}}<br>


    <label class="font-weight-bold">Victima: </label>
  {{$victimActual->victima_nombre_y_apellido}}</h5></div>



  <div class=""  style="margin-left: 38.5%">
  <label class="font-weight-bold" style="color:red">Referentes Afectivos para esta víctima: </label>
  <ul style="list-style:none">
  @foreach($convivientes_nuevos as $conviviente_nuevo)
@if($conviviente_nuevo->idVictim==session("idVictim"))

 <li style="margin-left: 2%">
          @foreach($convivientes as $conviviente)
          @if($conviviente->id==$conviviente_nuevo->idConviviente)
                  {{$conviviente->nombre_y_apellido}}

                  @endif
                  @endforeach

          </li>
                @endif

            @endforeach
</ul>

    </div>

    <section class="container jumbotron shadow p-3 mb-5 bg-white rounded" >

      <!Listado Referentes afectivos>

 @if($cantVictimas>1)
 <div class="flex-container" style="display: flex;
  flex-direction: column;
 ">
  <label style="margin-left: 39.5%" class="font-weight-bold">Referentes Afectivo en este Caso: </label>
<ul style="list-style:none">
      @foreach($convivientes as $conviviente)
        @if ($conviviente->idCaso == session("idCaso"))
        <div style="text-align: center">
          <li style="margin-left: -5%">
            {{$conviviente->nombre_y_apellido}}<br>

    <a type="button" href="/detalleconvivientevinculo/{{$conviviente->id}}" target="_self" style="width:250px;
  color:black;border: solid black 1px;background-color:#ffffcc;" class="btn btn-danger">Agregar Referente Afectivo</button> </a><br><br>
     



          </li>
        </div>
  
        @endif
      @endforeach
  </ul>

@else
<div id="listado" style="display: none">
  @endif
</div>
</div>






    <div class="form-group">

      <form class="ejeC" action="/agregarconviviente" method="post">
      {{ csrf_field() }}
      <div class="form-group">
      <input type="hidden" name="idCaso" value="{{session("idCaso")}}">
      <input type="hidden" name="idVictim" value="{{session("idVictim")}}">
      <input type="hidden" name="cantVictimas" value="{{$cantVictimas}}">


</div>

    @if($cantVictimas>1)
 <div id="agregar"class="form-group"  {{ $errors->has('agregar_conviviente') ? 'has-error' : ''}}>
      <label for="agregar_conviviente">Desea agregar un nuevo referente afectivo? </label>
      <select class="form-control" name="agregar_conviviente" id="agregar_conviviente" onChange="selectOnChangeA14I(this)">
            <option value="" selected=disabled>Seleccionar...</option>
              @if(old("agregar_conviviente")==1)
              <option value="1" selected >Sí</option>
              @else <option value="1">Sí</option>@endif

              @if(old("agregar_conviviente")==2)
              <option value="2" selected >No</option>
              @else  <option value="2" >No</option>@endif
              </select>
              {!! $errors->first('agregar_conviviente', '<p class="help-block" style="color:red";>:message</p>') !!}

      @else
 <div id="agregar"class="form-group" style="display: none">
  @endif
</div></div>

      @if(old("agregar_conviviente") == 1||$cantVictimas==1)
        <div id="agregar_conviviente_si" {{ $errors->has('agregar_conviviente_si') ? 'has-error' : ''}}>
        @else
          <div id="agregar_conviviente_si" style="display: none;">
      @endif

<!C1 Conviviente Nombre y Apellido>

    <div class="form-group" {{ $errors->has('nombre_y_apellido') ? 'has-error' : ''}}>
    <label for="">D 1. Nombre y apellido:</label>
    <input type="text" class="form-control" name="nombre_y_apellido" id="victima_nombre_y_apellido" value="{{old("nombre_y_apellido")}}">
    <label for="bloqueo1" class="form-check-label">Se desconoce</label>
    <input type="checkbox" id="bloqueo1" name="nombre_y_apellido" value="Se desconoce" onchange="checkC1(this)">
    {!! $errors->first('nombre_y_apellido', '<p class="help-block" style="color:red";>:message</p>') !!}
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

<!C2 Edad>

  <div class="form-group"{{ $errors->has('edad') ? 'has-error' : ''}}>
      <label for="edad">D 2. Edad:</label>
    <input name="edad" value="{{old('edad')}}"   id="edad_conviviente" class="form-control" type="text"><br>

    @if(old('edad')=="0")


    <label class="form-check-label" for="edad">Se desconoce</label>
    <input name="edad" value="0" id="edad_conviviente" type="checkbox" checked onchange="checkC2(this)">
    @else
    <label class="form-check-label" for="edad">Se desconoce</label>
    <input name="edad" value="0" id="edad_conviviente" type="checkbox" onchange="checkC2(this)">
  @endif

    {!! $errors->first('edad', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>


</script>

<script type="text/javascript">
       function checkC2(checkbox) {
          if (checkbox.checked)
                {
                    $('#edad_conviviente').val('Se Desconoce');
                    document.getElementById('edad_conviviente').setAttribute("readonly","readonly");
                    divAY= document.getElementById("edad_conviviente").disabled=true;

           }
           else{
                    $('#edad_conviviente').val('');

                    document.getElementById('edad_conviviente').removeAttribute("readonly");
                  divA = document.getElementById("edad_conviviente").disabled=false;

           }}
    </script>

<!C3 Vinculo>

  <div class="form-group" {{ $errors->has('vinculo_victima') ? 'has-error' : ''}}>
  <label for="vinculo_id">D 3. Vinculación con la víctima:</label>
  <select name="vinculo_victima"value="{{old("vinculo_victima")}}" class="form-control vinculo" onChange="selectOnChangeC5(this)">
        <option value="" selected=disabled>Seleccionar...</option>
        @if(old("vinculo_victima")==1)
        <option value="1" selected>Familiar</option>
        @else <option value="1">Familiar</option> @endif

        @if(old("vinculo_victima")==2)
        <option value="2"selected>Pareja</option>
        @else<option value="2" >Pareja</option>@endif

        @if(old("vinculo_victima")==3)
        <option value="3"selected>Amistad</option>
        @else <option value="3" >Amistad</option>@endif

        @if(old("vinculo_victima")==4)
        <option value="4"selected>Conocido</option>
        @else<option value="4" >Conocido</option> @endif

        @if(old("vinculo_victima")==5)
        <option value="5"selected>Se desconoce</option>
        @else<option value="5" >Se desconoce</option>@endif

        @if(old("vinculo_victima")==6)
        <option value="6"selected>Otro</option>
        @else  <option value="6" >Otro</option>@endif
  </select>
  {!! $errors->first('vinculo_victima', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  @if(old("vinculo_victima") == 6)
    <div id="cualC5" {{ $errors->has('vinculo_otro') ? 'has-error' : ''}}>
  @else
    <div id="cualC5" style="display: none">
  @endif

  <label for="vinculo_otro">Cuál?</label>
  <input type="text" class="form-control vinculo_otro" name="vinculo_otro" value="{{old("vinculo_otro")}}"id="vinculo_otro">
  {!! $errors->first('vinculo_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

  <br>
  <script>
          function selectOnChangeC5(sel) {
     							 if (sel.value=="6"){
     									 divC = document.getElementById("cualC5");
     									 divC.style.display = "";
     							 }else{
     									 divC = document.getElementById("cualC5");
     									 $('#vinculo_otro').val('');
     									 divC.style.display="none";
     							 }}
        </script>

<!C4 Nivel educativo>

  <div class="form-group" {{ $errors->has('niveleducativo_id') ? 'has-error' : ''}}>
  <label for="">D 4. Máximo nivel educativo alcanzado:</label>
  <select class="form-control" name="niveleducativo_id" value="{{old("niveleducativo_id")}}">
      <option value="" selected=disabled>Seleccionar...</option>
      @if(old("niveleducativo_id") == 1) <option value="1" selected>Sin instrucción formal</option>
      @else <option value="1" >Sin instrucción formal</option>@endif

      @if(old("niveleducativo_id") == 2) <option value="2" selected>Primario incompleto</option>
      @else <option value="2" >Primario incompleto</option>@endif

      @if(old("niveleducativo_id") == 3) <option value="3" selected>Primario completo</option>
      @else <option value="3" >Primario completo</option>@endif

      @if(old("niveleducativo_id") == 4) <option value="4" selected>Secundario incompleto</option>
      @else <option value="4" >Secundario incompleto</option>@endif

      @if(old("niveleducativo_id") == 5) <option value="5" selected>Secundario completo</option>
      @else <option value="5" >Secundario completo</option>@endif

      @if(old("niveleducativo_id") == 6) <option value="6" selected>Terciario-Universitario incompleto</option>
      @else <option value="6" >Terciario-Universitario incompleto</option>@endif

      @if(old("niveleducativo_id") == 7) <option value="7" selected>Terciario-Universitario completo</option>
      @else <option value="7" >Terciario-Universitario completo</option>@endif

      @if(old("niveleducativo_id") == 8) <option value="8" selected>Se desconoce</option>
      @else <option value="8" >Se desconoce</option>@endif
  </select>
  {!! $errors->first('niveleducativo_id', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>


<!C5 Condiciones de trabajo>

  <div class="form-group" {{ $errors->has('condiciones_de_trabajo') ? 'has-error' : ''}}>
  <label for="modalidad_id">D 5.Condiciones de trabajo:</label>
  <select class="form-control" name="condiciones_de_trabajo" value="{{old("condiciones_de_trabajo")}}"  id="condiciones_de_trabajo" >
      <option value="" selected=disabled>Seleccionar...</option>
      @if(old("condiciones_de_trabajo") == 1) <option value="1" selected>Desocupado(a)</option>
      @else <option value="1" >Desocupado(a)</option>@endif

      @if(old("condiciones_de_trabajo") == 2) <option value="2" selected>Empleo informal</option>
      @else <option value="2" >Empleo informal</option>@endif

      @if(old("condiciones_de_trabajo") == 3) <option value="3" selected>Empleo formal</option>
      @else <option value="3" >Empleo formal</option>@endif

      @if(old("condiciones_de_trabajo") == 4) <option value="4" selected>Población Inactiva (jubilados, menores de edad, pensionados, etc.)</option>
      @else <option value="4" >Población Inactiva (jubilados, menores de edad, pensionados, etc.)</option>@endif

      @if(old("condiciones_de_trabajo") == 5) <option value="5" selected>Se desconoce</option>
      @else <option value="5" >Se desconoce</option>@endif
  </select>
  {!! $errors->first('condiciones_de_trabajo', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>
      </div>
      </div>

<!BOTONES>

  <div class="btn-1"> <button class="btn btn-primary col-xl" type="submit" >Agregar/Enviar</button><br><br></div>
  </div>
  </form>
   
 <a type="button" href="/agregarimputado" target="_self" style="width:100%; color:white;background-color:rgb(137, 210, 14)" class="btn col-XL" class="btn btn-danger">SIGUIENTE</button> </a><br><br>
  </section>




<script>
         function selectOnChangeA14I(sel) {

           if (sel.value=="1"){
             divC = document.getElementById("agregar_conviviente_si");
             divC.style.display = "";}
             else{
                divC = document.getElementById("agregar_conviviente_si");

                divC.style.display = "none";}
          }

</script>
  </body>
</html>
