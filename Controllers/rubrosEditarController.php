<?php

require_once __DIR__ . '/../Config/Conexion.php';
require_once __DIR__ . '/../Models/Rubro.php';
require_once __DIR__ . '/../Models/Documentacion.php';

$idRubro = $_GET['idRubro'];

$tiposDocumentacion = Documentacion::obtenerTiposDocumentacion();
$rubro = Rubro::obtenerRubroPorId($idRubro);
$documentacion = Rubro::documentosDelRubro($idRubro);

require_once __DIR__ . '/../Views/rubrosEditar.view.php';