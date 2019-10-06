

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
  <header>
      <section class="container jumbotron shadow p-3 mb-5 bg-white rounded"style="height: 150px" >
     @include('navbar')

                <a type="button"  href="/home" target="_self" style="width:100%; color:white;background-color:rgb(52, 144, 220);margin-bottom: -5%;margin-top: -12%" class="btn col-XL" class="btn btn-danger">IR A INICIO</button> </a><br><br>
      </section>        
      
   </header>
   <body>
    
    <h1 class="text-center" style="padding: 15px;">Informe</h1>

    <section class="container jumbotron shadow p-3 mb-5 rounded">
    <div id="imprimir">

<!-A CASO>

<section class="container jumbotron shadow bg-white">
<h4>Datos institucionales</h4><br>

<div>
  <label class="font-weight-bold">Nombre de referencia: </label>
  {{$casoActual->nombre_referencia}}
</div>

@if($casoActual->nro_carpeta == NULL)
<div style="display:none">
@else
  <div style="display:block">
@endif
  <label class="font-weight-bold">Nro de carpeta: </label>
  {{$casoActual->nro_carpeta}}
</div>

<div>
<label class="font-weight-bold">Tipo de delito: </label>
@foreach ($delitos as $delito)
  @if($delito->id == $casoActual->delito)
    {{$delito->nombre}}
  @endif
@endforeach
</div>

<div>
  <label class="font-weight-bold">Descripción del caso: </label>
  {{$casoActual->descripcion_caso}}
</div>

<div>
  <label class="font-weight-bold">Fecha de ingreso: </label>
  {{date("d/m/y",strtotime($casoActual->fecha_ingreso))}}
</div>

<div>
  <label class="font-weight-bold"> Modalidad de ingreso: </label>
  @if ($casoActual->modalidad_ingreso==1)
    Presentación espontánea
  @elseif ($casoActual ->modalidad_ingreso==2) Intervención de oficio
  @else Derivación de otro organismo
  @endif
</div>

@if($casoActual ->modalidad_ingreso==3)
<div style="display:block">
@else
<div style="display:none">
@endif
<label class="font-weight-bold">Organismo que derivó: </label>
    @foreach ($organismos as $organismo)
      @if ($organismo->id == $casoActual->organismo)
        {{$organismo->nombre}}
      @endif
    @endforeach
</div>

<div>
  <label class="font-weight-bold">Cavaj interviniente: </label>
@foreach ($cavajs as $cavaj)
  @if ($cavaj->id == $casoActual->cavaj)
    {{$cavaj->nombre}}
  @endif
@endforeach
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

@if($casoActual ->estado==2)
<div style="display:block">
@else
<div style="display:none">
  @endif
  <label class="font-weight-bold">Motivo pasivo: </label>
  @if ($casoActual->motivospasivos==1) No hay demanda
  @elseif ($casoActual ->motivospasivos==2) Deja de requerir intervención
  @elseif ($casoActual ->motivospasivos==3) Imposibilidad de contacto
  @elseif ($casoActual ->motivospasivos==4) Sentencia judicial
  @else Otro
  @endif
</div>

@if($casoActual ->motivospasivos==5)
<div style="display:block">
@else
<div style="display:none">
@endif
  <label class="font-weight-bold">Otro motivo pasivo: </label>
  {{$casoActual ->cual_otro_motivospasivo}}
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

    </div>

  
<br>



<!-A PROFESIONAL INTERVINIENTE>
<h5>Profesionales intervinientes</h5><br>

@if($casoActual->profesionales)
<div style="display:block">


@foreach ($casoActual->profesionales as $profesional)

<div>
<label class="font-weight-bold">Profesional intervinivente: </label>

@if($profesional->nombre_profesional_interviniente==0)

{{$profesional->nombre_profesional_interviniente_otro}}
@endif

