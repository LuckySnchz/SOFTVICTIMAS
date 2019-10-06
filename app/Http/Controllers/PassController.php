<?php



namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use Closure;



class PassController extends Controller
{

    //Método con str_shuffle() 


public function index() { 
        $users=User::all();
        
         /*foreach ($users as $user) {
          
        $password=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6); 
        $hayUsuario=User::where("email",$user->email)->first();
        $hayUsuario->NewPass=$password;
        $hayUsuario->save();
       

           
        }*/
      
//ejecutar el primer foreach, genera claves aleatorias para cada user, luego ejecutar este foreach hashea. Trabaja sobre la tabla Users
        //esas claves aleatorias de cada usuario
foreach ($users as $user) {
       $password=$user->NewPass;       
        $hayUsuario=User::where("email",$user->email)->first();
         $passwordBase=Hash::make($password);
        $hayUsuario->password=$passwordBase;
            $hayUsuario->save();
       

           
        }





       
}
}

	