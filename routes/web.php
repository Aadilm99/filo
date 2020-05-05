<?php

use Illuminate\Support\Facades\Route;
/* use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail; */
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

Route::get('/', 'PagesController@home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/post', 'PostsController@post')->middleware('auth');

Route::get('/profile', 'ProfileController@profile')->middleware('auth');

Route::get('/category', 'CategoriesController@category')->middleware('auth');

Route::post('/addCategory', 'CategoriesController@addCategory')->middleware('auth');

Route::post('/addProfile', 'ProfileController@addProfile')->middleware('auth');

Route::post('/addPost', 'PostsController@addPost')->middleware('auth');

Route::get('/view/{id}', 'PostsController@viewPost');

Route::get('/edit/{id}', 'PostsController@edit')->middleware('auth');

Route::post('/editPost/{id}', 'PostsController@editPost')->middleware('auth');

Route::get('/delete/{id}', 'PostsController@deletePost')->middleware('auth');

Route::get('/category/{id}', 'PostsController@category');

Route::get('/request/{id}', 'RequestsController@request')->middleware('auth');
Route::get('/requests/create/{id}', 'RequestsController@makeRequest')->middleware('auth');
Route::post('/addRequest', 'RequestsController@addRequest')->middleware('auth');


Route::get('/requests/approved/{id}', 'RequestsController@approveRequest')->middleware('auth');
Route::get('/requests/refused/{id}', 'RequestsController@refuseRequest')->middleware('auth');

Route::get('/email/approved/{id}', 'RequestsController@emailApprovedRequest')->middleware('auth');
Route::get('/email/refused/{id}', 'RequestsController@emailrefuseRequest')->middleware('auth');