@if($profesional->nombre_profesional_interviniente!==0)

  @foreach ($usuarios as $usuario)
            
              @if($usuario->id==$profesional->nombre_profesional_interviniente)
                            <strong style="text-align: center">{{$usuario->nombre_y_apellido}}</strong><br>
              
   
             @endif
            @endforeach


@endif
</div>

<div>
<label class="font-weight-bold">Interviene desde: </label>
{{date("d/m/y",strtotime($profesional->desde_profesional_interviniente))}}
</div>

<div>
<label class="font-weight-bold">Actualmente Interviene: </label>
@if($profesional->actual_profesional_interviniente == 1)Sí
@else No
@endif
</div>

@if($profesional->actual_profesional_interviniente == 2)
<div style="display:block">
@else <div style="display:none">
@endif
<label class="font-weight-bold">Interviene hasta: </label>
{{date("d/m/y",strtotime($profesional->hasta_profesional_interviniente))}}
</div>
<br>
@endforeach

@else <div style="display:none">

@endif
</div>

</section>


<!-B VICTIMA>


<section class="container jumbotron shadow bg-white">
<h4>Caracterización de la victima y su contexto</h4><br>
@foreach ($victimas as $victima)
  @if ($victima->idCaso == session("idCaso"))
    <div>
    <label class="font-weight-bold">Nombre y apellido: </label>
    {{$victima->victima_nombre_y_apellido}}
    </div>

     <div>
    <label class="font-weight-bold">Teléfono Victima: </label>
    {{$victima->telefono_victima}}
    </div>

     <div>
    <label class="font-weight-bold">Otro Teléfono Victima: </label>
    {{$victima->otro_telefono_victima}}
    </div>

    <div>
    <label class="font-weight-bold">Género: </label>
    @if($victima->genero == 1) Mujer Cis
    @elseif ($victima->genero == 2) Mujer Trans
    @elseif ($victima->genero == 3) Varon Cis
    @elseif ($victima->genero == 4) Varon Trans
    @elseif ($victima->genero == 5) Otro
    @endif
    </div>

    <div>
    <label class="font-weight-bold">Fecha de nacimiento: </label>
    @if ($victima->victima_fecha_nacimiento == "1900-01-01") Se Desconoce
    @else {{date("d/m/y",strtotime($victima->victima_fecha_nacimiento))}}
    @endif
    </div>

    <div>
    <label class="font-weight-bold">Edad: </label>
    {{$victima->victima_edad}}
    </div>

    <div>
    <label class="font-weight-bold">Franja etaria: </label>
    @if($victima->franjaetaria == 1) 0 a 11 años
    @elseif($victima->franjaetaria == 2) 12 a 18 años
    @elseif($victima->franjaetaria == 3) 19 a 30 años
    @elseif($victima->franjaetaria == 4) 31 a 50 años
    @elseif($victima->franjaetaria == 5) 51 a 65 años
    @elseif($victima->franjaetaria == 6) 65 años o más
    @elseif($victima->franjaetaria == 7) Se desconoce
    @endif
    </div>

    <div>
    <label class="font-weight-bold">Tiene documentación que acredite su identidad: </label>
    @if($victima->tienedoc == 1) Posee
    @elseif($victima->tienedoc == 3) No posee
    @elseif($victima->tienedoc == 5) En tramite
    @elseif($victima->tienedoc == 6) Se desconoce
    @endif
    </div>

    @if($victima->tienedoc == 3 || $victima->tienedoc == 6)
    <div style="display:none">
    @else <div style="display:block">
    @endif
    <label class="font-weight-bold">Tipo de documento: </label>
    @if($victima->tipodocumento ==1) D.N.I.
    @elseif($victima->tipodocumento ==2)Documento Extranjero
    @elseif($victima->tipodocumento ==3)Libreta Cívica
    @elseif($victima->tipodocumento ==4)Libreta de Enrolamiento
    @elseif($victima->tipodocumento ==5)Pasaporte
    @elseif($victima->tipodocumento ==6)Residencia Precaria
    @elseif($victima->tipodocumento ==7)Se Desconoce
    @elseif($victima->tipodocumento ==8)No posee
    @elseif($victima->tipodocumento ==9)Otro
    @endif
    </div>

    @if($victima->tipodocumento ==9)
    <div style="display:block">
    @else <div style="display:none">
    @endif
    <label class="font-weight-bold">Que otro tipo de documento: </label>
    {{$victima->tipo_documento_otro}}
    </div>

    @if($victima->tipodocumento ==6)
    <div style="display:block">
    @else <div style="display:none">
    @endif
    <label class="font-weight-bold">Estado de la residencia: </label>
    @if($victima->residenciaprecaria ==1) Vigente
    @elseif($victima->residenciaprecaria ==2) Vencida
    @elseif($victima->residenciaprecaria ==3) Se Desconoce
    @endif
    </div>

    @if($victima->tienedoc == 3 || $victima->tienedoc == 6)
    <div style="display:none">
    @else<div style="display:block">
    @endif
    <label class="font-weight-bold">Nro de documento: </label>
    {{$victima->victima_numero_documento}}
    </div>

    <div>
    <label class="font-weight-bold">Máximo nivel educativo alcanzado: </label>
    @if($victima->niveleducativo == 1)Sin instrucción formal
    @elseif($victima->niveleducativo == 2)Primario incompleto
    @elseif($victima->niveleducativo == 3)Primario completo
    @elseif($victima->niveleducativo == 4)Secundario incompleto
    @elseif($victima->niveleducativo == 5)Secundario completo
    @elseif($victima->niveleducativo == 6)Terciario-Universitario incompleto
    @elseif($victima->niveleducativo == 7)Terciario-Universitario completo
    @elseif($victima->niveleducativo == 8)Se desconoce
    @endif
    </div>

    <div>
    <label class="font-weight-bold">Condiciones de trabajo: </label>
    @if($victima->condiciones_de_trabajo == 1)Desocupado(a)
    @elseif($victima->condiciones_de_trabajo == 2)Empleo informal
    @elseif($victima->condiciones_de_trabajo == 3)Empleo formal
    @elseif($victima->condiciones_de_trabajo == 4)Población Inactiva (jubilados, menores de edad, pensionados, etc.)
    @elseif($victima->condiciones_de_trabajo == 5)Se desconoce
    @endif
    </div>

    <div>
    <label class="font-weight-bold">¿Tiene necesidades socioeconómicas insatisfechas?: </label>
    @if($victima->necesidades_socioeconomicas_insatisfechas == 1)Sí
    @elseif($victima->necesidades_socioeconomicas_insatisfechas == 2)No
    @elseif($victima->necesidades_socioeconomicas_insatisfechas == 3)Se desconoce
    @endif
    </div>

    @if($victima->necesidades_socioeconomicas_insatisfechas == 2 || $victima->necesidades_socioeconomicas_insatisfechas == 3)
    <div style="display:none">
    @else<div style="display:block">
    @endif
    <label class="font-weight-bold">Necesidades socioeconómicas insatisfechas: </label>
    {{$victima->necesidades->implode("nombre", " / ")}}
    </div>

    @if($victima->necesidades_socioeconomicas_insatisfechas_otro == NULL || ($victima->necesidades_socioeconomicas_insatisfechas == 2 || $victima->necesidades_socioeconomicas_insatisfechas == 3))
    <div style="display:none">
    @else<div style="display:block">
    @endif
    <label class="font-weight-bold">Otra necesidad socioeconómica: </label>
    {{$victima->necesidades_socioeconomicas_insatisfechas_otro}}
    </div>

    <div>
    <label class="font-weight-bold">¿Percibe algún tipo de programa o subsidio social?:  </label>
    @if($victima->programa_subsidio == 1)Sí
    @elseif($victima->programa_subsidio == 2)No
    @elseif($victima->programa_subsidio == 3)Se desconoce
    @endif
    </div>

    @if($victima->programa_subsidio == 2 || $victima->programa_subsidio == 3)
    <div style="display:none">
    @else<div style="display:block">
    @endif
    <label class="font-weight-bold">Programa o subsidio social que percibe: </label>
    {{$victima->programas->implode("nombre", " / ")}}
    </div>

    @if($victima->programa_subsidio_otro == NULL || ($victima->programa_subsidio == 2 || $victima->programa_subsidio == 3))
    <div style="display:none">
    @else<div style="display:block">
    @endif
    <label class="font-weight-bold">Otro subsidio o programa que recibe: </label>
    {{$victima->programa_subsidio_otro}}
    </div>

    @if($victima->genero == 2 || $victima->genero == 3)
    <div style="display:none">
    @else<div style="display:block">
    @endif
    <label class="font-weight-bold">Embarazo al inicio de la asistencia: </label>
    @if($victima->embarazorelevamiento == 1)Sí
    @else No
    @endif
    </div>

    <div>
    <label class="font-weight-bold">¿Presenta algún tipo de discapacidad?:  </label>
    @if($victima->tiene_discapacidad == 1)Sí
    @elseif($victima->tiene_discapacidad == 2)No
    @elseif($victima->tiene_discapacidad == 3)Se desconoce
    @endif
    </div>

    @if($victima->tiene_discapacidad == 2 || $victima->tiene_discapacidad == 3)
    <div style="display:none">
    @else<div style="display:block">
    @endif
    <label class="font-weight-bold">Qué tipo de discapacidad?: </label>
    {{$victima->discapacidades->implode("nombre", " / ")}}
    </div>

    <div>
    <label class="font-weight-bold">¿Presenta lesiones físicas visibles?:  </label>
    @if($victima->tienelesion == 1)Sí
    @elseif($victima->tienelesion == 2)No
    @elseif($victima->tienelesion == 3)Se desconoce
    @endif
    </div>

    @if($victima->tienelesion == 2 || $victima->tienelesion == 3)
    <div style="display:none">
    @else<div style="display:block">
    @endif
    <label class="font-weight-bold">Tipo de lesión: </label>
    {{$victima->tipo_lesion}}
    </div>

    <div>
    <label class="font-weight-bold">¿Tiene enfermedades crónicas?:  </label>
    @if($victima->enfermedadcronica == 1)Sí
    @elseif($victima->enfermedadcronica == 2)No
    @elseif($victima->enfermedadcronica == 3)Se desconoce
    @endif
    </div>

    @if($victima->enfermedadcronica == 2 || $victima->enfermedadcronica == 3)
    <div style="display:none">
    @else<div style="display:block">
    @endif
    <label class="font-weight-bold">Tipo de enfermedad crónica: </label>
    {{$victima->tipo_enfermedad_cronica}}
    </div>

    <div>
    <label class="font-weight-bold">¿Presenta algún tipo de limitación para comunicarse?:  </label>
    @if($victima->tiene_limitacion == 1)Sí
    @elseif($victima->tiene_limitacion == 2)No
    @elseif($victima->tiene_limitacion == 3)Se desconoce
    @endif
    </div>

    @if($victima->tiene_limitacion == 2 || $victima->tiene_limitacion == 3)
    <div style="display:none">
    @else<div style="display:block">
    @endif
    <label class="font-weight-bold">Qué tipo de limitación?: </label>
    {{$victima->limitaciones->implode("nombre", " / ")}}
    </div>

    @if($victima->limitacion_otro == NULL || ($victima->tiene_limitacion == 2 || $victima->tiene_limitacion == 3))
    <div style="display:none">
    @else<div style="display:block">
    @endif
    <label class="font-weight-bold">Otra limitación: </label>
    {{$victima->limitacion_otro}}
    </div>

    <div>
    <label class="font-weight-bold">¿Es persona asistida la víctima en cuestión?:  </label>
    @if($victima->persona_asistida == 1)Sí
    @else No
    @endif
    </div>
    <br>
  @endif
