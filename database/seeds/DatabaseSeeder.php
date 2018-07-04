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
        $tag5= Tag::create([
            'nombre'=>'plataforma',
        ]);
        $tag6= Tag::create([
            'nombre'=>'musica',
        ]);
        $tag7= Tag::create([
            'nombre'=>'carreras',
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
            'avatar'=>'pongAvt.jpg',
        ]);
        $juego3 =Juego::create([
            'creador_id'=>1,
            'descripcion'=>'Demuestra tu ingenio a medida que se te presenten diversos retos que quizás tu cerebro no pueda manejar',
            'titulo'=>'Multi-Puzzle',
            'nombre_server'=>'juego3',
            'fecha_creacion'=>'2018-07-02',
            'avatar'=>'puzzleAvt.jpg',
            'instrucciones'=>'',
        ]);
        $juego4 =Juego::create([
            'creador_id'=>1,
            'descripcion'=>'mantén el pájaro con vida a lo largo de los niveles',
            'titulo'=>'Flapmmo',
            'nombre_server'=>'juego4',
            'fecha_creacion'=>'2018-07-02',
            'avatar'=>'juego4.png',
            'instrucciones'=>'',
        ]);
        $juego5 =Juego::create([
            'creador_id'=>1,
            'descripcion'=>'Diviertete con los discos que tenemos para ti',
            'titulo'=>'GimmeGimmeRecords',
            'nombre_server'=>'juego5',
            'fecha_creacion'=>'2018-07-02',
            'avatar'=>'juego5.jpg',
            'instrucciones'=>'',
        ]);
        $juego6 =Juego::create([
            'creador_id'=>1,
            'descripcion'=>'listo para las carreras?',
            'titulo'=>'SC racing',
            'nombre_server'=>'juego6',
            'fecha_creacion'=>'2018-07-02',
            'avatar'=>'juego6.png',
            'instrucciones'=>'',
        ]);

        //Asocio el juego de zombies con el tag "zombie" y el "defensa"
        $juego1->tags()->attach([$tag1->id,$tag2->id]);
        //al de pong el tag "dos jugadores"
        $juego2->tags()->attach($tag3->id);
        //al puzzle el de "puzzle"
        $juego3->tags()->attach($tag4->id);
        // y a los otros su respectivos
        $juego4->tags()->attach($tag5->id);
        $juego5->tags()->attach($tag6->id);
        $juego6->tags()->attach($tag7->id);

    }
}
