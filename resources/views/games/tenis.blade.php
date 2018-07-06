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

        <title>miniTenis</title>
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
                dx: null,
                dy: null,

                start: function(contenedor){
                    this.div = document.getElementById(contenedor);
                    remove(this.div);
                    this.dx = 5;
                    this.dy = -5;
                    this.iniciarPartida();
                },

                iniciarPartida: function(){
                    //Creo el objeto canvas
                    var canvas = newCanvas(480,320,'myCanvas');
                    var ctx = canvas.getContext('2d'); //defino un contexto al canvas
                    var ball = new Ball(canvas.width/2, canvas.height-30, 10, "#0095DD");
                    var paddle1 = new Paddle(10, 75, 0, (canvas.height-75)/2, "#0095DD");
                    var paddle2 = new Paddle(10, 75,canvas.width-10,  (canvas.height-75)/2, "#0095DD");
                    //Variables que nos dirán si se ha pulsado un boton
                    var upPressed1 = false;
                    var downPressed1 = false;
                    var upPressed2 = false;
                    var downPressed2 = false;

                    var score1 = 0;
                    var score2 = 0;
                    var lives = 9;

                    function draw() {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        ball.drawBall(ctx);
                        paddle1.drawPaddle(ctx);
                        paddle2.drawPaddle(ctx);
                        drawScore(ctx, score1, 8, 20);
                        drawScore(ctx, score2, canvas.width-65, 20);
                        drawLives(ctx, lives, canvas.width/2 - 50, 20);


                        //Rebote vertical contra el canvas
                        if(ball.y + Game.dy > canvas.height-ball.radio || ball.y + Game.dy < ball.radio) {
                            Game.dy = -Game.dy;
                        }
                        //Rebote horizontal contra el canvas
                        if(ball.x + Game.dx > canvas.width-ball.radio) {
                            //Rebote contra la paleta
                            if(ball.y > paddle2.y && ball.y < paddle2.y + paddle2.height) {
                                Game.dx = -Game.dx;
                            }else {
                                lives--;
                                score1++;
                                if(!lives){
                                    array = [score1, score2];
                                    alert('Player '+(array.indexOf(Math.max(score1,score2))+1)+' WIN!');
                                    document.location.reload();
                                }else{
                                    ball.x = canvas.width/2;
                                    ball.y = canvas.height-30;
                                    paddle1.y = (canvas.height-paddle1.height)/2;
                                    paddle2.y = (canvas.height-paddle2.height)/2;
                                }
                            }
                        }else{
                            if(ball.x + Game.dx < ball.radio){
                                //Rebote contra la paleta
                                if(ball.y > paddle1.y && ball.y < paddle1.y + paddle1.height) {
                                    Game.dx = -Game.dx;
                                } else {
                                    lives--;
                                    score2++;
                                    if(!lives){
                                        array = [score1, score2];
                                        alert('Player '+(array.indexOf(Math.max(score1,score2))+1)+' WIN!');
                                        document.location.reload();
                                    }else{
                                        ball.x = canvas.width/2;
                                        ball.y = canvas.height-30;
                                        paddle1.y = (canvas.height-paddle1.height)/2;
                                        paddle2.y = (canvas.height-paddle2.height)/2;
                                    }
                                }
                            }
                        }

                        //Movimiento de las paletas
                        if(upPressed1 && paddle1.y < canvas.height-paddle1.height) {
                            paddle1.y += 15;
                        }
                        else if(downPressed1 && paddle1.y> 0) {
                            paddle1.y -= 15;
                        }

                        if(upPressed2 && paddle2.y < canvas.height-paddle2.height) {
                            paddle2.y += 15;
                        }
                        else if(downPressed2 && paddle2.y > 0) {
                            paddle2.y -= 15;
                        }
                        //Se actualiza nueva ubicacion de la pelota
                        ball.x += Game.dx;
                        ball.y += Game.dy;
                        requestAnimationFrame(draw);
                    }

                    function keyDownHandler(e) {
                        if(e.keyCode == 83) {
                            upPressed1 = true;
                        }
                        else if(e.keyCode == 87) {
                            downPressed1 = true;
                        }

                        if(e.keyCode == 40) {
                            upPressed2 = true;
                        }
                        else if(e.keyCode == 38) {
                            downPressed2 = true;
                        }
                    }

                    function keyUpHandler(e) {
                        if(e.keyCode == 83) {
                            upPressed1 = false;
                        }
                        else if(e.keyCode == 87) {
                            downPressed1 = false;
                        }

                        if(e.keyCode == 40) {
                            upPressed2 = false;
                        }
                        else if(e.keyCode == 38) {
                            downPressed2 = false;
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

        <!--<div>
            <span id="score">0</span>
        </div>

        <button onclick="Game.postScore()">Incrementar Puntaje y Enviar al servidor</button>-->

    </div>















<!--

<div class="game-div">
    <title>Game Example</title>
    <script src="js/game.js.example.js"></script>
    <div>
        <span id="score">0</span>
    </div>
    <button onclick="Game.postScore()">Incrementar Puntaje y Enviar al servidor</button>
</div>

-->

