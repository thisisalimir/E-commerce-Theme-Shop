<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;

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
       // if user came from another page
       if (Session::has('oldUrl')) {
         //we get URL
         $oldUrl = Session::get('oldUrl');
         //and then after redirect we forget it
         Session::forget('oldUrl');
         return redirect()->to($oldUrl);
       }

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
           // if user came from another page
           if (Session::has('oldUrl')) {
             //we get URL
             $oldUrl = Session::get('oldUrl');
             //and then after redirect we forget it
             Session::forget('oldUrl');
             return redirect()->to($oldUrl);
           }
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

        return redirect()->route('user.login');
      }
}
