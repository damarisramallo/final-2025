<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../Models/Rubro.php';

$idRubro = $_GET['id'];

$rubro = Rubro::obtenerRubroPorId($idRubro);
$documentacion = Rubro::todosDocumentosDelRubro($idRubro);

echo json_encode([
    'nombre' => $rubro->nombre,
    'codigo' => $rubro->codigo,
    'descripcion' => $rubro->descripcion,
    'activo' => $rubro->activo,
    'documentacion' => $documentacion  
]);