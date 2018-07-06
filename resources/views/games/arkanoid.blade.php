<style>
    canvas {
        background: #eee;
        display: block;
        /*margin: 0 auto; */
    }
    div.game-div{
        margin-right: auto;
        margin-left: auto;
    }
</style>
<div class="game-div" id="game-div">

    <title>miniArkanoid</title>
    <!--<div>
        <span id="score">0</span>
    </div>

    <button onclick="Game.postScore()">Incrementar Puntaje y Enviar al servidor</button>-->

</div>
<script>
    //Creo el objeto canvas
    //
    function newCanvas(w,h,id){
        let canvas = document.createElement("canvas");
        canvas.setAttribute('width', w);
        canvas.setAttribute('height', h);
        canvas.setAttribute('id', id);
        return canvas;
    }

    function drawScore(ctx, score, x, y) {
        ctx.font = "16px Arial";
        ctx.fillStyle = "#0095DD";
        ctx.fillText("Score: "+score, x, y);
    }

    function drawLives(ctx, lives, x, y) {
        ctx.font = "16px Arial";
        ctx.fillStyle = "#0095DD";
        ctx.fillText("Lives: "+lives, x, y);
    }

    function remove(div){
        while (div.firstChild) {
            div.removeChild(div.firstChild);
        }
    }

    class Ball {
        constructor(x, y, radio, color){
            this.x = x;
            this.y = y;
            this.radio = radio;
            this.color = color;
        }

        //ctx: contexto canvas
        drawBall(ctx) {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radio, 0, Math.PI*2);
            ctx.fillStyle = this.color;
            ctx.fill();
            ctx.closePath();
        }

    }

    class Paddle {
        constructor(w,h,x,y,color){
            this.width = w;
            this.height = h;
            this.x = x;
            this.y = y;
            this.color = color;
        }

        //ctx: contexto canvas
        drawPaddle(ctx) {
            ctx.beginPath();
            ctx.rect(this.x, this.y, this.width, this.height);
            ctx.fillStyle = this.color;
            ctx.fill();
            ctx.closePath();
        }
    }

    class Bricks{
        constructor(rowCount,columnCount,width,height,padding,offsetTop,offsetLeft){
            this.rowCount = rowCount;
            this.columnCount = columnCount;
            this.width = width;
            this.height = height;
            this.padding = padding;
            this.offsetTop = offsetTop;
            this.offsetLeft = offsetLeft;
            this.brick = [];
            for(var c=0; c<this.columnCount; c++) {
                this.brick[c] = [];
                for(var r=0; r<this.rowCount; r++) {
                    this.brick[c][r] = { x: 0, y: 0, status: 1 };
                }
            }
        }
        reInit(){
            this.brick = [];
            for(var c=0; c<this.columnCount; c++) {
                this.brick[c] = [];
                for(var r=0; r<this.rowCount; r++) {
                    this.brick[c][r] = { x: 0, y: 0, status: 1 };
                }
            }
        }
        //ctx: contexto canvas
        drawBricks(ctx) { //RECORRE EL ARREGLO DE LADRILLOS Y LOS DIBUJA
            for(var c=0; c<this.columnCount; c++) {
                for(var r=0; r<this.rowCount; r++) {
                    if(this.brick[c][r].status == 1) {
                        var brickX = (c*(this.width+this.padding))+this.offsetLeft;
                        var brickY = (r*(this.height+this.padding))+this.offsetTop;
                        this.brick[c][r].x = brickX;
                        this.brick[c][r].y = brickY;
                        ctx.beginPath();
                        ctx.rect(brickX, brickY, this.width, this.height);
                        ctx.fillStyle = "#0095DD";
                        ctx.fill();
                        ctx.closePath();
                    }
                }
            }
        }
    }
</script>
<script>
    var Game={
        div: null,
        nivel: null,
        dx: null,
        dy: null,

        start: function(contenedor){
            this.div = document.getElementById(contenedor);
            remove(this.div);
            this.nivel = 0;
            this.dx = 5+this.nivel;
            this.dy = -5-this.nivel;
            this.iniciarPartida();
        },

        iniciarPartida: function(){
            //Creo el objeto canvas
            var canvas = newCanvas(480,320,'myCanvas');
            var ctx = canvas.getContext('2d'); //defino un contexto al canvas

            var ball = new Ball(canvas.width/2, canvas.height-30, 10, "#0095DD");
            var paddle = new Paddle(75, 10, (canvas.width-75)/2,canvas.height-10, "#0095DD");
            var bricks = new Bricks(3,5,75,20,10,30,30);

            //Variables que nos dirán si se ha pulsado un boton
            var rightPressed = false;
            var leftPressed = false;

            var score = 0;
            var lives = 3;

            function draw() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                bricks.drawBricks(ctx);
                ball.drawBall(ctx);
                paddle.drawPaddle(ctx);
                drawScore(ctx, score, 8, 20);
                drawLives(ctx, lives, canvas.width-65, 20);

                collisionDetection();

                if(ball.x + Game.dx > canvas.width-ball.radio || ball.x + Game.dx < ball.radio) {
                    Game.dx = -Game.dx;
                }

                if(ball.y + Game.dy < ball.radio) {
                    Game.dy = -Game.dy;
                } else if(ball.y + Game.dy > canvas.height-ball.radio) {
                    if(ball.x > paddle.x && ball.x < paddle.x + paddle.width) {
                        Game.dy = -Game.dy;
                    }
                    else {
                        lives--;
                        if(!lives){
                            //postear puntaje
                            GameEngine.publishScore(score);
                            alert("GAME OVER");
                            document.location.reload();
                        }else{
                            ball.x = canvas.width/2;
                            ball.y = canvas.height-30;
                            Game.dx = 5+Game.nivel;
                            Game.dy = -5-Game.nivel;
                            paddle.x = (canvas.width-paddle.width)/2;
                        }
                    }
                }

                if(rightPressed && paddle.x < canvas.width-paddle.width) {
                    paddle.x += 15;
                }
                else if(leftPressed && paddle.x > 0) {
                    paddle.x -= 15;
                }
                ball.x += Game.dx;
                ball.y += Game.dy;
                requestAnimationFrame(draw);
            }

            function keyDownHandler(e) {
                if(e.keyCode == 39) {
                    rightPressed = true;
                }
                else if(e.keyCode == 37) {
                    leftPressed = true;
                }
            }

            function keyUpHandler(e) {
                if(e.keyCode == 39) {
                    rightPressed = false;
                }
                else if(e.keyCode == 37) {
                    leftPressed = false;
                }
            }
            function collisionDetection() {
                for(c=0; c<bricks.columnCount; c++) {
                    for(r=0; r<bricks.rowCount; r++) {
                        var b = bricks.brick[c][r];
                        if(b.status == 1) {
                            if(ball.x > b.x && ball.x < b.x+bricks.width && ball.y > b.y && ball.y < b.y+bricks.height) {
                                Game.dy = -Game.dy;
                                b.status = 0;
                                score++;
                                if(score == bricks.rowCount*bricks.columnCount*(Game.nivel+1)) {
                                    alert("YOU WIN, Next Level!");

                                    Game.nivel ++;
                                    Game.dx = 5+Game.nivel;
                                    Game.dy = -5-Game.nivel;
                                    bricks.reInit();
                                }
                            }
                        }
                    }
                }
            }

            document.addEventListener("keydown", keyDownHandler, false);
            document.addEventListener("keyup", keyUpHandler, false);
            draw();
            this.div.appendChild(canvas);
        },
    };

    document.addEventListener("DOMContentLoaded", function() {
        Game.start("game-div");
    });
</script>