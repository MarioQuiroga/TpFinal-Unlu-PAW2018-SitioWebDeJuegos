var Carrusel={
    gameIndex: 1,

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

        this.gameIndex=1;
        this.mostrarGame(this.gameIndex);
        setInterval(this.avanzar,3000);
    },
};

