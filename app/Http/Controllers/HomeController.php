<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caso;
use App\Profesional;
use Illuminate\Support\Facades\Auth;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
    $casos = [];
  
    $countcasos=[];
    $demandas = [];
    $derivaciones = [];
    $buscar=0;
    $profesionales=Profesional::all();
    $users=User::all();


    return view('home',compact("casos","demandas","derivaciones","profesionales","buscar","users"));
 }
 



   


        //$request->user()->authorizeRoles(['user', 'admin', 'profesional']);
        //Lo hago por routes

}
    


 // public function detalle() {


     // }




