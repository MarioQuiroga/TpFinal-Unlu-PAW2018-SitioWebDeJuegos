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

use App\Juego;
use App\Tag;
use Illuminate\Support\Facades\Auth;


/* --- INDEX --- */
Route::get('/', function (){
    $featured = Juego::getFeaturedGames();
    $hots = Juego::getHotGames();
    $juegos = Juego::orderBy('fecha_creacion','desc')->simplePaginate(9);
    $mainTags = Tag::getMainTags();
    return view('index')->with(compact('featured'))
        ->with(compact('hots'))
        ->with(compact('juegos'))
        ->with(compact('mainTags'));
});
//Ajax request del buscador de juegos
Route::get('/games/search','HomeController@search');
Route::get('/games/filter', 'HomeController@filter');




/* --- Auth con otras aplicaciones, google, facebook etc -----*/
Route::get('login/{provider}/redirect','Auth\LoginController@redirect');
Route::get('login/{provider}/callback','Auth\LoginController@callback');

/*--------------
|   Juegos
|---------------
|
*/
Route::get('/game/{name}','JuegoController@show');


Auth::routes();
/*
 */
Route::get('juegos/{id}/score','JugadaController@update');


//ajax toggle favorito
Route::get('user/favs/toggle/{game}','UserController@toggleFav');
//ajax rating
Route::post('user/rating/{game}', 'UserController@updateRating');
// ajax post comment
Route::get('newComment/game/{game}','ComentarioController@store');


/*--- Perfil de Usuario ---*/
Route::get('user/{id}','UserController@show')->name('perfil');

Route::get('user/edit/{id}', 'UserController@edit');
Route::post('user/edit/{id}', 'UserController@update');

/*--- Perfil de Desarrollador ---*/

Route::get('register/dev/{id}', 'CreadorController@create'); //Registrarse como desarrollador
Route::post('register/dev/{id}', 'CreadorController@store'); //Registrarse como desarrollador

Route::get('dev/edit/{id}', 'CreadorController@edit'); //Editar perfir desarrollador
Route::post('dev/edit/{id}', 'CreadorController@update'); //Editar perfir desarrollador

Route::get('dev/{id}', 'CreadorController@show'); //Perfil desarrollador


/*--- Juegos ---*/
Route::get('games/{id}','JuegoController@show');

Route::get('games/create/{id}', 'JuegoController@create' );
Route::post('games/create/{id}', 'JuegoController@store' );


/*--- Descarga Template de Juego ---*/
Route::get('download/template/game', 'HomeController@download');

/*Route::get('/home', 'HomeController@index')->name('home');*/
