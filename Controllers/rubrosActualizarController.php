<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../Models/Rubro.php';

$datos = json_decode(file_get_contents('php://input'));

$rubro = Rubro::obtenerRubroPorId($datos->id);
$rubro->conectar();

try {
    $resultado = $rubro->actualizarRubro(
        $datos->id,
        $datos->nombre,
        $datos->codigo,
        $datos->descripcion,
        intval($datos->visible),
        intval($datos->activo),
        $datos->documentacion
    );

    echo json_encode([
        'success' => true,
        'id_rubro' => $resultado,
        'mensaje' => 'Rubro actualizado correctamente'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'mensaje' => 'Error: ' . $e->getMessage()
    ]);
}




