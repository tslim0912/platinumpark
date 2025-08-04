<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(["guest:admin" ])->get('/', function () {
    return view('auth.login');
    // return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth:admin']], function () {

    Route::resource("banner", "BannerController");
    Route::resource("bannerImages", "BannerImagesController");
    Route::post("bannerVideo/{banner_id}", "BannerImagesController@storeYoutube")->name("bannerVideo.store");

    Route::resource("posts", "PostController");
    
    Route::get('posts/{post}/create', "PostDetailController@create")->name("post.create");
    Route::post('posts/{post}/store', "PostDetailController@store")->name("post.store");
    Route::get('posts/post/{post}/edit', "PostDetailController@edit")->name("post.edit");
    Route::post('posts/post/{post}/update', "PostDetailController@update")->name("post.update");
    Route::delete('/posts/post/{post}/delete', "PostDetailController@destroy")->name("post.delete");

    Route::get('/admins/{admin}/edit', "AdminController@edit")->name("admin.edit");
    Route::post('/admins/{admin}/update', "AdminController@update")->name("admin.update");
   
});
