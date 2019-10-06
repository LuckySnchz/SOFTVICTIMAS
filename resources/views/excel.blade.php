<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link href="/css/styles.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" href="css/app.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <title>App Víctimas</title>
      <style>
   .btn{margin-left: -3%}
  
      </style>
       <a name="Ancla" id="Ancla"></a>
   </head>
  <header>
      <section class="container jumbotron shadow p-3 mb-5 bg-white rounded"style="height: 150px" >
     @include('navbar')

                <a type="button"  href="/home" target="_self" style="width:100%; color:white;background-color:rgb(52, 144, 220);margin-bottom: -5%;margin-top: -12%;margin-left: 0.1%" class="btn col-XL" class="btn btn-danger">IR A INICIO</button> </a><br><br>
      </section>        
    
       <section class="container jumbotron shadow p-3 mb-5 bg-white rounded" >
         <br><br>

 <strong><h4 class="text-center" style="height: 1%;color:white;background-color: black;
        max-width: 100%">EDITAR CASO O VICTIMA</h4></strong><br><br><br>
     <a type="button"  href="/paneldecontrolcaso/{{$caso->id}}" target="_self" style="width:100%; color:white;background-color:rgb(137, 210, 14);margin-bottom: -5%;margin-top: -12%;margin-left: 0.1%;color: black" class="btn col-XL" class="btn btn-danger">IR A CASO</button> </a><br><br><br>

                <a type="button"  href="/paneldecontrolvictima/{{$caso->id}}" target="_self" style="width:100%; color:white;background-color:rgb(137, 210, 14);margin-bottom: -5%;margin-top: -12%;margin-left: 0.1%;color: black" class="btn col-XL" class="btn btn-danger">IR A VICTIMA</button> </a><br><br>
      </section> 

   </header>








   <body>

<!--



 <div class="container">

  <a href="#Ancla"><img src="{{ URL::to('/assets/img/ancla.png') }}" style="margin-left: 74%;margin-top: 24%;position: fixed;z-index: 100"></a>

         


 <div class="dropdown">
    <button type="button"  style="background-color:white;position: fixed;display: inline-block;margin-top: -3.43%;margin-left: 0.1%;width: 23%"data-toggle="dropdown">
     Menu
    </button>

    <div class="dropdown-menu">
     
    
     <ul>
         <li class="nav-item"> <strong><a class="nav-link " style="color:black;font-size:1.1em" href="#INICIO">Seleccionar Víctima</a> </li></strong>
        



            <li class="nav-item"><strong> <a class="nav-link "  style="color:black;font-size:1.1em" href="#A">Institución/Personas Asistidas</a> </li></strong>

         <li class="nav-item"><strong> <a class="nav-link "  style="color:black;font-size:1.1em" href="#AA">Profesionales Intervinientes</a> </li></strong>

        <li class="nav-item"><strong> <a class="nav-link " style="color:black;font-size:1.1em" href="#B">Víctima y su contexto</a> </li></strong>      
       
         <li class="nav-item"><strong> <a class="nav-link " style="color:black;font-size:1.1em"  href="#C">Referentes Afectivos</a> </li></strong>

         <li class="nav-item"><strong> <a class="nav-link " style="color:black;font-size:1.1em" href="#D">Imputado</a> </li></strong>

         <li class="nav-item"><strong> <a class="nav-link " style="color:black;font-size:1.1em" href="#E">Atención del Caso</a> </li></strong>

         <li class="nav-item"><strong> <a class="nav-link "style="color:black;font-size:1.1em"  href="#FIN">Documentación</a> </li></strong>

          <li class="nav-item"><strong> <a class="nav-link "style="color:black;font-size:1.1em"  href="/home">Ir a HOME</a> </li></strong>
      </ul>
    
    </div>

  </div>

   <br><br>
<div class="container jumbotron shadow p-3 mb-5 bg-white rounded" style="max-width: 100%;margin-top: -3%;">
  <a type="button" style="width:100%;margin-left: 0.2%; color:white;font-size: 1.2em;background-color: black" class="btn btn-primary col-xl"><strong>Editar Víctima/s</strong></button> </a><br><br>

