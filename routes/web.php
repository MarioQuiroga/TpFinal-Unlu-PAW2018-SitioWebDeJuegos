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


/* --- INDEX --- */
Route::get('/', 'HomeController@index');
//Ajax request del buscador de juegos
Route::get('/games/search','HomeController@search');


/* --- Auth con otras aplicaciones, google, facebook etc -----*/
Route::get('login/{provider}/redirect','Auth\LoginController@redirect');
Route::get('login/{provider}/callback','Auth\LoginController@callback');


Auth::routes();
/*
 */
Route::post('juegos/{id}/score','JugadaController@update');


/*--- Perfil de Usuario ---*/
Route::get('user/{id}','UserController@show')->name('perfil');

Route::get('user/edit/{id}', 'UserController@edit');
Route::post('user/edit/{id}', 'UserController@update');

/*--- Perfil de Desarrollador ---*/

Route::get('register/dev/{id}', 'CreadorController@create'); //Registrarse como desarrollador
Route::post('register/dev/{id}', 'CreadorController@store'); //Registrarse como desarrollador

Route::get('dev/edit/{id}', 'CreadorController@edit'); //Editar perfir desarrollador
Route::post('dev/edit/{id}', 'CreadorController@update'); //Editar perfir desarrollador

Route::get('dev/{id}', 'CreadorController@show'); //Registrarse como desarrollador

/*--- Juegos ---*/
Route::get('juegos/{id}','JuegoController@show');


/*Route::get('/home', 'HomeController@index')->name('home');*/
