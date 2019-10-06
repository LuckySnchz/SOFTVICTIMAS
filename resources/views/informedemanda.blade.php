

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   <link rel="stylesheet" href="css/app.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <title>Informe</title>
</head>

   <body>
     @include('navbar')
    <h1 class="text-center" style="padding: 15px;">Informe de incidencia</h1>
    <section class="container jumbotron shadow p-3 mb-5 rounded">
    <div id="imprimir">


<section class="container jumbotron shadow bg-white">
  <br><h4>Resumen de Incidencia</h4><br>

  <div>
  <label class="font-weight-bold">Fecha de ingreso: </label>
  {{date("d/m/y",strtotime($demandaActual->fecha_ingreso))}}
  </div>

  <div>
    <label class="font-weight-bold">Nombre y apellido: </label>
    {{$demandaActual->nombre_y_apellido_de_la_victima}}
  </div>

  <div>
  <label class="font-weight-bold">Tipo de delito: </label>
  @foreach ($delitos as $delito)
    @if($delito->id == $demandaActual->delito)
      {{$delito->nombre}}
    @endif
  @endforeach
  </div>

  <div>
  <label class="font-weight-bold">País del hecho: </label>
  @if($demandaActual->pais_hecho == 1) Argentina
  @else Otro país
  @endif
  </div>

  <div>
  <label class="font-weight-bold">Provincia del hecho: </label>
  @foreach ($provincias as $provincia)
      @if($provincia->id == $demandaActual->provincia_hecho)
    {{$provincia->nombre}}
  @else
  @endif
  @endforeach
  </div>

  <div>
  <label class="font-weight-bold">Ciudad del hecho: </label>
  @foreach ($ciudades as $ciudad)
      @if($ciudad->id == $demandaActual->localidad_hecho)
    {{$ciudad->localidad_nombre}}
  @else
  @endif
  @endforeach

  </div>

    <div>
      <label class="font-weight-bold"> Modalidad de ingreso: </label>
      @if ($demandaActual->modalidad_ingreso==1) Presentación espontánea
      @elseif ($demandaActual ->modalidad_ingreso==2) Intervención de oficio
      @elseif ($demandaActual ->modalidad_ingreso==3) Derivación de otro organismo
      @else Se desconoce
      @endif
    </div>

    @if($demandaActual ->modalidad_ingreso==3)
    <div style="display:block">
    @else
    <div style="display:none">
    @endif
    <label class="font-weight-bold">Organismo que derivó: </label>
        @foreach ($organismos as $organismo)
          @if ($organismo->id == $demandaActual->organismo)
            {{$organismo->nombre}}
          @endif
        @endforeach
      </div>




</section>



</div>

<button class="btn btn-primary col-xl" onclick="imprimir();">
  IMPRIMIR
</button><br><br>


<input type ='button' class="btn btn-primary col-xl" value = 'Ir a Inicio' onclick="window.open('/home', 'width=800,height=600');"/> <br><br>

</section>
</section>

<script>
    function imprimir(){
  var objeto=document.getElementById('imprimir');  //obtenemos el objeto a imprimir
  var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
  ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
  ventana.document.close();  //cerramos el documento
  ventana.print();  //imprimimos la ventana
  ventana.close();  //cerramos la ventana
}
</script>

      </body>
</html>
