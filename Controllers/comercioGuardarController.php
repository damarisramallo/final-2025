<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../Models/Comercio.php';

$comercio = new Comercio();
$comercio->conectar();

try {
    $comercio->titular_id = $_POST['razonSocialId'];
    $comercio->nombre = $_POST['nombreComercio'];
    $comercio->nombre_fantasia = $_POST['nombreFantasia'];
    $comercio->rubro_id = $_POST['rubroId'];
    $comercio->subrubro = $_POST['subrubro'];
    $comercio->telefono = $_POST['telefonoComercio'];
    $comercio->email_contacto = $_POST['emailComercio'];
    $comercio->sitio_web = $_POST['sitioWeb'];
    $comercio->direccion = $_POST['direccion'];
    $comercio->localidad = $_POST['localidadComercio'];
    $comercio->provincia = $_POST['provinciaComercio'];
    $comercio->codigo_postal = $_POST['codigoPostalComercio'];
    $comercio->barrio = $_POST['barrio'];
    $comercio->estado = $_POST['estadoComercio'];

    $resultado = $comercio->crearComercio();

    echo json_encode([
        'success' => true,
        'mensaje' => 'Comercio guardado correctamente'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'mensaje' => 'Error: ' . $e->getMessage()
    ]);
}
