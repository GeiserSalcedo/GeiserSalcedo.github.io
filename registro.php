<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
<link rel="stylesheet" type="text/css" href="librerias/bootstrap/dist/css/bootstrap.css">
<link rel="stylesheet" href="librerias/fontawesome/css/all.css">

<script src="librerias/js/jquery-3.6.0.min.js"></script>
<script src="librerias/alertifyjs/alertify.js"></script>
</head>
<body style="background-color:grey">
<br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="panel panel-danger">
                    <div class="panel panel-heading">Registro de Pacientes</div>
                    <div class="panel panel-body">
                    <p></p>
                        <form action="" id="frmRegistro">
                        <label for="">Nombre</label>
                        <input type="text" id="nombre" class="form-control input-sm">
                        <label for="">Apellido</label>
                        <input type="text" id="apellido" class="form-control input-sm">
                        <label for="">Edad</label>
                        <input type="text" id="edad" class="form-control input-sm">
                        <label for="">Genero</label>
                        <select name="genero" id="genero" class="form-control input-sm">
                        <option value="0">Selecciones</option>
                        <option value="femenino">Femenino</option>
                        <option value="masculino">Masculino</option>
                        </select>
                        <label for="">Oficio</label>
                        <input type="text" id="oficio" class="form-control input-sm">
                        <label for="">Teléfono</label>
                        <input type="text" id="telefono" class="form-control input-sm">
                        <label for="">Motivo de la Evaluación</label>
                        <input type="text" id="motivo" class="form-control input-sm">
                        <label for="">Usuario</label>
                        <input type="text" id="usuario" class="form-control input-sm">
                        <label for="">Password</label>
                        <input type="password" id="pass" class="form-control input-sm">
                        <p></p>
                        <span class="btn btn-primary" id="registrarnuevo">Registrar</span>
                        </form>
                        <div style="text-align: right;">
                        <a href="index.html" class="btn btn-default">Login</a>
                           
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-sm-4"></div>

        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $('#registrarnuevo').click(function(){

            if($('#nombre').val()==""){
                alertify.alert("Debes colocar el nombre");
                return false;
            }else if($('#apellido').val()==""){
                alertify.alert("Debes colocar el apellido");
                return false;
            }else if($('#edad').val()==""){
                alertify.alert("Debes colocar el edad");
                return false;
            }else if($('#genero').val()==""){
                alertify.alert("Debes colocar el genero");
                return false;
            }else if($('#oficio').val()==""){
                alertify.alert("Debes colocar el oficio");
                return false;
            }else if($('#telefono').val()==""){
                alertify.alert("Debes colocar el telefono");
                return false;
            }else if($('#motivo').val()==""){
                alertify.alert("Debes colocar el motivo de la evaluacion");
                return false;
            }else if($('#usuario').val()==""){
                alertify.alert("Debes colocar el usuario");
                return false;
            }else if($('#pass').val()==""){
                alertify.alert("Debes colocar la clave");
                return false;
            }

            cadena = "nombre="+ $('#nombre').val() +
                     "&apellido="+ $('#apellido').val() +
                     "&edad="+ $('#edad').val() +
                     "&genero="+ $('#genero').val() +
                     "&oficio="+ $('#oficio').val() +
                     "&telefono="+ $('#telefono').val() +
                     "&motivo="+ $('#motivo').val() +
                     "&usuario="+ $('#usuario').val() +
                     "&pass="+ $('#pass').val();
                     
                    $.ajax({
                        type:"POST",
                        url:"php/registr.php",
                        data:cadena,
                        success:function(r){
                            if(r==2){
                                alertify.alert("Usuario Existe");
                                $('#frmRegistro')[0].reset();
                            }
                           else if(r==1){
                                $('#frmRegistro')[0].reset();
                                alertify.success("Guardado con Exito");
                            }else{
                                alertify.error("No se Guardo");
                            }
                        }
                    });

        });
    });
</script>