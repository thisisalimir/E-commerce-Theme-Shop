<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//main route for go to index
Route::get('/',[
  'uses' => 'ProductController@getIndex',
  'as'   => 'product.index'
]);

//Sign up Route

Route::get('/signup',[
  'uses' => 'UserController@getSignUp',
  'as'   => 'user.signup'
]);

Route::post('/signup',[
  'uses' => 'UserController@postSignUp',
  'as'   => 'user.signup'
]);

Route::get('/login',[
   'uses' => 'UserController@getLogIn',
   'as'   => 'user.login'
]);

Route::post('/login',[
   'uses' => 'UserController@postLogIn',
   'as'   => 'user.login'
]);

Route::get('/user/profile',[
    'uses' => 'UserController@getProfile',
    'as'   => 'user.profile'
]);
