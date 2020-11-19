<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
/* Route::get('/home', 'HomeController@index')->name('home'); */
Route::group(['middleware' => ['auth','admin']], function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('/role-register','Admin\DashboardController@index');
    Route::get('/role-edit/{id}','Admin\DashboardController@show');
    Route::get('/role-update/{id}','Admin\DashboardController@roleupdate');
    Route::get('/role-delete/{id}',"Admin\DashboardController@delete");
});

Route::get('/blogs', 'Blogs\Blogscontroller@index')->name('blogs');
Route::name('store_blog_path')->post('/blogs','Blogs\Blogscontroller@store');
Route::name('create_blog_path')->get('/blogs/create','Blogs\Blogscontroller@create');
Route::name('blogs_path')->get('/blogs', 'Blogs\Blogscontroller@index');
Route::name('blog_path')->get('/blogs/{id}','Blogs\Blogscontroller@show');
Route::name('edit_blog_path')->get('/blogs/{id}/edit','Blogs\Blogscontroller@edit');
Route::name('update_blog_path')->put('/blogs/{id}','Blogs\Blogscontroller@update');
Route::name('delete_blog_path')->get('/blogs/{id}/delete','Blogs\Blogscontroller@delete');
Route::name('destroy_blog_path')->delete('/blogs/{id}','Blogs\Blogscontroller@destroy');
Route::name('category.search')->post('','Blogs\Blogscontroller@categorysearch');
Route::name('title.search')->put('/blogs','Blogs\Blogscontroller@titlesearch');
Route::name('dashboard')->get('/dashboard', function () {
    return view('admin.dashboard');
});
Route::name('welcome')->get('welcome', function () {
    return view('welcome');
});


Route::name('categories.index')->get('/categories', 'CategoryController@index');
Route::name('categories.store')->post('/categories','CategoryController@store');
Route::name('categories.update')->put('/categories/{id}','CategoryController@update');
Route::name('categories.show')->get('/categories/{id}','CategoryController@show');
Route::name('categories.delete')->delete('/categories/{id}','CategoryController@destroy');

Route::get('search','Admin\DashboardController@search');
