<?php
    session_start();

    if(isset($_SESSION['user'])){

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>

    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
<link rel="stylesheet" type="text/css" href="librerias/bootstrap/dist/css/bootstrap.css">
<link rel="stylesheet" href="librerias/fontawesome/css/all.css">

<script src="librerias/js/jquery-3.6.0.min.js"></script>
<script src="librerias/alertifyjs/alertify.js"></script>
</head>
<body>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="jumbotron">
                    <a href="php/salir.php" class="btn btn-info">Salir del Sistema</a>
                    <br>
                    <hr>
                    <h2>Escoja una Opcion</h2>
                    <hr>
                    <a href="php/memori.php"><h2><span class="fas fa-brain"></span><span class="tab-text">Juego de Memoria</h2></span></a>
					<a href="php/drop.php"><h2><span class="fa fa-hands-wash"></span><span class="tab-text">Juego Arrastar y Soltar</h2></span></a>
                    
                    


                </div>

            </div>

        </div>
    </div>
</body>
</html>

<?php
}else{
    header("location:index.html");
}
?>