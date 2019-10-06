
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  
    <body>
   <form class="" action="/vincular" method="post">
   {{csrf_field()}}
 <input type="hidden" name="idCaso" value="{{session("idCaso")}}">
 <input type="hidden" name="idVictim" value="{{session("idVictim")}}">


       <div class="form-group" {{ $errors->has('vinculo_persona_asistida') ? 'has-error' : ''}}>
       <label for="vinculo_persona_asistida">A 14II. Tipo de vínculo con la víctima: </label>
       <select class="form-control" name="vinculo_persona_asistida" id="vinculo_victima" onChange="selectOnChangeA14II(this)">
             <option value="" selected=disabled>Seleccionar...</option>
               @if(old("vinculo_persona_asistida")==1)
               <option value="1" selected >Familiar</option>
               @else <option value="1">Familiar</option>@endif

               @if(old("vinculo_persona_asistida")==2)
               <option value="2" selected >Lazo afectivo</option>
               @else  <option value="2" >Lazo afectivo</option>@endif

               @if(old("vinculo_persona_asistida")==3)
               <option value="3" selected >Organismo o institución</option>
               @else  <option value="3">Organismo o institución</option>@endif

               @if(old("vinculo_persona_asistida")==4)
               <option value="4" selected >Otro</option>
               @else<option value="4" >Otro</option>@endif
               </select>
       {!! $errors->first('vinculo_persona_asistida', '<p class="help-block" style="color:red";>:message</p>') !!}
       </div>

       @if(old("vinculo_persona_asistida") == 4)
         <div id="vinculo_victima_cual" {{ $errors->has('otro_vinculo_persona_asistida_cual') ? 'has-error' : ''}}>
         @else
           <div id="vinculo_victima_cual" style="display: none;">
       @endif
       <br><label for="">Cuál?</label>
       <div class="">
       <input class="form-control" name="otro_vinculo_persona_asistida_cual" id="vinculo_victima_cual_otro" type="text" value="{{old("otro_vinculo_persona_asistida_cual")}}"><br>
       {!! $errors->first('otro_vinculo_persona_asistida_cual', '<p class="help-block" style="color:red";>:message</p>') !!}
       </div>
       </div>

  <div class="btn-1"> <button type="submit" class="btn btn-primary col-xl" name="button"  >Agregar/Enviar</button><br><br></div>
   </div>
    </form>
   </body>

</html>
