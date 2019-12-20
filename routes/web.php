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
  Auth::routes();

  Route::get('/', 'HomeController@index')->name('home');


// Admin Ultilities

  Route::group(['middleware' => ['activeUser']], function () {
    Route::get('/admin', 'AdminController@index')->name('admin');

    // Admin Post
    Route::get('/admin/posts', 'AdminPostsController@index')->name('admin_posts');
    Route::get('/admin/posts/create', 'AdminPostsController@create')->name('admin_posts.create');
    Route::Post('/admin/posts', 'AdminPostsController@store')->name('admin_posts.store');
    Route::get('/admin/posts/{post}', 'AdminPostsController@show')->name('admin_posts.show');
    Route::get('/admin/posts/{post}/edit', 'AdminPostsController@edit')->name('admin_posts.edit');
    Route::patch('/admin/posts/{post}', 'AdminPostsController@update')->name('admin_posts.update');
    Route::delete('/admin/posts/{post}', 'AdminPostsController@destroy')->name('admin_posts.destroy');

  });

// Admin User
  Route::group(['middleware' => ['activeUser', 'admin']], function () {
    Route::get('/admin/categories', 'AdminController@index')->name('admin_categories');
    Route::get('/admin/site', 'AdminController@index')->name('admin_site');
    // Users Controller
    Route::get('/admin/users', 'AdminUsersController@index')->name('admin_users');
    Route::get('/admin/users/create', 'AdminUsersController@create')->name('admin_users.create');
    Route::Post('/admin/users', 'AdminUsersController@store')->name('admin_users.store');
    Route::get('/admin/users/{user}', 'AdminUsersController@show')->name('admin_users.show');
    Route::get('/admin/users/{user}/edit', 'AdminUsersController@edit')->name('admin_users.edit');
    Route::patch('/admin/users/{user}', 'AdminUsersController@update')->name('admin_users.update');
    Route::delete('/admin/users/{user}', 'AdminUsersController@destroy')->name('admin_users.destroy');

  });
