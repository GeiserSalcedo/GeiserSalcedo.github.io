<?php
    require_once "conexion.php";
    $conexion = conexion();

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $genero = $_POST['genero'];
    $oficio = $_POST['oficio'];
    $telefono = $_POST['telefono'];
    $motivo = $_POST['motivo'];
    $usuario = $_POST['usuario'];
    $pass = sha1($_POST['pass']);

    if(buscaRepetido($usuario,$pass,$conexion)==1){
        echo 2;
    }else{
        $sql = "INSERT INTO paciente (nombre, apellido, edad, genero, 
                                    oficio, telefono, motivo, usuario, pass) 
            VALUES ('$nombre','$apellido','$edad','$genero','$oficio','$telefono',
                    '$motivo','$usuario', '$pass')";
    echo $resul = mysqli_query($conexion, $sql);
    }

    function buscaRepetido($user,$pass,$conexion){
        
        $sql="SELECT *FROM paciente WHERE usuario='$user' and pass='$pass'";
        $result=mysqli_query($conexion,$sql);

        if(mysqli_num_rows($result) > 0){
            return 1;
        }else{
            return 0;
        }
    }

?>