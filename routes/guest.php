<?php

// register

Route::get('register', [

    'uses' => 'RegisterController@create',
    'as' => 'register'

]);

Route::post('register', [

    'uses' => 'RegisterController@store'

]);


// login

Route::get('login', [

    'uses' => 'LoginController@create',
    'as' => 'login'

]);

Route::post('login', [

    'uses' => 'LoginController@store',

]);
