<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','PagesController@home');
Route::get('admin','AdminController@index')->name('dashboard');

Route::get('blog/{post}','PostsController@show')->name('posts.show');

Route::get('categories/{category}','CategoriesController@show')->name('categories.show');

// Ruta de etiquetas.

Route::get('tags/{tag}','TagsController@show')->name('tags.show');




Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' =>'auth'], function(){
	/*

	Prefix     : Para entrar en la URL admin/posts . Con esto ya no es necesario
				 poner todo el nombre, porque ya fue puesto en el prefijo

	NameSpace  : Para la carpeta del controlador . con esto ya no es necesario
				 ya no es necesario poner toda la url donde se encuntra el controllador, porque ya fue especificado.

	Middleware : Para que solo Autenticados se puedan logear

	*/

	Route::get('posts','PostsController@index')->name('admin.posts.index');

	Route::get('posts/create','PostsController@create')->name('admin.posts.create');

	Route::post('posts','PostsController@store')->name('admin.posts.store');

    Route::get('posts/{post}','PostsController@edit')->name('admin.posts.edit');

    Route::delete('posts/{post}','PostsController@destroy')->name('admin.posts.destroy');




     //put es para hacer actualizaciones
    Route::put('posts/{post}','PostsController@update')->name('admin.posts.update');


    //para las fotos guardarlas

     Route::post('posts/{post}/photos','PhotosController@store')->name('admin.posts.photos.store');

     //para borrar fotos

     Route::delete('photos/{photo}','PhotosController@destroy')->name('admin.photos.destroy');


});



// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');






