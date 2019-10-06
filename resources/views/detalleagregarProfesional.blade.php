
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" href="css/app.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
    <h2 class="text-center" style="padding: -30px;">Profesional interviniente</h2><br>

    <section class="container jumbotron shadow p-3 mb-5 bg-white rounded">
<!Listado profesionales>

    <div class="form-group">
    <ul>
      
      @foreach($profesionales as $profesional)
        @if($profesional->idCaso==session("idCaso") && ($profesional->nombre_profesional_interviniente > 0))
        
        <li>

            {{$profesional->usuario->nombre_y_apellido }}
     
        </li>
        @endif

         @if($profesional->idCaso==session("idCaso") && ($profesional->nombre_profesional_interviniente == 0))
        
        <li>

            {{$profesional->nombre_profesional_interviniente_otro }}
     
        </li>
        @endif
      @endforeach

    </ul>
    </div>

 

      <form class="" action="/detalleagregarProfesional" method="post" onsubmit='return validar()'>
      {{csrf_field()}}
      <input type="hidden" name="idCaso" value="{{session("idCaso")}}">

<!A16 Profesional interviniente>

   
    <div class="form-group" id="prof"{{ $errors->has('nombre_profesional_interviniente') ? 'has-error' : ''}}>
    <label>A 16 Profesional Interviniente:</label>
    <select class="form-control" name="nombre_profesional_interviniente" id="nombre_profesional_interviniente">
      <option value="" selected="disabled">Seleccionar...</option>
    
  
  
    @if( $countprofsinter>0)

    @foreach($usuarios as $usuario)  
  @foreach($array2 as $ar2)
  @if($usuario->id==$ar2)
    
        @if($ar2== old('nombre_profesional_interviniente'))
                 <option selected value="{{$ar2}}">{{ $usuario->nombre_y_apellido}}</option>
         @else
                 <option value="{{$ar2}}">{{ $usuario->nombre_y_apellido}}</option>
                 @endif
   @endif
   @endforeach
 @endforeach

 @else

 @foreach($usuarios as $usuario)
@if($usuario== old('nombre_profesional_interviniente'))
                 <option selected value="{{$usuario->id}}">{{ $usuario->nombre_y_apellido}}</option>
         @else
                 <option value="{{$usuario->id}}">{{ $usuario->nombre_y_apellido}}</option>
                 @endif
