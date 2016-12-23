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

//product route
Route::get('/add/{id}',[
   'uses' => 'ProductController@getAddToCart',
   'as'   => 'product.add'
]);

Route::get('/shopping-cart',[
  'uses' => 'ProductController@getCart',
  'as' => 'product.shoppingCart'
]);





//Sign up Route
Route::group(['prefix'=>'user'],function(){

   Route::group(['middleware'=>'guest'],function(){
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

   });

Route::group(['middleware'=>'auth'],function(){

    Route::get('/profile',[
        'uses' => 'UserController@getProfile',
        'as'   => 'user.profile'
    ]);

    Route::get('/logout',[
        'uses' => 'UserController@getLogOut',
        'as'   => 'user.logout'
    ]);

    //Paymetn Route
    Route::get('/checkout',[
       'uses' => 'ProductController@getCheckhOut',
       'as'    => 'checkout'
    ]);
    Route::post('/checkout',[
        'uses' =>  'ProductController@postCheckOut',
        'as'   =>  'checkout'
    ]);

  });
});