@endforeach
    <br>
</section>

    <!-A PERSONA ASISTIDA>

<section class="container jumbotron shadow bg-white">
    @if($casoActual->persona_asistida ==1)
    <div style="display:none">
    @else <div style="display:block">
    <h4>Personas asistidas</h4><br>
    @foreach ($casoActual->personas as $persona)

    <div>
    <label class="font-weight-bold">Nombre y apellido de la persona asistida: </label>
    {{$persona->nombre_persona_asistida}}
    </div>

    <div>
    <label class="font-weight-bold">Tipo de vínculo con la víctima: </label>
    @if($persona->vinculo_persona_asistida == 1) Familiar
    @elseif ($persona->vinculo_persona_asistida == 2) Lazo afectivo
    @elseif ($persona->vinculo_persona_asistida == 3) Organismo o institución
    @elseif ($persona->vinculo_persona_asistida == 4) Otro
    @endif
    </div>

    @if($persona->vinculo_persona_asistida == 4)
    <div style="display:block">
    @else <div style="display:none">
    @endif
    <label class="font-weight-bold">Que otro tipo de vínculo: </label>
    {{$persona->otro_vinculo_persona_asistida_cual}}
    </div>

    <div>
    <label class="font-weight-bold">Teléfono de contacto: </label>
    @if($persona->telefono_persona_asistida == 0) Se desconoce
    @else{{$persona->telefono_persona_asistida}}
    @endif
    </div>

    <div>
    <label class="font-weight-bold">Domicilio del contacto: </label>
    {{$persona->domicilio_persona_asistida}}
    </div>

    <div>
    <label class="font-weight-bold">Localidad de residencia: </label>
    {{$persona->localidad_persona_asistida}}
    </div>

    <div>
    <label class="font-weight-bold">Se relaciona con: </label>
    {{$persona->victims->implode("victima_nombre_y_apellido", " / ")}}
    </div>

    <br>
    @endforeach
    @endif
    </div>
    </section>