<div class="container jumbotron shadow p-3 mb-5 bg-green rounded " style="max-width: 50%;margin-top: 1%;">

 
<p style="text-align: center"><strong><span style="text-decoration: underline"> Caso: 

      </spam></strong><br><strong><span style="text-align: center;color:red"<br>{{$casoNombre}}</spam></strong> 
         
         </p>
          

<p style="text-align: center"><strong><span style="text-decoration: underline"> Víctima Seleccionada: </span><strong>
 @foreach($victimas as $victima)

          @if($victima->idCaso==session("idCaso")&&$victima->id==session("idVictim"))
            <br>
          
                  <strong style="text-align: center;color:red">{{$victima->victima_nombre_y_apellido}}</strong><br>
                   <strong style="text-align: center;color:red">Edad:{{$victima->victima_edad}}</strong><br>
 <strong style="text-align: center;color:red">Delito:{{$delitoActual->nombre}}</strong><br>
  <strong style="text-align: center;color:red">Genero:</strong><br>
 @if($victima->genero == 1) Mujer Cis
    @elseif ($victima->genero == 2) Mujer Trans
    @elseif ($victima->genero == 3) Varon Cis
    @elseif ($victima->genero == 4) Varon Trans
    @elseif ($victima->genero == 5) Otro
    @endif
            
             @endif
           @endforeach</p>

</div>
<p style="text-align: center"><strong><span style="text-decoration: underline"> Agregar una Víctima: </span><strong><br><br>

          <a type="button"  href="/detalleagregarVictima" target="_self" style="width:95%;
  color:black;border: solid black 1px;background-color:grey;" class="btn btn-danger"></button> Agregar una Víctima</a><br><br>

      <h4 class="text-center" style="padding: 15px;">Selecciona una Víctima</h4>
          <ul>
            @foreach($victimas as $victima)

          @if($victima->idCaso==session("idCaso"))
                   <li>
          

  <a type="button"  href="/victima/{{$victima->id}}/{{$victima->idCaso}}" target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:grey;" class="btn btn-danger">{{$victima->victima_nombre_y_apellido}}</button> </a><br><br>  
    
            
       
                     </li>


               @endif
                 @endforeach

               </ul>

           </div>

           @foreach($victimas as $victima)
           @if($victima->idCaso==session("idCaso")&&$victima->id==session("idVictim"))

<div id="mostrar_ocultar">

@else

<div id="mostrar_ocultar" style="display: none">
  @endif

 
<div class="container jumbotron shadow p-3 mb-5 bg-white rounded" style="max-width: 100%;margin-top: 5%;text-align: center">

  <br><strong><span style="text-decoration: underline"> Víctima: </span><strong>
 @foreach($victimas as $victima)

          @if($victima->idCaso==session("idCaso")&&$victima->id==session("idVictim"))
            <br>
          
                  <strong style="text-align: center;color:red">{{$victima->victima_nombre_y_apellido}}</strong>

           @endif
           @endforeach
<br><br>
        <strong><h4 class="text-center" style="height: 1%;color:white;background-color: rgb(137, 210, 14);max-width: 100%">La victima y su contexto</h4></strong><br>
       <a name="Ancla" id="v1"></a>
<ul>
  <a type="button" href="/detalleagregarVictima" target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:grey;" class="btn btn-danger">Agregar</button> </a><br><br>

 
          
            @foreach($victimas as $victima)

          @if($victima->idCaso==session("idCaso"))
                   <li>

                  <strong style="margin-left:-15%">{{$victima->victima_nombre_y_apellido}}</strong><br>



<a type="button" href="/detalleVictima/{{$victima->id}}" target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:#ffffcc;" class="btn btn-danger">Editar</button> </a><br><br>




<a type="button" onclick="return confirm('Deseas eliminar a {{$victima->victima_nombre_y_apellido}}?')" href="/eliminarvictima/{{$victima->id}}" target="_self" style="width:100%;
  color:black;border: solid black 1px" class="btn btn-danger">Eliminar</button> </a><br><br>

  
   
                     </li>


               @endif
                 @endforeach

               </ul>
          
           </div>

 <a name="Ancla" id="v2"></a>

