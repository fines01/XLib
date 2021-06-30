<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/test', function () {
    return view('layouts.main');
});

Auth::routes();

// Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('home', 'HomeController@index')->name('home');
//
// Route::resources([
//     'categories' => CategoryController::class,
//     'books' => TitleUserController::class,
//     'users' => UserController::class,
// ]);
//
Route::resource('/categories', 'CategoryController')->except('show');
Route::resource('/books', 'TitleUserController');
Route::resource('/users','UserController');//->excpt('index'); ? od mit index (für Admin?)

// AUTOR: index, show
Route::get('/authors', 'AuthorController@index')->name('authors.index');
Route::get('/authors/{author}', 'AuthorController@show')->name('authors.show');
// Autor: **create, store: über item bzw. user_title, **edit, update: über items, **destroy: automatisch wenn keine items mehr vorhanden sind ???

// BUCHUNGEN: index, [create->kein eig Formular, Buchung über button in items liste?], store, show,
Route::get('/bookings', 'BookingController@index')->name('bookings.index');
Route::post('/bookings','BookingController@store')->name('bookings.store');
Route::get('/bookings/{booking}', 'BookingController@show')->name('bookings.show');
// // edit,update,destroy der Buchungen innerhalb eines gewissen Zeitrahmens: Stornos etc. -> ev. später hinzufügen (resource).
// Route::edit('/bookings/{booking}/edit', 'BookingController@edit');
// Route::put('/bookings/{booking}', 'BookingController@update');
// Route::delete('/bookings/{booking}', 'BookingController@destroy');

// STATUS der jew. Bücher:
// create & store (bei Buchung), show (in books show), edit,update,destroy (über Buchung); ev. kein Controller ???????

// TITEL
// index
Route::get('/titles', 'TitleController@index')->name('titles.index');
// ***create, store & edit, update, destroy: wenn items hinzugefügt/ gelöscht werden, über items, ***show =-> item.index für jew Titel.