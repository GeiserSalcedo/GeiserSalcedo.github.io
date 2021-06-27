<?php
    session_start();
    require_once "conexion.php";
    $conexion = conexion();

    $usuario=$_POST['usuario'];
    $pass=sha1($_POST['pass']);

    $sql=" SELECT * FROM paciente WHERE usuario='$usuario' and pass='$pass'";
    $result=mysqli_query($conexion,$sql);

    if(mysqli_num_rows($result) > 0){
        $_SESSION['user']=$usuario;
        echo 1;
    }else{
        echo 0;
    }
?>