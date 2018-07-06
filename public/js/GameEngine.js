var GameEngine={

    /*Publish Score
    * funcion utilizada por los juegos para publicar el puntaje de una jugada
    *
    * */
  publishScore: function (score, callback) {
      let game = $('meta[name="game-id"]').attr('content');
      let postData = {
        game: game,
        score: score,
      };
      console.log('por hacer ajax');
      $.ajax({
         type :'get',
          header: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url :'/juegos/'+ game +'/score',
          data : postData,
          dataType: 'json',
          success :  function (result) {
             //si falla
              console.log('done');
              if(result.error.name){
                  //avisar que no se guarda el puntaje
              }
              if(typeof callback==='function'){
                  callback(result);
              }
          }
      });
  }
};