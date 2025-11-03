<?php

require_once __DIR__ . '/../Config/Conexion.php';
require_once __DIR__ . '/../Models/Titular.php';





$idRazon = $_GET['idRazon'];

$razon = Titular::obtenerPorId($idRazon);



require_once __DIR__ . '/../Views/titularesEditar.view.php';