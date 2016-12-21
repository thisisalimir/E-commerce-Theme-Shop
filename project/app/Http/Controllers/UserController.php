<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
     public function getSignUp()
     {
       return view('user.signup');
     }
     public function postSignUp(Request $request)
     {
       $this->Validate($request,[
          'email' => 'email|required|unique:users',
          'password' => 'required|min:6'
       ]);

       $user = new User([
         'email' => $request->input('email'),
         'password' => bcrypt($request->input('password')),
       ]);

       $user->save();
       
       Auth::login($user);

       return redirect()->route('user.profile');

     }

     public function getLogIn()
     {
        return view('user.login');
     }

     public function postLogIn(Request $request)
     {
       $this->Validate($request,[
          'email' => 'email|required',
          'password' => 'required|min:6'
       ]);

       if (Auth::attempt([
         'email' => $request->input('email'),
         'password' => $request->input('password'),
         ])) {
          return redirect()->route('user.profile');
       }
       return redirect()->back();
     }

     public function getProfile()
     {
        return view('user.profile');
      }

      public function getLogOut()
      {
        Auth::logout();

        return redirect()->route('product.index');
      }
}
