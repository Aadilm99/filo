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
// Route set to root which will send user to the home page and display that
Route::get('/', 'PagesController@home');
Auth::routes();

// Route set to GET home which will send user to the main dashboard page where they can view their posts/dashboard
Route::get('/home', 'HomeController@index')->name('home');

// Route set to  GET post which will send user to the create post page/form - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/post', 'PostsController@post')->middleware('auth');

// Route set to GET profile which will send user to the create post page/form - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/profile', 'ProfileController@profile')->middleware('auth');

// Route set to GET category which will send user to the create/ adding category items - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/category', 'CategoriesController@category')->middleware('auth');

// Route set to POST the add Category which create/adds category items - auth applied here since we don't want guests etc. to access other pages without logging in
Route::post('/addCategory', 'CategoriesController@addCategory')->middleware('auth');

// Route set to POST add Profile which create/adds profile - auth applied here since we don't want guests etc. to access other pages without logging in
Route::post('/addProfile', 'ProfileController@addProfile')->middleware('auth');

// Route set to POST, add Post which create/submits the post form - auth applied here since we don't want guests etc. to access other pages without logging in
Route::post('/addPost', 'PostsController@addPost')->middleware('auth');

// Route set to GET the specific post view - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/view/{id}', 'PostsController@viewPost');

// Route set to GET the specific post to edit by the specified user - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/edit/{id}', 'PostsController@edit')->middleware('auth');

// Route set to POST, edit post which updates the form - auth applied here since we don't want guests etc. to access other pages without logging in
Route::post('/editPost/{id}', 'PostsController@editPost')->middleware('auth');

// Route set to GET the specific post to delete by the specified user - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/delete/{id}', 'PostsController@deletePost')->middleware('auth');

// Route set to GET the specific category for the posts - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/category/{id}', 'PostsController@category');

// Route set to GET the specific request - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/request/{id}', 'RequestsController@request')->middleware('auth');
// Route set to GET, which craetes the specific request - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/requests/create/{id}', 'RequestsController@makeRequest')->middleware('auth');
// Route set to POST, sends the request - auth applied here since we don't want guests etc. to access other pages without logging in
Route::post('/addRequest', 'RequestsController@addRequest')->middleware('auth');
// Route set to GET, this is the requests page for where the users can view their requests made - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/myRequests', 'PagesController@userRequests')->middleware('auth');

// Route set to GET, approves the request which is made by the Admin - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/requests/approved/{id}', 'RequestsController@approveRequest')->middleware('auth');
// Route set to GET, refuses the request which is made by the Admin - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/requests/refused/{id}', 'RequestsController@refuseRequest')->middleware('auth');
// Route set to GET, sends apporved email by the Admin - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/email/approved/{id}', 'RequestsController@emailApprovedRequest')->middleware('auth');
// Route set to GET, sends refused email by the Admin - auth applied here since we don't want guests etc. to access other pages without logging in
Route::get('/email/refused/{id}', 'RequestsController@emailrefuseRequest')->middleware('auth');


