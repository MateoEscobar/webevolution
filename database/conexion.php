<?php
class conexion{
    function conectar(){
        // definimos la variable de conexión
        $enlace = mysqli_connect("localhost", "root", "", "webevolution");
        // retornamos la conexión
        return $enlace;
    }
}
?>