<div class="container jumbotron shadow p-3 mb-5 bg-white rounded" style="max-width: 100%;margin-top: 5%;text-align: center"><strong><span style="text-decoration: underline"> Víctima: </span><strong>
 @foreach($victimas as $victima)

          @if($victima->idCaso==session("idCaso")&&$victima->id==session("idVictim"))
            <br>
          
                  <strong style="text-align: center;color:red">{{$victima->victima_nombre_y_apellido}}</strong>

           @endif
           @endforeach
        
        <strong><h4 class="text-center" style="height: 1%;color:white;background-color: rgb(137, 210, 14);
        max-width: 100%">Personas Asistidas</h4></strong><br>
      


<ul style="list-style:none">
  <li>

       

        


  <a type="button"  href="/detalleagregarPersona"target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:grey;" class="btn btn-danger">Agregar</button> </a><br><br>    

   
</li></ul>

       <ul style="list-style:none">
  @foreach($personas_nuevas as $persona_nueva)
@if($persona_nueva->idVictim==session("idVictim"))

 <li>
          @foreach($personas as $persona)
          @if($persona->id==$persona_nueva->idPersona)
                 <strong > {{$persona->nombre_persona_asistida}}</strong><br>







  <a type="button" href="/detallePersona/{{$persona->id}}" target="_self" style="width:100%;color:black;border: solid black 1px;background-color:#ffffcc;" class="btn btn-danger">Editar</button> </a><br><br>


   <a type="button" onclick="return confirm('Deseas eliminar a {{$persona->nombre_persona_asistida}}?')" href="/eliminarpersona/{{$persona->id}}" target="_self" style="width:100%;color:black;border: solid black 1px" class="btn btn-danger">Eliminar</button> </a><br><br>
  

      






                  
                  @endif
                  @endforeach

          </li>
                @endif

            @endforeach
</ul>
  </div>

 



  

 <a name="Ancla" id="v3"></a>
<div class="container jumbotron shadow p-3 mb-5 bg-white rounded" style="max-width: 100%;margin-top: 5%;text-align: center">
  <br><br><strong><span style="text-decoration: underline"> Víctima: </span><strong>
 @foreach($victimas as $victima)

          @if($victima->idCaso==session("idCaso")&&$victima->id==session("idVictim"))
            <br>
          
                  <strong style="text-align: center;color:red">{{$victima->victima_nombre_y_apellido}}</strong>

           @endif
           @endforeach
<br><br>
        <strong><h4 class="text-center" style="height: 1%;margin-bottom:-5%;color:white;background-color: rgb(137, 210, 14);max-width: 100%"> Referentes Afectivos</h4></strong><br><br><br>
     
<ul style="list-style:none">
          <a type="button" href="/detalleagregarconviviente" target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:grey;" class="btn btn-danger">Agregar</button> </a><br><br>


      

  
  @foreach($convivientes_nuevos as $conviviente_nuevo)
@if($conviviente_nuevo->idVictim==session("idVictim"))

 <li>
          @foreach($convivientes as $conviviente)
          @if($conviviente->id==$conviviente_nuevo->idConviviente)
                  {{$conviviente->nombre_y_apellido}}

<br>


         <a type="button" href="/detalleconviviente/{{$conviviente->id}}" target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:#ffffcc;" class="btn btn-danger">Editar</button> </a><br><br>
     

         <a type="button" onclick="return confirm('Deseas eliminar a {{$conviviente->nombre_y_apellido}}?')" href="/eliminarconviviente/{{$conviviente->id}}" target="_self" style="width:100%;color:black;border: solid black 1px;" class="btn btn-danger">Eliminar</button> </a><br><br>


                 

                  
                  @endif
                  @endforeach

          </li>
                @endif

            @endforeach
</ul>







 
         <!-- <ul>
            @foreach($convivientes as $conviviente)

          @if($conviviente->idCaso==session("idCaso")&&$conviviente->idVictim==session("idVictim"))
                   <li>

                  <strong style="margin-left:-20%">{{$conviviente->nombre_y_apellido}}</strong>

                  <div class="botones" style="overflow:hidden;margin-left:12%">
                            <div class="btn1" style="float:left">  <input type ='button' style="width:150px;background-color:#97c93f;color:black;border: solid black 1px" class="btn btn-danger col-xs" name="button" value = 'Editar' onclick="window.open('/detalleconviviente/{{$conviviente->id}}', 'width=800,height=600');"/></button></div>
                            <div class="btn2" style="float:left"> 

