<?php

namespace App\Http\Controllers\Auth;

use App\User;  
use Illuminate\Http\Request;  
use App\Http\Controllers\Controller;  
use Illuminate\Support\Facades\Hash;  
   
class ChangePasswordController extends Controller  
{  
  public function __construct()  
  {  
    $this->middleware('auth');  
  }  
   
  //show form:  
  public function showChangePasswordForm(Request $request, User $user)  
  {  
    return view('auth.passwords.change')->with(  
      ['user' => $user]  
    );  
  }  
   
  public function change(Request $request)  
  {  
    //Get current user data:  
    //$user = auth()->user();  
   
    //Validation:  
    $this->validate($request, [  
      'password'     => 'required|min:6|confirmed',  
      'current_password' => 'isCurrentPassword' ,  
    ]);  
   
    $request->user()->fill([  
      'password' => Hash::make($request->password)  
    ])->save();  
   
    return redirect('home')->with('message','La Contraseña se modificó con exito!');  
  }  
   
   
}  
