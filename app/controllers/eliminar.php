<?php
require_once "../models/bodega.model.php";
echo json_encode(bodega::EliminarDato($_POST['id_bodega']));