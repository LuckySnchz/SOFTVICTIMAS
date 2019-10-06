
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <link rel="stylesheet" href="css/app.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <title>Eje G: DOCUMENTACIÓN</title>
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

    <h1 class="text-center" style="padding: 15px;">Eje G: Documentación</h1>

    <div class="divpersona" id="divpersona">  <h2 class="text-center" style="padding: -20px;">Adjuntar Documentación</h2></div>

    <section class="container jumbotron shadow p-3 mb-5 bg-white rounded">



<div class="archivos">
    <ul style="list-style: none";>
        @foreach($documentos as $documento)
          @if($documento->IdCaso==session("idCaso"))

               <li>
            <a href="/storage/{{$documento->archivo}}">
              {{$documento->nombre_documento}}</a>
              
             
            </li>
          @endif
        @endforeach
        </ul>
      <br>
    </div>



    <form class="" action="/detalleagregarDocumento" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
    <input type="hidden" name="idCaso" value="{{session("idCaso")}}">



<!-G seleccionar archivo>

      <div class="form-group" {{ $errors->has('tipo_documento') ? 'has-error' : ''}}>
      <label for="tipo_documento">G 1.- Seleccionar tipo de Documento: </label>
      <select class="form-control" name="tipo_documento" >
            <option value="" selected=disabled>Seleccionar...</option>
              @if(old("tipo_documento")==1)
              <option value="1" selected >Notas internas </option>
              @else <option value="1">Notas internas </option>@endif

              @if(old("tipo_documento")==2)
              <option value="2" selected >Notas externas </option>
              @else  <option value="2" >Notas externas </option>@endif

              @if(old("tipo_documento")==3)
              <option value="3" selected >Noticias relacionadas </option>
              @else  <option value="3">Noticias relacionadas</option>@endif

              @if(old("tipo_documento")==4)
              <option value="4" selected >Plan de Intervención/Estrategias de abordaje </option>
              @else<option value="4" >Plan de Intervención/Estrategias de abordaje </option>@endif

              @if(old("tipo_documento")==5)
              <option value="5" selected >Informe socioambiental </option>
            @else<option value="5" >Informe socioambiental </option>@endif
              </select>
      {!! $errors->first('tipo_documento', '<p class="help-block" style="color:red";>:message</p>') !!}
      </div>

      <div class="form-group" {{ $errors->has('nombre_documento') ? 'has-error' : ''}}>
      <label for="nombre_documento">G 2.-Nombre del Documento: </label>
      <input type="text" class="form-control" name="nombre_documento"  value="{{old("nombre_documento")}}">
      {!! $errors->first('nombre_documento', '<p class="help-block" style="color:red";>:message</p>') !!}
      </div>


      <div class="form-group" {{ $errors->has('archivo') ? 'has-error' : ''}}>
        <label for="">G 3. Agregar Archivos:</label>
        <input onchange="ValidateSize(this)" type="file" name="archivo" class="form-control">
        {!! $errors->first('archivo', '<p class="help-block" style="color:red";>:message</p>') !!}
      </div>

      <script type="text/javascript">
          function ValidateSize(file) {
            var FileSize = file.files[0].size / 1024 / 1024; // in MB
            if (FileSize > 5) {
            alert('File size exceeds 5 MB');
           $(file).val('');
        } else {}
        }
        </script>


<!BOTONES>

      <div class="botones">
      <div class="btn-1"> <button style="width:100%" type="submit" class="btn btn-primary col-xL" name="button"  >Agregar/Enviar</button><br><br></div>
      </div>
      </form>
      </section>

     




      </body>
</html>
