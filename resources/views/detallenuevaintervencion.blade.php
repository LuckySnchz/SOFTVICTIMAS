

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" href="css/app.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <title>Eje F: Informe de seguimiento</title>
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

    <h1 class="text-center" style="padding: 15px;">Eje G: Informe de seguimiento</h1>

    <div class="divpersona" id="divpersona">  <h2 class="text-center" style="padding: -20px;"></h2></div>

    <section class="container" >

    <form class="" action="/detallenuevaintervencion" method="post">
      {{csrf_field()}}
    <input type="hidden" name="idCaso" value="{{session("idCaso")}}">




    <div class="form-group" {{ $errors->has('fecha_intervencion') ? 'has-error' : ''}}>
      <label>Fecha intervención: </label>
      <input type="date" name="fecha_intervencion" class="form-control" value="{{$fecha_intervencion}}">
      {!! $errors->first('fecha_intervencion', '<p class="help-block" style="color:red";>:message</p>') !!}
      </div>    

      <div class="form-group" {{ $errors->has('detalle_intervencion') ? 'has-error' : ''}}">
        <label for="detalle_intervencion">Detalle intervención:</label>

<textarea class="form-control" id="detalle_intervencion" name="detalle_intervencion">{{$detalle_intervencion}}</textarea><br>
 {!! $errors->first('detalle_intervencion', '<p class="help-block" style="color:red";>:message</p>') !!}
        
      
      <div id="botones" >
  <div class="btn-1" > <button class="btn btn-primary col-xl" name="button"  style="width:108%" >Agregar/Enviar</button><br><br><br><br>
</div>
  </div>
   

 

<!BOTONES>

  
      </form>
</section>



<script>
         function checkC1(checkbox)
         {
             if (checkbox.checked){
              divC = document.getElementById("agregar_intervencion_si");
              
              divC.style.display = "";

            }else{
              divC = document.getElementById("agregar_intervencion_si");
     
              divC.style.display="none";
            }
         }
      </script>








 
<!-- <script>
           function selectOnChangeA5A(sel) {


            if (sel.value=="1"){
              divC = document.getElementById("agregar_intervencion_si");
              
              divC.style.display = "";
            }else{
              divC = document.getElementById("agregar_intervencion_si");
     
              divC.style.display="none";
            }
           }

        </script>-->



      </body>
</html>


