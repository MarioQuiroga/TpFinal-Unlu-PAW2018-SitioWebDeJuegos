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

use Illuminate\Support\Facades\Auth;



Route::get('/', 'HomeController@index');



/* --- Auth con otras aplicaciones, google, facebook etc -----*/
Route::get('login/{provider}/redirect','Auth\LoginController@redirect');
Route::get('login/{provider}/callback','Auth\LoginController@callback');


Auth::routes();
/*
 */
Route::post('juegos/{id}/score','JugadaController@update');



/*Route::get('/home', 'HomeController@index')->name('home');*/
