var GameControl ={

    toggleFav: function (element) {
        let gameId = $('meta[name="game-id"]').attr('content');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/user/favs/toggle/'+gameId,
            type: "get",
            success : function (data) {
                if(!data.error){
                    if(data.estado){
                        //es favorito
                        $('img#fullHeart').show();
                        $('img#emptyHeart').hide();
                    } else
                    {
                        //no es favorito
                        $('img#fullHeart').hide();
                        $('img#emptyHeart').show();

                    }
                }
            }
        });
    },

    updateRating: function (element) {
        let rating = element.value;
        let gameId = $('meta[name="game-id"]').attr('content');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/user/rating/'+gameId,
            type: "post",
            dataType: 'json',
            data: {
              rating:rating,
            },
            success : function (data) {

            }
        });
    }



};