<a type="button" style="width:150px; margin-left:13%;color:black;border: solid black 1px" class="btn btn-danger col-xs" href="/detalleconviviente/deleteconviviente/{{$conviviente->id}}" target="_self">Eliminar</button></a><br><br>
</div>
                            </div>
                                     </li>


                               @endif
                                 @endforeach

                               </ul>
                         
                           </div>





  <a name="Ancla" id="v4"></a>
<div class="container jumbotron shadow p-3 mb-5 bg-white rounded" style="max-width: 100%;margin-top: 5%;text-align: center"><br><br><strong><span style="text-decoration: underline"> Víctima: </span><strong>
 @foreach($victimas as $victima)

          @if($victima->idCaso==session("idCaso")&&$victima->id==session("idVictim"))
            <br>
          
                  <strong style="text-align: center;color:red">{{$victima->victima_nombre_y_apellido}}</strong>

           @endif
           @endforeach
<br><br>
        <strong><h4 class="text-center" style="height: 1%;margin-bottom:-5%;color:white;background-color: rgb(137, 210, 14);max-width: 100%">Datos del imputado</h4></strong><br><br><br>
   


<ul style="list-style:none">
<a type="button" href="/detalleagregarimputado" target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:grey;" class="btn btn-danger">Agregar</button> </a><br><br>



  <ul >
          @foreach($imputados as $imputado)

        @if($imputado->idCaso==session("idCaso")&&$imputado->idVictim==session("idVictim"))
                 <li >

                <strong style="margin-left:-15%">{{$imputado->nombre_y_apellido}}</strong>

<div class="botones" style="overflow:hidden;margin-left:14%">
          <div class="btn1" style="float:left">  <input type ='button' style="width:150px;background-color:#97c93f;color:black;border: solid black 1px" class="btn btn-danger col-xs" name="button" value = 'Editar' onclick="window.open('/detalleimputado/{{$imputado->id}}', 'width=800,height=600');"/></button></div>
<div class="btn2" style="float:left">

<a type="button" style="width:150px; margin-left:13%;color:black;border: solid black 1px" class="btn btn-danger col-xs" href="/detalleimputado/deleteimputado/{{$imputado->id}}" target="_self">Eliminar</button></a><br><br>
</div>
</div>
              </li>


        @endif
          @endforeach

        </ul>



  @foreach($imputados_nuevos as $imputado_nuevo)
@if($imputado_nuevo->idVictim==session("idVictim"))

 <li>
          @foreach($imputados as $imputado)
          @if($imputado->id==$imputado_nuevo->idImputado)
                  {{$imputado->nombre_y_apellido}}

<br>

<a type="button" href="/detalleimputado/{{$imputado->id}}" target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:#ffffcc;" class="btn btn-danger">Editar</button> </a><br><br>


<a type="button" onclick="return confirm('Deseas eliminar a {{$imputado->nombre_y_apellido}}?')" href="/eliminarimputado/{{$imputado->id}}" target="_self" style="width:100%;
  color:black;border: solid black 1px" class="btn btn-danger">Eliminar</button> </a><br><br>






                  @endif
                  @endforeach
                 

          </li>
                @endif

            @endforeach
</ul>




    </div>

     



</div>

@endforeach
 <a type="button" href="/detalleagregarVictima" target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:grey;" class="btn btn-danger">Agregar</button> </a> 
  <a name="Ancla" id="c1"></a>
<div class="container jumbotron shadow p-3 mb-5 bg-white rounded" style="max-width: 100%;margin-top: -8%;">
<br><br>
<a type="button" style="width:100%;margin-left: 0.2%; color:white;font-size: 1.2em;background-color: black" class="btn btn-primary col-xl"><strong>Editar Caso</strong></button> </a><br><br>


<div>


<strong><h4 class="text-center" style="height: 1%;color:white;background-color: rgb(137, 210, 14);
        max-width: 100%">Datos institucionales</h4></strong><br>
        <p style="text-align: center"><strong><span style="text-decoration: underline"> Caso: 
      </spam></strong><br><strong><span style="text-align: center;color:red"<br>{{$casoNombre}}</spam></strong><br>  
         
         </p><br>


<ul style="list-style:none">
  <li>

  <a type="button"  href="/detalleCaso/{{session("idCaso")}}" target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:#ffffcc;" class="btn btn-danger">Editar</button> </a><br><br>  
 </li></ul>   

