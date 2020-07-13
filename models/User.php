<?php

class panel
{
    //funcion para conectar a la base de datos
    function conection()
    {
        // se requiere el archivo conexion
        require('../database/conexion.php');
        // se instancia la clase
        $conexion = new conexion();
        // se crea una variable con la conexión
        return $con = $conexion->conectar();
    }
    // funcion para ingresar al sistema
    function ingresar(){
        $con = $this->conection();
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
                session_start();
                $_SESSION["sessionusuario"]=$row;
                header("Location: ./panel/home");
            }else{
                session_start();
                $_SESSION["errorsesion"]= "Usuario y/o contraseña incorrectos";
                header("Location: login");
            }
        }else{
            $error = "Por favor llene todos los campos";
            return $error;
        }
    }
}

?>