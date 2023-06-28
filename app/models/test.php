<?php
require_once "../config/conexion.php";
try {
    $sql = "SELECT * FROM bodega";
    $stmt = CConexion::ConexionDB()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    echo json_encode($result);
} catch (PDOException $th) {
    echo $th->getMessage();
}