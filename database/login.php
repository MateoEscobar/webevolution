<?php
// se requiere el archivo conexion
require('conexion.php');
// se instancia la clase
$conexion = new conexion();
// se crea una variable con la conexión
$con = $conexion->conectar();
if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
    // variables necesarias por post
    $email = $_POST['email'];
    $password = $_POST['password'];
    // sintaxis a ejecutar
    $query = "SELECT * FROM tblusuarios WHERE correo = '$email' AND password = md5('$password')";
    // se guarda el resultado de la consulta en una variable
    $result = $con->query($query);
    // se guarda la conversión a array del resultado en una variable
    $row = $result->fetch_array(MYSQLI_NUM);
    // condicción que verifica si hay usuarios en la base de datos
    if (count($row)>0){
        if ($row[6] == 0){
            $eror = "Su-usuario/contraseña-no-se-encuentra-activado-en-nuestra-plataforma";
            header("Location: ../index?error=$eror");
        }else{
            session_start();
            $_SESSION["sessionusuario"]=$row;
            header("Location: ../views/home");
        }
    }else{
        $eror = "Usuario-y/o-contraseña-incorrectos";
        header("Location: ../index?error=$eror");
    }
}else{
    $eror = "Es-necesario-ingresar-todos-los-datos";
    header("Location: ../index?error=$eror");
}
?>