<!-C CONVIVIENTE>

<section class="container jumbotron shadow bg-white">
<h4>Referentes afectivos</h4><br>
@foreach ($convivientes as $conviviente)
  @if ($conviviente->idCaso == session("idCaso"))

    <div>
    <label class="font-weight-bold">Nombre y apellido: </label>
    {{$conviviente->nombre_y_apellido}}
    </div>

    <div>
    <label class="font-weight-bold">Edad: </label>
    {{$conviviente->edad}}
    </div>

    <div>
    <label class="font-weight-bold">Vinculación con la víctima: </label>
    @if($conviviente->vinculo_victima == 1)Familiar
    @elseif($conviviente->vinculo_victima == 2)Pareja
    @elseif($conviviente->vinculo_victima == 3)Amistad
    @elseif($conviviente->vinculo_victima == 4)Conocido
    @elseif($conviviente->vinculo_victima == 5)Se desconoce
    @elseif($conviviente->vinculo_victima == 6)Otro
    @endif
    </div>

    @if($conviviente->vinculo_otro == NULL)
    <div style="display:none">
    @else<div style="display:block">
    @endif
    <label class="font-weight-bold">Otro tipo de vínculo: </label>
    {{$conviviente->vinculo_otro}}
    </div>

    <div>
    <label class="font-weight-bold">Máximo nivel educativo alcanzado: </label>
    @if($conviviente->niveleducativo_id == 1)Sin instrucción formal
    @elseif($conviviente->niveleducativo_id == 2)Primario incompleto
    @elseif($conviviente->niveleducativo_id == 3)Primario completo
    @elseif($conviviente->niveleducativo_id == 4)Secundario incompleto
    @elseif($conviviente->niveleducativo_id == 5)Secundario completo
    @elseif($conviviente->niveleducativo_id == 6)Terciario-Universitario incompleto
    @elseif($conviviente->niveleducativo_id == 7)Terciario-Universitario completo
    @elseif($conviviente->niveleducativo_id == 8)Se desconoce
    @endif
    </div>

    <div>
    <label class="font-weight-bold">Condiciones de trabajo: </label>
    @if($conviviente->condiciones_de_trabajo == 1)Desocupado(a)
    @elseif($conviviente->condiciones_de_trabajo == 2)Empleo informal
    @elseif($conviviente->condiciones_de_trabajo == 3)Empleo formal
    @elseif($conviviente->condiciones_de_trabajo == 4)Población Inactiva (jubilados, menores de edad, pensionados, etc.)
    @elseif($conviviente->condiciones_de_trabajo == 5)Se desconoce
    @endif
    </div>

    <div>
    <label class="font-weight-bold">Se relaciona con: </label>
    {{$conviviente->victims->implode("victima_nombre_y_apellido", " / ")}}
    </div>

    <br>
  @endif
  @endforeach
    <br>
