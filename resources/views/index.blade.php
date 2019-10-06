<?php ?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="/css/styles.css" rel="stylesheet">
		  <link rel="stylesheet" href="ionicons/css/ionicons.min.css">


		<title>Working Group</title>
	</head>
	<body>
		<div class="container">
			<div class="card">
				<div class="card-image">

					<ul class="social-media">
						<li><a href="#"><class="ion-social-facebook"></a><i class="icon ion-social-facebook"></i></li>
						<li><a href="#"><span class="ion-social-twitter"></span></a><i class="icon ion-social-twitter"></i></li>
						<li><a href="#"><span class="ion-social-linkedin"></a></span><i class="icon ion-social-linkedin"></i></li>
					</ul>
				</div>
				<div class="card-data">
					<h2>Jane Doe</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque quam,<br>
						 eum laudantium at? Magni facere cum rem accusantium quod repellendus au<br>
						 t assumanda fugiat iste. Velit nam, ex tempora sequi nesciunt!</p><br>
					<a href="#">Ver más</a>
				</div>
			</div>

			<div class="card">
				<div class="card-image">

					<ul class="social-media">
						<li><a href="#"><class="ion-social-facebook"></a><i class="icon ion-social-facebook"></i></li>
						<li><a href="#"><span class="ion-social-twitter"></span></a><i class="icon ion-social-twitter"></i></li>
						<li><a href="#"><span class="ion-social-linkedin"></a></span><i class="icon ion-social-linkedin"></i></li>
					</ul>
				</div>
				<div class="card-data">
					<h2>Jhon Doe</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque quam,<br>
						 eum laudantium at? Magni facere cum rem accusantium quod repellendus au<br>
						 t assumanda fugiat iste. Velit nam, ex tempora sequi nesciunt!</p><br>
					<a href="#">Ver más</a>
				</div>
			</div>

			<div class="card">
				<div class="card-image">

					<ul class="social-media">
						<li><a href="#"><class="ion-social-facebook"></a><i class="icon ion-social-facebook"></i></li>
						<li><a href="#"><span class="ion-social-twitter"></span></a><i class="icon ion-social-twitter"></i></li>
						<li><a href="#"><span class="ion-social-linkedin"></a></span><i class="icon ion-social-linkedin"></i></li>
					</ul>
				</div>
				<div class="card-data">
					<h2>Jane Doe</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque quam,<br>
						 eum laudantium at? Magni facere cum rem accusantium quod repellendus au<br>
						 t assumanda fugiat iste. Velit nam, ex tempora sequi nesciunt!</p><br>
					<a href="#">Ver más</a>
				</div>
			</div>

			<div class="card">
				<div class="card-image">

					<ul class="social-media">
						<li><a href="#"><class="ion-social-facebook"></a><i class="icon ion-social-facebook"></i></li>
						<li><a href="#"><span class="ion-social-twitter"></span></a><i class="icon ion-social-twitter"></i></li>
						<li><a href="#"><span class="ion-social-linkedin"></a></span><i class="icon ion-social-linkedin"></i></li>
					</ul>
				</div>
				<div class="card-data">
					<h2>Jhon Doe</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque quam,<br>
						 eum laudantium at? Magni facere cum rem accusantium quod repellendus au<br>
						 t assumanda fugiat iste. Velit nam, ex tempora sequi nesciunt!</p><br>
					<a href="#">Ver más</a>
				</div>
			</div>

			<div class="card">
				<div class="card-image">

					<ul class="social-media">
						<li><a href="#"><span class="ion-social-facebook"></span></a><i class="icon ion-social-facebook"></i></li>
						<li><a href="#"><span class="ion-social-twitter"></span></a><i class="icon ion-social-twitter"></i></li>
						<li><a href="#"><span class="ion-social-linkedin"></a></span><i class="icon ion-social-linkedin"></i></li>
					</ul>
				</div>
				<div class="card-data">
					<h2>Jane Doe</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque quam,<br>
						 eum laudantium at? Magni facere cum rem accusantium quod repellendus au<br>
						 t assumanda fugiat iste. Velit nam, ex tempora sequi nesciunt!</p>
					<a href="#">Ver más</a>
				</div>
			</div>

			<div class="card">
				<div class="card-image">
					<h4 class="text-center" style="padding: 15px;">Eje A: Datos institucionales</h4>
		         <h4 class="text-center" style="padding: 15px;">Personas Asistidas</h4>

		 <input type ='button' style="width:317px;background-color:grey;margin-left:39%" class="btn btn-danger col-xs" name="button" value = 'Agregar' onclick="window.open('detalleagregarPersona')"/></button>
		     <h5 class="text-center" style="padding: 15px;">
		       <ul>
		         @foreach($personas as $persona)

		       @if($persona->idCaso==session("idCaso"))
		                <li>

		               <strong>{{$persona->nombre_persona_asistida}}</strong>

		 <div class="botones" style="overflow:hidden;margin-left:37%">
		         <div class="btn1" style="float:left">  <input type ='button' style="width:150px;background-color:green" class="btn btn-danger col-xs" name="button" value = 'Editar' onclick="window.open('detallePersona/{{$persona->id}}', 'width=800,height=600');"/></button></div>
		 <div class="btn2" style="float:left">   <input type ='button' style="width:150px; margin-left:13%" class="btn btn-danger col-xs" name="button" value = 'Eliminar' onclick="window.open('detallePersona/deletepersona/{{$persona->id}}', 'width=800,height=600');"/></button></div>
		 </div>
		             </li>


		       @endif
		         @endforeach

		       </ul>
		     </h5>


				</div>
				<div class="card-data">

				</div>
			</div>



		</div>
	</body>
</html>
