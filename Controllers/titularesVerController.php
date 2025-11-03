<?php

require_once __DIR__ . '/../Config/Conexion.php';
require_once __DIR__ . '/../Models/Titular.php';

$idRazon = $_GET['id'];

$razon = Titular::obtenerPorId($idRazon);

require_once __DIR__ . '/../Views/titularesVer.view.php';