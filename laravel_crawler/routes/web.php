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

Route::get('bai-viet/search','HomeController@search')->name('get.search');
Route::get('/','HomeController@index')->name('get.home');
Route::get('bai-viet','BlogController@index')->name('get.blog');
Route::get('bai-viet/{slug}','BlogHubController@render')->name('get_blog.render');

Route::get('gioi-thieu.html','AboutController@index')->name('get.about');
//Route::get
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

include 'web_admin.php';

Route::get('demo', function(){
	return view('demo');
});
