<?php
require_once "../models/bodega.model.php";

$arrayCod = array(
    'id_bodega' => $_POST['id_bodega'],
    'id_comuna' => $_POST['id_comuna'],
    'nombre_bodega' => $_POST['nombre_bodega'],
    'direccion_bodega' => $_POST['direccion_bodega'],
    'dotacion_bodega' => $_POST['dotacion_bodega']
);

echo json_encode(bodega::guardarDato($arrayCod));
?>
