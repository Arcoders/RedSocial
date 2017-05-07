<?php


// Routa home para listar las preguntas


Route::get('/home', 'HomeController@index');

// Routa para ver la pregunta con slug

Route::get('posts/{post}-{slug}', [

    'uses' => 'ShowPostController',
    'as' => 'posts.show'

])->where('post', '\d+');

Route::get('posts-pendientes/{category?}', [

    'uses' => 'ListPostController',
    'as' => 'posts.pending'

]);

Route::get('posts-completados/{category?}', [

    'uses' => 'ListPostController',
    'as' => 'posts.completed'

]);

Route::get('{category?}', [

    'uses' => 'ListPostController',
    'as' => 'posts.index'

]);
