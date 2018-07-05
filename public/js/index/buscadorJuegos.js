var BuscadorJuegos={

    imgSrc:null,
    init:function () {
        BuscadorJuegos.imgSrc=$('meta[name="src-imgs"]').attr('content');
    },

    buscar:function (element) {
        if(event.key=='Enter'){
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "/games/search",
                type: "get",
                data: {
                    searchGame: element.value,
                },
                dataType:'json',
                success : function (data) {
                    console.log(data);
                    if(data){
                        BuscadorJuegos.vaciarMosaico();
                        BuscadorJuegos.llenarMosaico(data);
                    }
                }
            });

        }
    },

    vaciarMosaico:function () {
        $('div#mosaico-buscador>div.game-box').each(function () {
            $(this).remove();
        })
    },

    llenarMosaico:function (games) {
        let mosaico = $('div#mosaico-buscador');
        //Por cada juego
       games.forEach(function (game) {
           //creo el game-box del juego
           let gameBox = $('<div></div>');
           gameBox.addClass('game-box');
           //creo el div de la imagen y agrego la imagen
           let gameBoxImg =$('<div></div>');
           gameBoxImg.addClass('game-box-img');
           let src = BuscadorJuegos.imgSrc+'/'+game.nombre_server+'/'+game.avatar;
           console.log(src);
           gameBoxImg.append($('<img>').attr('src',src));
           // creo el titulo
           let titulo = $('<p>').append($('<b>',{
               text: game.titulo,
           }));
           //creo la valoracion
           let valStr = '&#11088; '+game.valoracion_promedio;
           let html = $.parseHTML(valStr);
           let valoracion = $('<span>').addClass('valoracion');
           valoracion.append(html);
           //creo los tags
           let tags = $('<div>').addClass('tags');
           game.tags.forEach(function (tag) {
              let tagElem = $('<span>',{
                  text: tag.nombre,
              }).addClass('tag');
              tags.append(tagElem);
           });
           //agrego los elemento al game-box y el game-box al mosaico
           gameBox.append(gameBoxImg,titulo,valoracion,tags);
           mosaico.append(gameBox);
       })
    },

    tagFilter: function (tagF) {
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/games/filter",
            type: "get",
            data: {
                tag: tagF,
            },
            dataType:'json',
            success : function (data) {
                console.log(data);
                if(data){
                    BuscadorJuegos.vaciarMosaico();
                    BuscadorJuegos.llenarMosaico(data);
                }
            }
        });
    }


};