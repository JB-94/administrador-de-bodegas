<?php
require_once "../models/bodega.model.php";
echo json_encode(bodega::obtenerDatosId($_POST['id_bodega']));
