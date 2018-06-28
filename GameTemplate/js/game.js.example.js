var Game={

    postScore: function () {
        let puntaje = $('#puntaje');
        GameEngine.publishScore(puntaje);
    }

};