</section>
<!-D DELITO>




<!-E IMPUTADOS>

<section class="container jumbotron shadow bg-white">
<h4>Datos del imputado</h4><br>
@foreach ($imputados as $imputado)
  @if ($imputado->idCaso == session("idCaso"))

<div>
<label class="font-weight-bold">Nombre y apellido: </label>
{{$imputado->nombre_y_apellido}}
</div>

<div>
<label class="font-weight-bold">Apodo: </label>
{{$imputado->apodo}}
</div>

<div>
<label class="font-weight-bold">Tipo de documento: </label>
@if($imputado->tipo_documento_id ==1) D.N.I.
@elseif($imputado->tipo_documento_id ==2)Documento Extranjero
@elseif($imputado->tipo_documento_id ==3)Libreta Cívica
@elseif($imputado->tipo_documento_id ==4)Libreta de Enrolamiento
@elseif($imputado->tipo_documento_id ==5)Pasaporte
@elseif($imputado->tipo_documento_id ==6)Residencia Precaria
@elseif($imputado->tipo_documento_id ==7)Se Desconoce
@elseif($imputado->tipo_documento_id ==8)No posee
@elseif($imputado->tipo_documento_id ==9)Otro
@endif
</div>

@if($imputado->tipo_documento_id ==9)
<div style="display:block">
@else <div style="display:none">
@endif
<label class="font-weight-bold">Que otro tipo de documento: </label>
{{$imputado->tipo_documento_otro}}
</div>

