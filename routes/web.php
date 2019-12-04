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



Route::view('/', 'home');
Route::view('register', 'auth.register');

Route::view('/imageGallery', 'imageGallery');
Route::get('/showImage/{post}', 'publicGalleryController@show')->name('public.show');
Route::view('/mediaGallery', 'mediaGallery');

Route::get('/profile/show/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::get('/profile/show/{user}', 'ProfilesController@index')->name('profile.show');
Route::patch('/profile/edit/{user}', 'ProfilesController@update')->name('profile.update');

Route::get('/posts/show/{user}', 'PostsController@show')->name('posts.show');
Route::get('/posts/{post}/edit', 'PostsController@edit')->name('posts.edit');
Route::get('/posts/{post}', 'PostsController@showPost')->name('posts.showPost');
Route::get('/posts/create/{user}', 'PostsController@create')->name('posts.create');
Route::patch('/posts/update', 'PostsController@update')->name('posts.update');
Route::post('/posts/delete', 'PostsController@destroy')->name('posts.destroy');
Route::post('/posts', 'PostsController@store')->name('posts.store');

Route::get('/media/show/{media}/edit', 'MediaController@edit')->name('media.edit');//we get here from media/show.blade which returns media/edit.blade
Route::get('/media/show/{user}', 'MediaController@show')->name('media.show');
Route::get('/media/create/{user}', 'MediaController@create')->name('media.create');
Route::patch('/media/update', 'MediaController@update')->name('media.update');//we get to here from media/edit.blade which executes update and redirects to media/show.blade
Route::get('/media/download{media}', 'MediaController@download')->name('media.download');
Route::post('/media', 'MediaController@store')->name('media.store');
Route::delete('/media', 'MediaController@destroy')->name('media.destroy');

Route::get('/cart', 'CartController@show')->name('cart.show');
Route::get('/cart/addToCart/{id}', 'CartController@add')->name('cart.add');
Route::get('/cart/removeFromCart/{id}', 'cartController@destroy')->name('cart.destroy');
Route::get('/checkout', 'CartController@checkout')->name('checkout');
Route::post('/postCheckout', 'CartController@postCheckout')->name('postCheckout');
Route::get('/shop/downloads', 'CartController@downloads')->name('shop.downloads');

Route::get('staffHomepage', 'StaffController@home');

Route::get('/home', 'HomeController@home')->name('home');
Route::get('/index', 'HomeController@index')->name('index');

Auth::routes();
