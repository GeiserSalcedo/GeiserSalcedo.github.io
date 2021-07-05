<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrastrar y Soltar</title>

    <link rel="stylesheet" type="text/css" href="../librerias/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="../librerias/fontawesome/css/all.css">
    <link rel="stylesheet" href="../stilos/stylos.css">

	<script src="../librerias/js/jquery-3.6.0.min.js"></script>
</head>
<body>
    <br>
    <hr>
    <style>.thumbnail { height: 185px;}</style>
    <hr>

    <div class="container text-center">
        <br>
        <div class="col-md-12"><h2><div>Arrasta la imagen y colocala con la que concuerde</div></h2></div>
        
        <div class="row">
            <br>
                <div class="col-md-6"><h2><div id="puntaje">Puntos:0</div></h2></div>
            
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div id="dragImagen" class="col-sm-4" ondrop="drop(event)" ondragover="allowDrop(event)" ></div>
            <div class="col-md-4"></div>
        </div>

        <div class="row text-center" id="imagenes"></div>
    </div>

    <script >
        var Imagenes = ["cancha","cocina","futbolista","herramienta","sarten","taller"];
        var imagenesJuego = [];
        var indice;
        var item;
        var tiempo;
        var puntos = 0;

        $(document).ready(function(){
            iniciarJuego();
        });

        function iniciarJuego(){
         Imagenes = ["cancha","cocina","futbolista","herramienta","sarten","taller"];
         imagenesJuego = [];
         indice = 0;
         item = 0;

            for(i=0;i<3;i++){
                indice=Math.floor(Math.random() * Imagenes.length);
                item = Imagenes[indice];
                imagenesJuego.push(item);
                Imagenes.splice(indice,1);
            }
            //agregar un indice y que slecciones el que aparece para escojer
            indice = Math.floor(Math.random()*imagenesJuego.length);
            item = imagenesJuego[indice];
            ///limpiamos el contenido
            $("#imagenes").empty();
            $("#dragImagen").empty();
            clearInterval(tiempo);

            // muestra tres imagenes al azar
            $.each(imagenesJuego, function( i, val ){
            $("#imagenes").append('<div class="col-xs-4 col-md-4"><a href="#" class="thumbnail"><img src="'+val+'.jpg" id='+val+' draggable="true" ondragstart="drag(event)" style="cursor:move" /></a></div>');
                
            });

            //mostrar la imagen que se desea
            $("#dragImagen").append('<a href="#" class="thumbnail"></a> <h3><span class="label label-danger">'+item+'</span></h3><br>');

           $("#imagenes").append('<div class="col-xs-4 col-md-4"><a href="#" class="thumbnail"><img src="'+val+'.jpg" id='+val+' draggable="true" ondragstart="drag(event)" style="cursor:move"></a></div>');


        }

        //opciones para arrastrar la imagen
        function allowDrop(ev) { ev.preventDefault();}
        function drag(ev) {ev.dataTransfer.setData("text", ev.target.id);}
        function drop(ev){
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            if (data==item){
                ev.target.appendChild(document.getElementById(data));
                puntos++;
                $("#puntaje").html('<span class="label label-default">Puntos: '+puntos+'</span>');
                tiempo=setInterval(function(){iniciarJuego();}, 800);
            }else{
                alert("!Fallaste  :"); puntos=0;
                $('#puntaje').html('Puntos:'+puntos+'');
                tiempo=setInterval(function(){iniciarJuego();}, 800);

            }
        }

    </script>
</body>
</html>
