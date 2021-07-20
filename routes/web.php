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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::group(['namespace' => 'App\Http\Controllers'], function() {
    Route::get('/', 'BlogController@index')->name('home');
    Route::get('/read/{post_id}', 'BlogController@read')->name('read-post');

    Route::post('/subscribe','BlogController@subscribe')->name('subscribe');

});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::group(['namespace' => 'App\Http\Controllers'], function() {
        Route::get('/dashboard', 'PostController@index')->name('dashboard');
        Route::get('/post/read/{post_id}', 'PostController@view')->name('view-post');
        
        Route::get('/post/new', 'PostController@create')->name('create-post');
        Route::get('/post/{post_id}/edit', 'PostController@edit')->name('edit-post');
        
        Route::post('/post/submit', 'PostController@submit')->name('submit-post');
        Route::post('/post/update', 'PostController@update')->name('update-post');
        Route::post('/post/delete', 'PostController@delete')->name('delete-post');
    });
});

require __DIR__.'/auth.php';
