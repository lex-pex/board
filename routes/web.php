<?php
/* ---------
| Web Routes
| Here is where you can register web routes for the application
| These routes are loaded by the RouteServiceProvider within a
| group which contains the "web" middleware group
*/

Route::get('/', 'IndexController@index');
Route::get('/show/{id}', 'IndexController@show')->name('adShow');
Route::get('/edit/{id}', 'AdController@edit')->name('adEdit');

Route::get('/ad/create', 'AdAddController@create')->name('adCreate');
Route::post('/ad', 'AdAddController@store')->name('adStore');
Route::get('/ad/{id}/edit', 'AdController@edit')->name('adEdit');
Route::post('/ad/{ad}', 'AdController@update')->name('adUpdate');
Route::delete('/ad/{ad}', 'AdController@destroy')->name('adDelete');

Route::post('/comments/index', 'CommentsController@index');
Route::post('/comment/store', 'CommentsController@store');
Route::post('/comment/update', 'CommentsController@update');
Route::post('/comment/destroy', 'CommentsController@destroy');

Route::post('/rating/index', 'RatingController@index');
Route::post('/rating/store', 'RatingController@store');
Route::post('/rating/update', 'RatingController@update');
Route::post('/rating/destroy', 'RatingController@destroy');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/edit', 'HomeController@edit')->name('userEdit');
Route::post('/home/{user}', 'HomeController@update')->name('userUpdate');
Route::delete('/home/{user}', 'HomeController@destroy')->name('userDelete');