<a name="Ancla" id="c2"></a>
<div class="container jumbotron shadow p-3 mb-5 bg-white rounded" style="max-width: 100%;margin-top: 5%;text-align: center">

 <strong><h4 class="text-center" style="height: 1%;color:white;background-color: rgb(137, 210, 14);
        max-width: 100%">Profesional interviniente</h4></strong><br>
   


    <p style="text-align: center"><strong><span style="text-decoration: underline"> Caso: 
      </spam></strong><br><strong><span style="text-align: center;color:red"<br>{{$casoNombre}}</spam></strong><br>  
         
         </p><br>


<ul>
  <a type="button" href="/detalleagregarProfesional"target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:grey;" class="btn btn-danger">Agregar</button> </a><br><br> 



       
         @foreach($profesionales as $profesional)  


 @if($profesional->idCaso==session("idCaso"))
                <li >

@if($profesional->nombre_profesional_interviniente==0)

{{$profesional->nombre_profesional_interviniente_otro}}
@endif
               @foreach ($usuarios as $usuario)
            
              @if($usuario->id==$profesional->nombre_profesional_interviniente)
                            <strong style="text-align: center">{{$usuario->nombre_y_apellido}}</strong><br>
              
   
             @endif
            @endforeach
            

   <a type="button"  href="/detalleProfesional/{{$profesional->id}} target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:#ffffcc;" class="btn btn-danger">Editar</button> </a><br><br> 


 <a type="button" onclick="return confirm('Deseas eliminar a este Profesional?')"  href="/detalleProfesional/deleteProfesional/{{$profesional->id}}" target="_self" style="width:100%;
  color:black;border: solid black 1px;" class="btn btn-danger">Eliminar</button> </a><br><br>





             </li>


       @endif

         @endforeach

       </ul>



   </div>
<a name="Ancla" id="c3"></a>
<div class="container jumbotron shadow p-3 mb-5 bg-white rounded" style="max-width: 100%;margin-top: 5%;text-align: center">
       <br><br>
        <strong><h4 class="text-center" style="height: 1%;margin-bottom:-5%;color:white;background-color: rgb(137, 210, 14);max-width: 100%">Atención del caso</h4></strong><br><br><br>
        <p style="text-align: center"><strong><span style="text-decoration: underline"> Caso: 
      </spam></strong><br><strong><span style="text-align: center;color:red"<br>{{$casoNombre}}</spam></strong><br>  
         
         </p><br>
      

    <ul><li>  
  @if($instituciocount==0)

  <a type="button" href="/agregarOrganismo" target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:grey;" class="btn btn-danger">Agregar</button> </a><br><br>

@endif
  @if($instituciocount>0)
  @foreach($instituciones as $institucion)
    @if($institucion->idCaso==session("idCaso"))
 
   @endif          
@endforeach


 <a type="button" href="/detalleOrganismo/{{$institucion->id}}" target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:#ffffcc;" class="btn btn-danger">Editar</button> </a><br><br>



  
 @endif 

      
</li></ul>


             
      
 
  
                  
<br><br>

 




 <a name="Ancla" id="c4"></a>
        <strong><h4 class="text-center" style="height: 1%;margin-bottom:-5%;color:white;background-color: rgb(137, 210, 14)">Documentación</h4></strong><br><br><br>
        <p style="text-align: center"><strong><span style="text-decoration: underline"> Caso: 
      </spam></strong><br><strong><span style="text-align: center;color:red"<br>{{$casoNombre}}</spam></strong><br>  
         
         </p><br>
         <ul >

 <a type="button" href="/detalleagregarDocumento" target="_self" style="width:100%;
  color:black;border: solid black 1px;background-color:grey;" class="btn btn-danger">Agregar</button> </a><br><br>





  

  @foreach($documentos as $documento)
  @if($documento->IdCaso==session("idCaso"))

<li>
  <strong >{{$documento->nombre_documento}}</strong><br><br>

   <a type="button" onclick="return confirm('Deseas eliminar a {{$documento->nombre_documento}}?')" href="/eliminardocumento/{{$documento->id}}" target="_self" style="width:100%;
  color:black;border: solid black 1px;" class="btn btn-danger">Eliminar</button> </a><br><br>         
    
  



     


              </li>

    @endif
          @endforeach
        </ul>




</div>



<br><br><br>
</div>






</div>
-->
   </body>

</html>
