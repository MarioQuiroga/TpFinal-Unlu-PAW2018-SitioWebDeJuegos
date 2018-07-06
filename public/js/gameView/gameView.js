var GameControl ={

    init:function () {
        $('button#btn-comentar').on('click', function (e) {
            e.preventDefault();
            let comment = $('textarea#txt-comment').val();
            $('textarea#txt-comment').val('');
            let gameId = $('meta[name="game-id"]').attr('content');
            if(comment!==''){
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '/newComment/game/'+gameId,
                    type: "get",
                    data: {
                        'comment':comment,
                    },
                    dataType: 'json',
                    success : function (data) {
                        if(data.success){
                            console.log('vamoo');
                            let comentarioDiv = $('<div>').addClass('comentario');
                            let commentUserDiv = $('<div>').addClass('comment-user');
                            let spanName = $('<span>',{
                                'text':data.userName,
                            }).addClass('username');
                            let img = $('<img>').attr('src',data.avatarUrl);
                            img.addClass('comment-avatar');
                            commentUserDiv.append(spanName,img);
                            let divComentContent = $('<div>').addClass('comment-content');
                            let p = $('<p>',{
                                'text':data.comment.contenido,
                            });
                            divComentContent.append(p);
                            let spanFecha = $('<span>',{
                                'text':data.fechaDiff,
                            }).addClass('fecha-comment');
                            comentarioDiv.append(commentUserDiv,divComentContent,spanFecha);
                            $('section#comentarios-cont').prepend(comentarioDiv);

                        }


                    }
                });
            }
        })

    },

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