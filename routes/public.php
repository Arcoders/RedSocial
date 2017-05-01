<?php


// Routa home para listar las preguntas

Route::get('/', [

    'uses' => 'PostController@index',
    'as' => 'posts.index'

]);

Route::get('/home', 'HomeController@index');


// Routa para ver la pregunta con slug

Route::get('posts/{post}-{slug}', [

    'uses' => 'PostController@show',
    'as' => 'posts.show'

])->where('post', '\d+');