@if($imputado->tipo_documento_id == 7 || $imputado->tipo_documento_id == 8)
<div style="display:none">
@else<div style="display:block">
@endif
<label class="font-weight-bold">Nro de documento: </label>
{{$imputado->documento_nro}}
</div>

<div>
<label class="font-weight-bold">Vinculación con la víctima: </label>
@if($imputado->vinculo_id == 1)Familiar
@elseif($imputado->vinculo_id == 2)Pareja
@elseif($imputado->vinculo_id == 3)Amistad
@elseif($imputado->vinculo_id == 4)Conocido
@elseif($imputado->vinculo_id == 5)Sin vínculo
@elseif($imputado->vinculo_id == 6)Otro
@elseif($imputado->vinculo_id == 7)Se desconoce
@endif
</div>

@if($imputado->vinculo_otro == NULL)
<div style="display:none">
@else<div style="display:block">
@endif
<label class="font-weight-bold">Otro tipo de vínculo: </label>
{{$imputado->vinculo_otro}}
</div>

<div>
<label class="font-weight-bold">Caratulación judicial: </label>
{{$imputado->caratulacion_judicial}}
</div>

<div>
<label class="font-weight-bold">Existencia de antecedentes penales:  </label>
@if($imputado->antecedentes_id == 1)Sí
@elseif($imputado->antecedentes_id == 2)No
@elseif($imputado->antecedentes_id == 3)Se desconoce
@endif
</div>

