<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Memoria</title>

	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="librerias/fontawesome/css/all.css">
    <link rel="stylesheet" href="stylos.css">

	<script src="librerias/js/jquery-3.6.0.min.js"></script>
	<script src="script.js"></script>

    <style>
        body{
            width: 960px;
            margin: 0 auto;
        }

        h1{
            text-align: center;
        }

        #miCanvas{
            border:dotted 2px #76D7C4;
            background: #27AE60;
        }
    </style>

</head>
<body>
<h1 > Juego de Memoria</h1>
<canvas id="miCanvas" width="960px" height="450px">
</canvas>
    
</body>
</html>

<script >
    /* variables */
    var ctx, canvas;
    var primerCarta = true;
    var cartaPrimera, cartaSegunda;
    var colorDelante = "#F7DC6F";
    var colorAtras = "#117A65";
    var colorCanvas = "#27AE60";
    var inicioX= 45;
    var inicioY = 50;
    var cartaMargen = 30;
    var cartaLon = 30;
    var cartaAncho = cartaLon * 4;
    var cartaLargo = cartaLon * 4;
    var cartasArray = new Array();
    var iguales = false;
    var cartas = 0;


    /* funciones */
    function Carta(x, y, ancho, largo, info){
        this.x = x;
        this.y = y;
        this.ancho = ancho;
        this.largo = largo;
        this.info = info;
        this.dibuja = dibujaCarta;
    }

    function dibujaCarta(){
        ctx.fillStyle = colorAtras;
        ctx.fillRect(this.x, this.y, this.ancho, this.largo);
    }

    function tablero(){
        var i, carta;
        var x = inicioX;
        var y = inicioY;
        for (i=3; i<9; i++){
            carta = new Carta(x, y, cartaAncho, cartaLargo, i);
            cartasArray.push(carta);
            carta.dibuja();

            /**creamos la segunda carta */
            carta = new Carta(x, y+cartaAncho+cartaMargen, cartaAncho, cartaLargo, i);
            cartasArray.push(carta);
            carta.dibuja();

            /***se aunmenta el valor de x */
            x += cartaAncho + cartaMargen;
        }
    }

    function barajear(){
        var i, j, k;
        var temporal;
        var lon = cartasArray.length;
        for(j=0; j<lon*3; j++){
            i = Math.floor(Math.random()*lon);
            k = Math.floor(Math.random()*lon);
            /** */
            temporal = cartasArray[i].info;
            //
            cartasArray[i].info=cartasArray[k].info;
            cartasArray[k].info = temporal;
        }
    }

    function ajusta(xx, yy){
        var posCanvas = canvas.getBoundingClientRect();
        var x = xx -  posCanvas.left;
        var y = yy - posCanvas.top;
        return{x:x, y:y}
    }

    function selecciona(e){
        var pos = ajusta(e.clientX, e.clientY);
        /*** */
        for(var i=0; i < cartasArray.length; i++){
            var carta = cartasArray[i];
            if(carta.x > 0){

                if((pos.x > carta.x) &&
                   (pos.x < carta.x + carta.ancho) &&
                   (pos.y > carta.y) && 
                   (pos.y < carta.y + carta.largo)){
                    if((primerCarta)||(i!=cartaPrimera))
                     break;
                
                }
            }
        }
        /**encontramos la carta */
            if(i < cartasArray.length){
                if(primerCarta){
                    cartaPrimera = i;
                    primerCarta = false;
                    pinta(carta);
                }else{
                    cartaSegunda = i;
                    pinta(carta);
                    primerCarta = true;
                    if(cartasArray[cartaPrimera].info== cartasArray[cartaSegunda].info){
                        iguales = true;
                        cartas++;
                        aciertos();
                    }else{
                        iguales = false;
                    }
                    setTimeout(volteaCarta, 1000);
                }
        }
        
    }

    function volteaCarta(){
        if(iguales==false){
        cartasArray[cartaPrimera].dibuja();
        cartasArray[cartaSegunda].dibuja();
    }else{
        ctx.clearRect(cartasArray[cartaPrimera].x,cartasArray[cartaPrimera].y,
        cartasArray[cartaPrimera].ancho,cartasArray[cartaPrimera].largo);

        ctx.clearRect(cartasArray[cartaSegunda].x,cartasArray[cartaSegunda].y,
        cartasArray[cartaSegunda].ancho, cartasArray[cartaSegunda].largo);

        cartasArray[cartaPrimera].x = -1;
        cartasArray[cartaSegunda].x = -1;
     }
    }
    /* mostrar las cartas */
    function pinta(carta){
        ctx.fillStyle = colorDelante;
        ctx.fillRect(carta.x, carta.y, carta.ancho, carta.largo);
        ctx.font="bold 40px Comic";
        ctx.fillStyle="black";
        ctx.fillText(String(carta.info), carta.x+carta.ancho/2-10, carta.y+carta.largo/2+10);
       }

       function aciertos(){
            ctx.save();
            ctx.fillStyle = "black";
            if(cartas==6){
            ctx.font = "bold 60px Comic";
            ctx.clearRect(0,0, canvas.width, canvas.height);
            ctx.fillText("Muy Bien, !Lo Lograste!.: ", 70, 180);
            }else{
            ctx.clearRect(0,340, canvas.width/2, 100);
            ctx.font = "bold 40px Comic";
            ctx.fillStyle = "black";
            ctx.fillText("Aciertos: "+String(cartas), 30, 380);
            ctx.restore();

            }
       }

    /* funcion principal */
    window.onload = function(){
        canvas = document.getElementById("miCanvas");
        if(canvas && canvas.getContext){
            ctx = canvas.getContext("2d");
            if(ctx){
                canvas.addEventListener("click",selecciona,false);
                tablero();
                barajear();
                aciertos();
            }else{
                alert("Error al crear tu contexto");
            }
        }
    }
</script>