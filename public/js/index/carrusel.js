var Carrusel={
    gameIndex: 1,
    mouseOver:false,

    avanzar:function () {
      Carrusel.mover(1);
    },

    mover:function (n) {
        this.mostrarGame(this.gameIndex += n);
    },

    cambiarA:function (n) {
        this.mostrarGame(this.gameIndex = n);
    },

    mostrarGame:function (n) {
        var i;
        var games = document.getElementsByClassName("feat-game");
        var dots = document.getElementsByClassName("carrusel-dot");
        if (n > games.length) {this.gameIndex = 1}
        if (n < 1) {this.gameIndex = games.length}
        //oculto todos los juegos y los dots
        for (i = 0; i < games.length; i++) {
            games[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        // visualizo el juego
        games[this.gameIndex-1].style.display = "flex";
        dots[this.gameIndex-1].className += " active";
        //setTimeout(this.mostrarGame(this.gameIndex+1),3000);
    },

    init:function () {

        //Se muestra el primer game
        this.gameIndex=1;
        this.mostrarGame(this.gameIndex);
        //Seteo el timer que mueve el carrusel
        Carrusel.timer=setInterval(function () {
            if(!Carrusel.mouseOver){
                Carrusel.avanzar();
            }
        },3000);

        //agrego los event listener para saber si esta en hover
        $('div#carrusel-imgs').on('mouseover',function () {
            Carrusel.mouseOver=true;
        });
        $('div#carrusel-imgs').on('mouseout',function () {
            Carrusel.mouseOver=false;
        })
    },
};

