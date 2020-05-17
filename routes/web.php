<?php

use Illuminate\Support\Facades\Route;
use Barryvdh\Debugbar\Facade as Debugbar;

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

// Route::get('/{any}', 'SinglePageController@index')->where('any', '.*');

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::group(array('domain' => 'http://localhost:8000/'), function()
// {
//    Debugbar::disable();
// });

Route::get('profile', ['middleware' => 'auth', function()
{
   // Only authenticated users may enter...
   $user = Auth::user();
   unset($user->email_verified_at);
   // unset($user->id);
   // print($user);
   return view('profile', ['user' => $user]);

}])->name('profile');
