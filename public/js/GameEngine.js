var GameEngine={

    /*Publish Score
    * funcion utilizada por los juegos para publicar el puntaje de una jugada
    *
    * */
  publishScore: function (score) {
      let user = $("#user");
      let game = $('#juego');
      let postData = {
        user: user.val(),
        game: game.val(),
        score: score,
      };
      $.ajax({
         type :'post',
          url :'juegos/'+ game +'/score',
          data : postData,
          dataType: 'json',
          success :  function (result) {
             //si falla
              if(result.error.name){
                  //avisar que no se guarda el puntaje
              }
          }
      });
  }
};