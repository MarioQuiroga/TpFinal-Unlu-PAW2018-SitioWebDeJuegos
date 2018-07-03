$(document).ready(function() {
    var gameIndex = 1;
    mostrarGame(gameIndex);

    function mover(n) {
        mostrarGame(gameIndex += n);
    }

    function cambiarA(n) {
        mostrarGame(gameIndex = n);
    }

    function mostrarGame(n) {
        var i;
        var games = document.getElementsByClassName("feat-game");
        var dots = document.getElementsByClassName("carrusel-dot");
        if (n > games.length) {gameIndex = 1}
        if (n < 1) {gameIndex = games.length}
        for (i = 0; i < games.length; i++) {
            games[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        games[gameIndex-1].style.display = "block";
        dots[gameIndex-1].className += " active";
    }

});


