
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" href="css/app.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <title>Eje G: Informe de seguimiento</title>
      <style>
         .Auno,.Ados{float: left;
         width: 40%
         }
         .AunoDos{overflow: hidden;margin-left: 1%}
      </style>
   </head>
   <header>
     @include('navbar')

   </header>
   <body>
<div id="imprimir">
    <h1 class="text-center" style="padding: 15px;">Eje G: Informe de seguimiento</h1>

    <div class="divpersona" id="divpersona">  <h2 class="text-center" style="padding: -20px;"></h2></div>

    <section class="container" >

    <form class="" action="/detalleagregarIntervencion" method="post">
      {{csrf_field()}}
    <input type="hidden" name="idCaso" value="{{session("idCaso")}}">



<!-ENCABEZADO>
<div class="container jumbotron shadow p-3 mb-5 bg-white rounded">

<h4>Resumen</h4><br>

<div>

       <label class="font-weight-bold">Nombre de referencia: </label>
        {{$casoActual->nombre_referencia}}

</div>

<div>
<label class="font-weight-bold">Tipo de delito: </label>
 {{$casoActual->delitos->implode("nombre", " / ")}}
</div>

<div>
  <label class="font-weight-bold">Descripción del caso: </label>
  {{$casoActual->descripcion_caso}}
</div>

<div>
  <label class="font-weight-bold">Fecha de ingreso: </label>
  {{$casoActual->fecha_ingreso}}
</div>

<div>
  <label class="font-weight-bold"> Modalidad de ingreso: </label>
  @if ($casoActual->modalidad_ingreso==1)
    Presentación espontánea
  @elseif ($casoActual ->modalidad_ingreso==2) Intervención de oficio
  @else Derivación de otro organismo
  @endif
</div>

<div>
  <label class="font-weight-bold">Cavaj intervinientes: </label>
  {{$casoActual->cavajs->implode("nombre", " / ")}}
</div>

<div>
  <label class="font-weight-bold">Fiscalía/Juzgado a cargo: </label>
  {{$casoActual ->fiscalia_juzgado}}
</div>

<div>
  <label class="font-weight-bold">Causa o Id Judicial: </label>
  {{$casoActual ->causa_id_judicial}}
</div>

<div>
  <label class="font-weight-bold">Comisaría interviniente: </label>
  {{$casoActual ->comisaria}}
</div>

<div>
  <label class="font-weight-bold">¿Hubo denuncias previas vinculadas a la temática del tipo de delito actual?: </label>
  @if($casoActual ->denuncias_previas == 1) Sí
  @elseif($casoActual ->denuncias_previas == 2) No</option>
  @else Se desconoce
  @endif
</div>

<div>
  <label class="font-weight-bold">Departamento Judicial: </label>
  @foreach ($departamentos as $departamento)
    @if($departamento->id == $casoActual ->departamento_judicial)
      {{$departamento->nombre}}
    @endif
  @endforeach
</div>

<div>
  <label class="font-weight-bold">Estado: </label>
  @if($casoActual ->estado == 1) Activo
  @else Pasivo
  @endif
</div>

<div>
  <label class="font-weight-bold">Nombre y apellido de la victima: </label>
  {{$casoActual ->nombre_y_apellido_de_la_victima}}
</div>

<div>
<label class="font-weight-bold">Tipo de fecha del hecho: </label>
@if($casoActual->fecha_delito == 1) Fecha específica
@elseif($casoActual->fecha_delito == 2) Otro
@else Se desconoce
@endif
</div>

@if($casoActual->fecha_delito == 1)
<div style="display:block">
@else<div style="display:none">
@endif
<label class="font-weight-bold">Fecha del hecho: </label>
{{date("d/m/y",strtotime($casoActual->fecha_hecho))}}
</div>

@if($casoActual->fecha_delito == 2)
<div style="display:block">
@else<div style="display:none">
@endif
    <label class="font-weight-bold">Descripción del periodo de fechas del hecho: </label>
    {{$casoActual->fecha_hecho_otro}}
    </div>

    <div>
    <label class="font-weight-bold">País del hecho: </label>
    @if($casoActual->pais_hecho == 1) Argentina
    @else Otro país
    @endif
    </div>

    <div>
    <label class="font-weight-bold">Provincia del hecho: </label>
    @foreach ($provincias as $provincia)
        @if($provincia->id == $casoActual->provincia_hecho)
      {{$provincia->nombre}}
    @else
    @endif
    @endforeach
    </div>

    <div>
    <label class="font-weight-bold">Ciudad del hecho: </label>
    @foreach ($ciudades as $ciudad)
        @if($ciudad->id == $casoActual->localidad_hecho)
      {{$ciudad->localidad_nombre}}
    @else
    @endif
    @endforeach

    </div><br><br>


<!-ARTICULACION CON ORGANISMOS>

<h4>Articulación con organismos</h4><br>

@if($casoActual->instituciones->organismo_articula_si_no == NULL)
<div>
  <h6>Información no cargada aún</h6>
@else


@if($casoActual->instituciones->organismo_articula_si_no == 1)
<div style="display:block">
@else<div style="display:none">
@endif
<label class="font-weight-bold">Organismos con los que se articula actualmente: </label>
{{$casoActual->instituciones->oarticulas->implode("nombre", " / ")}}
</div>

@if($casoActual->instituciones->organismos_actual_otro == NULL)
<div style="display:none">
@else<div style="display:block">
@endif
<label class="font-weight-bold">Otro organismo con el que se articula: </label>
{{$casoActual->instituciones->organismos_actual_otro}}
</div>

@endif
</div>

<!-AGREGAR INTERVENCION>

<br><h4>Intervenciones</h4><br>

<div>

 @foreach($intervenciones as $intervencion)
     @if ($intervencion->idCaso == session("idCaso"))
       <li>
         {{$intervencion->fecha_intervencion . " - " . $intervencion->detalle_intervencion}}
       </li>
     @endif
 @endforeach
</div>
</div>


<div id="intervencion-form" style="display:none">


      <div class="form-group" {{ $errors->has('fecha_intervencion') ? 'has-error' : ''}}>
      <label>Fecha intervención: </label>
      <input type="date" name="fecha_intervencion" class="form-control" value="{{old("fecha_intervencion")}}">
      {!! $errors->first('fecha_intervencion', '<p class="help-block" style="color:red";>:message</p>') !!}
      </div>




      <div class="form-group" {{ $errors->has('detalle_intervencion') ? 'has-error' : ''}}>
      <label>Detalle intervención: </label>
      <textarea class="form-control" name="detalle_intervencion" rows="8" cols="80"></textarea>
      {!! $errors->first('detalle_intervencion', '<p class="help-block" style="color:red";>:message</p>') !!}
      </div>

      <div class="btn-1"> <button style="width:100%" type="submit"  class="btn btn-primary col-xl" name="button"  >Guardar</button><br><br></div>
      </div>
       <div class="botones" >
      <div class="btn-1"><button style="width:100%" onclick="openInterv(this)" class="btn btn-primary col-xl" name="button"  >Agregar Intervención</button><br><br></div>
      </div>
      <button class="btn btn-primary col-xl" onclick="imprimir();">
  IMPRIMIR
</button><br><br>
      </form>

</div>
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

<script>
   function openInterv(sel) {

        divC = document.getElementById("intervencion-form");
        divC.style.display = ""


    }



</script>



<!BOTONES>





      </form>
</section>






      </body>
</html>
