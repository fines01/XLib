<?php

use App\Mail\BookingMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
Route::resource('/users','UserController')->except('create','store'); 
Route::resource('/authors', 'AuthorController');

//Search-page:
Route::get('/search', 'TitleController@search');

// Autor: **create, store: über item bzw. user_title, **edit, update: über items, **destroy: automatisch wenn keine items mehr vorhanden sind

// BUCHUNGEN:
Route::get('/bookings', 'BookingController@index')->name('bookings.index');
Route::get('/bookings/order/{title}/{user}','BookingController@makeBooking')->name('bookings.place'); 
Route::post('/bookings','BookingController@store')->name('bookings.store');
Route::get('/bookings/{booking}', 'BookingController@show')->name('bookings.show');
Route::delete('/bookings/{booking}', 'BookingController@destroy')->name('bookings.destroy');
// Route::edit('/bookings/{booking}/edit', 'BookingController@edit');
// Route::put('/bookings/{booking}', 'BookingController@update');

// STATUS der jew. Bücher:
// create & store (bei Buchung), show (in books show), edit,update,destroy (über Buchung); ev. kein Controller ???????

// TITEL
Route::get('/titles', 'TitleController@index')->name('titles.index');
Route::get('/titles/{title}', 'TitleController@show')->name('titles.show');
// ***create, store & edit, update, destroy: wenn items hinzugefügt/ gelöscht werden, über items, ***show =-> item.index für jew Titel.

//Test: Mail 
// Route::get('/email', function() {
//     $data=[
//         'user' => 'XYZ',
//         'title' => 'TITLE'
//     ];
//     Mail::to('ines.fritsch@gmail.com')->send( new BookingMail($data) );
//     return new BookingMail($data);
// });