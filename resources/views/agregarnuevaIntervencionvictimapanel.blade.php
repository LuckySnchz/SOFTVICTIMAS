

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

   
   <body>

    

    <div class="divpersona" id="divpersona">  <h2 class="text-center" style="padding: -20px;"></h2></div>

<div  class="container jumbotron shadow p-3 mb-5 bg-white rounded">
  <h1 class="text-center" style="padding: 15px;">Intervenciones</h1>
    <section class="container" >

    <form class="" action="/agregarnuevaIntervencionvictimapanel" method="post">
      {{csrf_field()}}
    <input type="hidden" name="idCaso" value="{{session("idCaso")}}">
       <input type="hidden" name="idVictim" value="{{session("idVictim")}}">





<!-MOSTRAR INTERVENCIONES CORRESPONDIENTES A ESTA VICTIMA>



<div>

 @foreach($intervenciones as $intervencion)
     @if ($intervencion->idCaso == session("idCaso"))
       <li style="list-style: none">

 <strong><label for="detalle_intervencion">Víctima:</label></strong> 
 @foreach($victimas as $victima)
 @if($victima->id==$intervencion->idVictim)
{{$victima->victima_nombre_y_apellido}}
@endif
@endforeach

  <input type="date" class="form-control" id="victima_fecha_nacimiento" disabled name="victima_fecha_nacimiento" value="{{$intervencion->fecha_intervencion}}"><br>

 <textarea class="form-control" disabled > {{$intervencion->detalle_intervencion}}</textarea>
         
   <strong> <a  style="color:black; margin-left: 45%" href="/detallenuevaintervencion/{{$intervencion->id}}" target="_self">Editar</a></strong>         
 <strong> <a  style="color:red"  onclick="return confirm('Deseas eliminar esta Intercención?')" href="/eliminarnuevaintervencion/{{$intervencion->id}}" target="_self">Eliminar</a></strong>
  

       </li>
     @endif
 @endforeach

</div>


</div>

</div>
 <!-VICTIMA SELECCIONADA>

@foreach($victimas as $victima)

 @if($victima->idCaso==session("idCaso")&&$victima->id==session("idVictim"))
<div  class="container jumbotron shadow p-3 mb-5 bg-white rounded">
   <a name="Ancla" id="victima"></a>
 
  <strong> <label style="text-decoration: underline;margin-left: 40%;color: red">Víctima: </label></strong>


 @foreach($victimas as $victima)

          @if($victima->id==session("idVictim"))
  <strong style="color:red"> {{$victima->victima_nombre_y_apellido}}</strong>

@endif
@endforeach

    <div class="form-group" {{ $errors->has('fecha_intervencion') ? 'has-error' : ''}}>
     <strong> <label>Fecha intervención: </label></strong>
      <input type="date" name="fecha_intervencion" class="form-control" value="{{old("fecha_intervencion")}}">
      {!! $errors->first('fecha_intervencion', '<p class="help-block" style="color:red";>:message</p>') !!}
      </div>    

      <div class="form-group" {{ $errors->has('detalle_intervencion') ? 'has-error' : ''}}">
       <strong><label for="detalle_intervencion">Detalle intervención:</label></strong> 

<textarea class="form-control" id="detalle_intervencion" name="detalle_intervencion">{{old('detalle_intervencion')}}</textarea>

        
        {!! $errors->first('detalle_intervencion', '<p class="help-block" style="color:red";>:message</p>') !!}</div>
  
</div>

@endif
@endforeach
   <div class="container jumbotron shadow p-3 mb-5 bg-white rounded">
      <div id="botones" >
  <div class="btn-1" > <button class="btn btn-primary col-xl" name="button"  style="width:108%" >Agregar/Enviar</button><br><br><br><br>
</div>
  </div>
 
    </div>
  </div>

 </div>

<!BOTONES>

  
      </form>
</section>
</div>
<script type="text/javascript">
 function mostrar(){
document.getElementById('victima').style.display = '';
}
</script>

</body>
</html>


