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



Route::get('/', function () {
    return view('home');
});



/* --- Auth google -----*/
Route::get('login/{provider}/redirect','Auth\LoginController@redirect');
Route::get('login/{provider}/callback','Auth\LoginController@callback');


Auth::routes();
/*
 */
Route::post('juegos/{id}/score','JugadaController@update');


/*--- Perfil de Usuario ---*/
Route::get('user/{id}','UserController@show');

Route::get('user/edit/{id}', 'UserController@edit');
Route::post('user/edit/{id}', 'UserController@update');

Route::get('register/dev/{id}', 'CreadorController@create'); //Registrarse como desarrollador
Route::get('userDev/edit/{id}', 'CreadorController@edit'); //Editar perfir desarrollador
Route::post('userDev/edit/{id}', 'CreadorController@update'); //Editar perfir desarrollador


/*--- Juegos ---*/
Route::get('juegos/{id}','JuegoController@show');


/*Route::get('/home', 'HomeController@index')->name('home');*/
