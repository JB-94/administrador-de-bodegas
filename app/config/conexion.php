<?php
class CConexion{  //En esta clase se define los parametros para conectarse a la base de datos

    function ConexionDB(){

        $host ="localhost";
        $dbname = "db_bodega"; 
        $username = "postgres";
        $pasword = "123";   

        try {
            $conn = new PDO("pgsql:host= $host; dbname=$dbname", $username, $pasword);
            //echo "se conectó perfectamente a la base de datos para proyecto: Administrador de Bodegas";
            return $conn;
        } catch (PDOException $exp) {
            //echo ("no se pudo conectar a la base de datos, $exp");
            return "Conexión fallida";
        }
    return $conn;

    }
}
//CConexion::ConexionDB();
?>