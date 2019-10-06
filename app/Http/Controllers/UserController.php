<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

use Validator;

class UserController extends Controller
{
public function casos(){
  return $this->belongsToMany ("App\Caso","profesionales","nombre_profesional_interviniente","idCaso");

  



}
