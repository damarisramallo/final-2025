<?php

header('Content-Type: application/json');
error_reporting(0);

try {
    require_once __DIR__ . '/../Config/Conexion.php';
    require_once __DIR__ . '/../Models/Comercio.php';

    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido');
    }

    $id_titular = $_POST['razonSocialId'] ?? '';
    $nombre = $_POST['nombreComercio'] ?? '';
    $nombre_fantasia = $_POST['nombreFantasia'] ?? '';
    $rubro_id = $_POST['rubroId'] ?? ''; 
    $subrubro = $_POST['subrubro'] ?? '';
    $telefono = $_POST['telefonoComercio'] ?? '';
    $email = $_POST['emailComercio'] ?? '';
    $sitio_web = $_POST['sitioWeb'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $localidad = $_POST['localidadComercio'] ?? '';
    $provincia = $_POST['provinciaComercio'] ?? '';
    $codigo_postal = $_POST['codigoPostalComercio'] ?? '';
    $barrio = $_POST['barrio'] ?? '';
    $estado = $_POST['estadoComercio'] ?? '';

    $comercio = new Comercio();
    $comercio->titular_id = $id_titular;
    $comercio->nombre = $nombre;
    $comercio->nombre_fantasia = $nombre_fantasia;
    $comercio->rubro_id = $rubro_id;
    $comercio->subrubro = $subrubro;
    $comercio->telefono = $telefono;
    $comercio->email_contacto = $email;
    $comercio->sitio_web = $sitio_web;
    $comercio->direccion = $direccion;
    $comercio->localidad = $localidad;
    $comercio->provincia = $provincia;
    $comercio->localidad = $localidad;
    $comercio->codigo_postal = $codigo_postal;
    $comercio->barrio = $barrio;
    $comercio->observaciones = $observaciones;

    $resultado = $comercio->crearComercio();


    echo json_encode([
        'success' => true,
        'message' => 'Comercio guardado correctamente'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}