@if($imputado->antecedentes_id == 1)
<div style="display:block">
@else<div style="display:none">
@endif
<label class="font-weight-bold">Descripción de antecedentes: </label>
{{$imputado->antecedentes}}
</div>

<div>
<label class="font-weight-bold">Está detenido?:  </label>
@if($imputado->detenido == 1)Sí
@elseif($imputado->detenido == 2)No
@elseif($imputado->detenido == 3)Se desconoce
@endif
</div>

@if($imputado->detenido == 1)
<div style="display:block">
@else<div style="display:none">
@endif
<label class="font-weight-bold">Lugar de alojamiento: </label>
{{$imputado->lugar_de_alojamiento}}
</div>

<div>
<label class="font-weight-bold">Cuenta con defensor particular?:  </label>
@if($imputado->defensor_particular == 1)Sí
@elseif($imputado->defensor_particular == 2)No
@elseif($imputado->defensor_particular == 3)Se desconoce
@endif
</div>

<div>
<label class="font-weight-bold">Defensoría Nro: </label>
{{$imputado->defensoria_nro}}
</div>

<div>
<label class="font-weight-bold">Fiscalía/juzgado a cargo: </label>
{{$imputado->fiscalia_juzgado}}
</div>

<div>
<label class="font-weight-bold">Nro de causa o Id Judicial: </label>
{{$imputado->causa_id_judicial}}
</div>

<div>
<label class="font-weight-bold">Se relaciona con: </label>
{{$imputado->victims->implode("victima_nombre_y_apellido", " / ")}}
</div>

<br>

@endif
@endforeach
</section>
<br>

<!-F ORGANISMOS>
<section class="container jumbotron shadow bg-white">
<h4>Atención del caso</h4><br>

@if($casoActual->instituciones)

<div>
<label class="font-weight-bold">¿intervinieron otros organismos previamente?: </label>
@if($casoActual->instituciones->organismos_intervinieron == 1) Sí
@else No. Intervino solo el organismo que derivó
@endif
</div>

@if($casoActual->instituciones->organismos_intervinieron == 2)
<div style="display:none">
@else<div style="display:block">
@endif
<label class="font-weight-bold">Organismos previos intervinientes: </label>
{{$casoActual->instituciones->oprevios->implode("nombre", " / ")}}
</div>

@if($casoActual->instituciones->cual_otro_organismo == NULL)
<div style="display:none">
@else<div style="display:block">
@endif
<label class="font-weight-bold">Otro organismo interviniente: </label>
{{$casoActual->instituciones->cual_otro_organismo}}
</div>

<div>
<label class="font-weight-bold">¿Requiere algún tipo de asistencia?: </label>
@if($casoActual->instituciones->requiere_asistencia == 1) Sí
@else No
@endif
</div>

@if($casoActual->instituciones->requiere_asistencia == 2)
<div style="display:none">
@else<div style="display:block">
@endif
<label class="font-weight-bold">Tipo de asistencia requerida: </label>
@if($casoActual->instituciones->asistencia_juridica == 1) Jurídica /
@else
@endif
@if($casoActual->instituciones->asistencia_psicologica == 1) Psicológica /
@else
@endif
@if($casoActual->instituciones->asistencia_socioeconomica == 1) Socioeconómica
@else
@endif
</div>

@if($casoActual->instituciones->asistencia_socioeconomica == 0)
<div style="display:none">
@else<div style="display:block">
@endif
<label class="font-weight-bold">Tipo de asistencia socioeconómica: </label>
{{$casoActual->instituciones->socioeconomicos->implode("nombre", " / ")}}
</div>

@if($casoActual->instituciones->socioeconomica_otro == NULL)
<div style="display:none">
@else<div style="display:block">
@endif
<label class="font-weight-bold">Otra necesidad socioeconómica: </label>
{{$casoActual->instituciones->socioeconomica_otro}}
</div>

