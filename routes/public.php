<?php


// Routa home para listar las preguntas


Route::get('/home', 'HomeController@index');

// Routa para ver la pregunta con slug

Route::get('posts/{post}-{slug}', [

    'uses' => 'PostController@show',
    'as' => 'posts.show'

])->where('post', '\d+');

Route::get('posts-pendientes', [

    'uses' => 'PostController@index',
    'as' => 'posts.pending'

]);

Route::get('posts-completados', [

    'uses' => 'PostController@index',
    'as' => 'posts.completed'

]);

Route::get('{category?}', [

    'uses' => 'PostController@index',
    'as' => 'posts.index'

]);
