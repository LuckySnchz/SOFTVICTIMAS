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
      <title>VICTIMAS - Busqueda de caso</title>

   </head>
   <header>
      @include('navbar')
   </header>
   <body><br>

     <section class="container jumbotron shadow p-3 mb-5 bg-white rounded" >

       <div class="form-group">

<label>Buscar por Nombre de Referencia, por Nombre de la víctima o por modalidad de ingreso</label>
   	<form action="/search" method="GET">
   		{{csrf_field()}}
   		<input type="text" name="search">
   		<button type="submit" class="btn-primary" style="background-color:#97c93f;color:black;border: solid black 1px">Buscar</button>
   	</form><br>

  </div>

  <div class="form-group" id="buscador" style="margin-top:-1%;margin-left:35%">
   	<ul style="list-style: none;">

   		@foreach ($casos as $caso)
   			<li>
   				<a href="/paneldecontrol/{{$caso->id}}">
   			{{$caso->nombre_referencia}}
   				</a>
   			</li>
   		@endforeach


   	</ul>

  </div>


  </section>
   </body>
</html>