@endforeach
@endif
    </select>
    {!! $errors->first('nombre_profesional_interviniente', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>







<!A16I Interviene desde>

    <div class="form-group"{{ $errors->has('desde_profesional_interviniente') ? 'has-error' : ''}}>
    <label for="">A 16I Interviene desde:</label>
    <input type="date" class="form-control" name="desde_profesional_interviniente" id="datos_profesional_interviene_desde" value="{{old("desde_profesional_interviniente")}}">
    {!! $errors->first('desde_profesional_interviniente', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>

<!A16II Actualmente interviniente>

    <div class="form-group"{{ $errors->has('actual_profesional_interviniente') ? 'has-error' : ''}}>
    <label for="profesionalactualmente_id">A 16II Actualmente Interviene:</label>
    <select class="form-control" name="actual_profesional_interviniente" onChange="selectOnChangeA15(this)" value="{{old("actual_profesional_interviniente")}}">
        <option value="" selected=disabled>Seleccionar...</option>
        @if(old("actual_profesional_interviniente") == 1)<option value="1" selected>Si</option>
        @else<option value="1">Si</option>@endif
        @if(old("actual_profesional_interviniente") == 2)<option value="2" selected>No</option>@else <option value="2">No</option>@endif
    </select>
    {!! $errors->first('actual_profesional_interviniente', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>

    @if(old("actual_profesional_interviniente") == 2)
      <div id="no">
      @else
    <div id="no" style="display: none">
    @endif

    <div class="form-group"{{ $errors->has('hasta_profesional_interviniente') ? 'has-error' : ''}}>
    <label for="hasta_profesional_interviniente">A 16III Interviene hasta:</label>
    <input type="date" class="form-control" name="hasta_profesional_interviniente" id="datos_profesional_interviene_desde" value="{{old("hasta_profesional_interviniente")}}">
    {!! $errors->first('hasta_profesional_interviniente', '<p class="help-block" style="color:red";>:message</p>') !!}
    </div>
    </div>
<div id ="newprof"class="form-group"{{ $errors->has('nuevo_profesional_si') ? 'has-error' : ''}}>
    <label for="">A 16 Desea agregar un nuevo profesional?:</label>
    <select class="form-control" name="nuevo_profesional" id="nuevo_profesional" onChange="selectOnChangeA16I(this)" value="{{old("nuevo_profesional")}}">
        <option value="" selected=disabled>Seleccionar...</option>
        @if(old("nuevo_profesional") == 1)<option value="1" selected>Si</option>
        @else<option value="1">Si</option>@endif
        @if(old("nuevo_profesional") == 2)<option value="2" selected>No</option>@else <option value="2"  >No</option>@endif
    </select>
    {!! $errors->first('nuevo_profesional_si', '<p class="help-block" style="color:red";>:message</p>') !!}



@if (old("nuevo_profesional")==1)
  <div id="cualprof"  {{ $errors->has('nombre_profesional_interviniente_otro') ? 'has-error' : ''}}>
     
@else
<div id="cualprof" style="display:none"  >
@endif
  <label for="nombre_profesional_interviniente_otro"> Profesional Interviniente- Profesión:</label>
  <input class="form-control" name="nombre_profesional_interviniente_otro" type="text" id="nombre_profesional_interviniente_otro" value="{{old('nombre_profesional_interviniente_otro')}}" >
  {!! $errors->first('nombre_profesional_interviniente_otro', '<p class="help-block" style="color:red";>:message</p>') !!}
  </div>

</div>

<script>
   document.querySelector("#nombre_profesional_interviniente").onchange = function() {
    
        $('#nuevo_profesional').val('2');
 $('#nombre_profesional_interviniente_otro').val('');
          divCp = document.getElementById("newprof");
          divCp.style.display = "none";}
</script>





 <script>
     function selectOnChangeA16I(sel) {
      if (sel.value==1){
        $('#nombre_profesional_interviniente').val('');

         divCp = document.getElementById("prof");
          divCp.style.display = "none";

          divCp = document.getElementById("cualprof");
          divCp.style.display = "";

        }
          else{divCp= document.getElementById("cualprof");
          divCp.style.display = "none";
          $('#nombre_profesional_interviniente_otro').val('');
          
              divCp = document.getElementById("prof");
          divCp.style.display = "";}

       
        }
        </script>
<script type='text/javascript'>
  
  function validar(){


var todo_correcto = true;


if((document.getElementById('nombre_profesional_interviniente_otro').value.length < 2 )&&
(document.getElementById("nuevo_profesional").value==1) ){
    todo_correcto = false;

}



if(!todo_correcto){
alert('Debes agregar un nuevo profesional');
}

return todo_correcto;
}

</script>


<!BOTONES>

  <div class="botones" >
  <div class="btn-1" > <button class="btn btn-primary col-xl" name="button" style="width:108%" >Agregar/Enviar</button><br><br></div>
  </div>

  </form>
  </section>



  


      <script>

         function selectOnChange1(sel) {
             if (sel.value=="2"){
                 divC = document.getElementById("no");
                 divC.style.display = "";
             }else{
                 divC = document.getElementById("no");
                 $('#datos_profesional_interviene_hasta').val('');
                 divC.style.display="none";
             }
         }
      </script>
      <script>
         function muestroCualA2() {
             var checkBox = document.getElementById("checkeado");
             var text = document.getElementById("cualA2");
             if (checkBox.checked == true){
                 text.style.display = "block";
             } else {
               $('#tipos_delitos_otro_cual').val('');
                text.style.display = "none";
             }
         }
      </script>
      <script>
         function selectOnChangeA5bis(sel) {
         if (sel.value=="14"){
         divC = document.getElementById("cualA5");
         divC.style.display = "";}
         else{
         divC = document.getElementById("cualA5");
         $('#derivacion_otro_organismo_cual').val('');

         divC.style.display = "none";}
         }
      </script>
      <script>
         function selectOnChangeA5(sel) {
           if (sel.value=="1"||sel.value=="2"){
                divC = document.getElementById("derivacion_otro_organismo_id");
                $('#otro_organismo').val(' ');
                divC.style.display = "none";}


           if (sel.value=="3"){
                divC = document.getElementById("derivacion_otro_organismo_id");
                divC.style.display = "";

         }}
      </script>
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
           if (sel.value=="4"){
             divC = document.getElementById("cualA12");
             divC.style.display = "";}
             else{
                divC = document.getElementById("cualA12");
                $('#motivo_pase_pasivo_cual').val('');

                divC.style.display = "none";}
         }
      </script>
      <script>
         function selectOnChangeA14(sel) {
           if (sel.value=="2"){
             divC = document.getElementById("personas_asistidas");
             divC.style.display = "";}
             else{
                divC = document.getElementById("personas_asistidas");
                $('#Nombre_apellido_persona_asistida').val('');
                $('#vinculo_victima').val('');
                $('#vinculo_victima_cual_otro').val('');
                $('#telefono_contacto').val('');
                $('#domicilio_contacto').val('');
                $('#localidad_residencia').val('');
                divC.style.display = "none";}
         }
      </script>
      <script>
         function selectOnChangeA14II(sel) {
           if (sel.value=="4"){
             divC = document.getElementById("vinculo_victima_cual");
             divC.style.display = "";}
             else{
                divC = document.getElementById("vinculo_victima_cual");
                $('#vinculo_victima_cual_otro').val('');

                divC.style.display = "none";}
         }
      </script>
      <script>
         function selectOnChangeA15(sel) {
           if (sel.value=="2"){
             divC = document.getElementById("no");
             divC.style.display = "";}
             else{
                divC = document.getElementById("no");
                $('#no').val('');

                divC.style.display = "none";}
         }
      </script>

   </body>
</html>
