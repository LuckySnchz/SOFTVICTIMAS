

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
    <h1 class="text-center" style="padding: 15px;">Informe derivación</h1>
    <section class="container jumbotron shadow p-3 mb-5 rounded">
    <div id="imprimir">


<section class="container jumbotron shadow bg-white">
  <br><h4>Resumen de derivación</h4><br>

  <div>
  <label class="font-weight-bold">Fecha de ingreso: </label>
  {{date("d/m/y",strtotime($derivacionActual->fecha_ingreso))}}
  </div>

  <div>
    <label class="font-weight-bold">Nombre y apellido: </label>
    {{$derivacionActual->nombre_y_apellido}}
  </div>

  <div>
    <label class="font-weight-bold">Contacto: </label>
    {{$derivacionActual->contacto}}
  </div>

  <div>
    <label class="font-weight-bold">Tipo de demanda: </label>
  @foreach ($tipo_demandas as $demanda)
    @if ($demanda->id == $derivacionActual->tipo_demanda)
      {{$demanda->nombre}}
    @endif
  @endforeach
  </div>

  @if($derivacionActual ->tipo_demanda==17)
  <div style="display:block">
  @else
  <div style="display:none">
  @endif
  <label class="font-weight-bold">Otro tipo de demanda: </label>
      {{$derivacionActual->otra_demanda}}
    </div>


    <div>
      <label class="font-weight-bold"> Modalidad de ingreso: </label>
      @if ($derivacionActual->modalidad_ingreso==1) Presentación espontánea
      @elseif ($derivacionActual ->modalidad_ingreso==2) Intervención de oficio
      @elseif ($derivacionActual ->modalidad_ingreso==3) Derivación de otro organismo
      @else Se desconoce
      @endif
    </div>

    @if($derivacionActual ->modalidad_ingreso==3)
    <div style="display:block">
    @else
    <div style="display:none">
    @endif
    <label class="font-weight-bold">Organismo que derivó: </label>
        @foreach ($organismos as $organismo)
          @if ($organismo->id == $derivacionActual->organismo)
            {{$organismo->nombre}}
          @endif
        @endforeach
      </div>

      <div>
        <label class="font-weight-bold">Organismo al que se deriva: </label>
      @foreach ($oderivados as $derivado)
        @if ($derivado->id == $derivacionActual->derivacion)
          {{$derivado->nombre}}
        @endif
      @endforeach
      </div>

      <div>
        <label class="font-weight-bold"> Estado de derivación: </label>
        @if ($derivacionActual->estado_derivacion==1) Resuelta
        @elseif ($derivacionActual ->estado_derivacion==2) En proceso
        @else Imposibilidad de contacto
        @endif
      </div>


  @if ($errors->any())
    <div class="alert alert-danger">
    <p>Debes completar todo el <strong>formulario</strong> para continuar</p>
    </div>
  @endif


  <!-Seguimientos>

  <br><h4>Seguimiento</h4><br>

  <div>

  @foreach($seguimientos as $seguimiento)
  @if ($seguimiento->idDerivacion == session("idDerivacion"))
   <li>
     {{$seguimiento->fecha_seguimiento . " - " . $seguimiento->detalle_seguimiento}}
   </li>
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