<div>
<label class="font-weight-bold">Articula con algún organismo actualmente?: </label>
@if($casoActual->instituciones->organismo_articula_si_no == 1) Sí
@elseif($casoActual->instituciones->organismo_articula_si_no == 2) No
@else Se desconoce
@endif
</div>

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

<div>
<label class="font-weight-bold">¿Cuenta con abogado particular?: </label>
@if($casoActual->instituciones->abogado_particular == 1)Sí
@elseif($casoActual->instituciones->abogado_particular == 2)No
@else Se desconoce
@endif
</div>

@if($casoActual->instituciones->abogado_particular == 1)
  <div style="display:none">
  @else
    <div style="display:block">
  @endif


    <div>
    <label class="font-weight-bold">Patrocinio Jurídico Gratuito: </label>
    @if($casoActual->instituciones->pratocinio_gratuito == 1)Requiere
    @elseif($casoActual->instituciones->pratocinio_gratuito == 2)A la espera de designación
    @elseif($casoActual->instituciones->pratocinio_gratuito == 3)Designado
    @elseif($casoActual->instituciones->pratocinio_gratuito == 4)No requiere
    @endif
    </div>

    @if($casoActual->instituciones->pratocinio_gratuito == 1 || $casoActual->instituciones->pratocinio_gratuito == 2)
      <div style="display:block">
    @else
      <div style="display:none">
    @endif
    <label class="font-weight-bold">Fecha de solicitud: </label>
    {{date("d/m/y",strtotime($casoActual->instituciones->fecha_de_solicitud))}}
    </div>

    @if($casoActual->instituciones->pratocinio_gratuito == 3)
    <div style="display:block">

    <div>
    <label class="font-weight-bold">Nombre y Apellido del letrado designado: </label>
    {{$casoActual->instituciones->letrado_designado}}
    </div>

    <div>
    <label class="font-weight-bold">¿Conformidad con la asistencia recibida por parte del letrado designado?: </label>
    @if($casoActual->instituciones->pratocinio_conformidad == 1)Sí
    @elseif($casoActual->instituciones->pratocinio_conformidad == 2)No
    @else Se desconoce
    @endif
    </div>

    <div>
    <label class="font-weight-bold">Colegio departamental: </label>
    {{$casoActual->instituciones->departamentos->nombre}}
    </div>

    <div>
    <label class="font-weight-bold">Fecha de designación: </label>
    {{date("d/m/y",strtotime($casoActual->instituciones->fecha_designacion))}}
    </div>

    @else<div style="display:none">
    @endif
    </div>

</div>
@else
@endif
</section>
<br>

<!-G DOCUMENTACION>
<section class="container jumbotron shadow bg-white">
<h4>Documentación disponible</h4><br>

@if($casoActual->documentos)

<div>
    @foreach($casoActual->documentos as $documento)
    <li>@if($documento->tipo_documento == 1) Notas internas -
    @elseif($documento->tipo_documento == 2) Notas externas -
    @elseif($documento->tipo_documento == 3) Noticias relacionadas -
    @elseif($documento->tipo_documento == 4) Plan de Intervención/Estrategias de abordaje -
    @else Informe socioambiental
    @endif
    <a href="/storage/{{$documento->archivo}}">
    {{$documento->nombre_documento}}</a></li>
    @endforeach
  <br>
  </div>

@else
@endif
  <br>
  </section>

<!-G2 INTERVENCIONES>
<section class="container jumbotron shadow bg-white">
<h4>Intervenciones</h4><br>
@if($casoActual->intervenciones)

<div>
@foreach($casoActual->intervenciones as $intervencion)
{{$intervencion->fecha_intervencion . " - " . $intervencion->detalle_intervencion}}<br><br>
@endforeach
</div>

@else
@endif
  <br>
 
</div>



 <button class="btn btn-primary col-xl" onclick="imprimir();">
  IMPRIMIR
</button><br><br>
<a type="button" style="width:100%;color:white text-decoration: none" class="btn btn-primary col-xl" href="/home" target="_self">INICIO</button></a><br><br>
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
