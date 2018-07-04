<?php

use App\Creador;
use App\Juego;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*Tags*/
        $tag1 = Tag::create([
            'nombre'=>'zombies',
        ]);
        $tag2 = Tag::create([
            'nombre'=>'defensa',
        ]);
        $tag3 = Tag::create([
            'nombre'=>'dos jugadores',
        ]);
        $tag4 = Tag::create([
            'nombre'=>'puzzle',
        ]);

        /* Usuario adm y creador*/
        $admUser = User::create([
           'name'=>'Admin',
           'email'=>'brno_007@hotmail.com',
           'password'=>bcrypt('123456'),
        ]);

        $creadorAdm = Creador::create([
            'user_id'=>1,
            'nombre'=>'KiwiJuegos',
        ]);

        /*Juegos */
        $juego1 =Juego::create([
            'creador_id'=>1,
            'descripcion'=>'Deberás defenderte de oleada tras oleada de zombies y demostrar tu capacidad para la defensa',
            'titulo'=>'Zombie Attack 1',
            'instrucciones'=>'',
            'nombre_server'=>'juego1',
            'fecha_creacion'=>'2018-07-02',
            'avatar'=>'zombieGame.jpg',

        ]);
        $juego2 =Juego::create([
            'creador_id'=>1,
            'descripcion'=>'Juega este clásico juego con tu mejor amigx',
            'titulo'=>'Super Pong',
            'nombre_server'=>'juego2',
            'fecha_creacion'=>'2018-07-02',
            'instrucciones'=>'',
            'avatar'=>'superPong.png',
        ]);
        $juego3 =Juego::create([
            'creador_id'=>1,
            'descripcion'=>'Demuestra tu ingenio a medida que se te presenten diversos retos que quizás tu cerebro no pueda manejar',
            'titulo'=>'Multi-Puzzle',
            'nombre_server'=>'juego3',
            'fecha_creacion'=>'2018-07-02',
            'avatar'=>'puzzle.jpg',
            'instrucciones'=>'',
        ]);

        //Asocio el juego de zombies con el tag "zombie" y el "defensa"
        $juego1->tags()->attach([1,2]);
        //al de pong el tag "dos jugadores"
        $juego2->tags()->attach(3);
        //al puzzle el de "puzzle"
        $juego3->tags()->attach(4);

    }
}
