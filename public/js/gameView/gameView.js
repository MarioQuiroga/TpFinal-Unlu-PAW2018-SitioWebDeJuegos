var GameControl ={

    toggleFav: function (element) {
        let gameId = $('meta[name="game-id"]').attr('content');
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/user/favs/toggle/'+gameId,
            type: "get",
            success : function (data) {
                console.log(data);
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
    }

};