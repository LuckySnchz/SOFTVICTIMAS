@extends('layouts.app')  
   
@section('title')  
  Cambio de contraseña  
@endsection  
   
@section('content')  
  
    <div class="row justify-content-center">  
      <div class="col-md-8 col-md-offset-2">  
        <div class="panel panel-default">  
        
          <div class="panel-body" style="margin-left: 25%">  
            <form class="form-horizontal" method="POST" role="form" action="{{ route('password.change.post') }}">  
              @if (count($errors) > 0)  
                <div class="alert alert-danger">  
                  <ul>  
                    @foreach ($errors->all() as $error)  
                      <li>{{ $error }}</li>  
                    @endforeach  
                  </ul>  
                </div>  
              @endif  
              {{ csrf_field() }}  
              {{-- Current password --}}  
              <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">  
                <strong><label for="current_password" class="col-md-4 control-label">Contraseña Actual</label>  </strong>
   
                <div class="col-md-6">  
                  <input id="current_password" type="password" class="form-control" name="current_password" required autofocus>  
   
                  @if ($errors->has('current_password'))  
                    <span class="help-block">  
                   
                  </span>  
                  @endif  
                </div>  
              </div>  
   
              {{-- New password --}}  
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">  
               <strong> <label for="password" class="col-md-4 control-label">Nueva Contraseña</label>  </strong>
   
                <div class="col-md-6">  
                  <input id="password" type="password" class="form-control" name="password" required>  
   
                  @if ($errors->has('password'))  
                    <span class="help-block">  
                   
                  </span>  
                  @endif  
                </div>  
              </div>  
   
              {{-- Confirm new password --}}  
              <div class="form-group">  
               <strong> <label for="password-confirm" class="col-md-4 control-label">Confirmar Nueva Contraseña</label>  </strong>
   
                <div class="col-md-6">  
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>  
                </div>  
              </div>  
   
              {{-- Submit button --}}  
              <div class="form-group" style="margin-left: 13%">  
                 
                  <button type="submit" class="btn btn-primary">  
                   <strong> Cambiar Contraseña </strong>
                  </button>  
        
              </div>  
   
            </form>  
          </div>  
          
      </div>  
    </div>  

@endsection  