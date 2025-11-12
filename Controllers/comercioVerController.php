<?php

require_once __DIR__ . '/../Models/Comercio.php';

$id = $_GET['id'];

$comercio = Comercio::obtenerPorId($id);


header('Content-Type: application/json');
echo json_encode([
    'nombre' => $comercio->nombre,
    'razon_social' => $comercio->titular()->nombre,
    'nombre_fantasia' => $comercio->nombre_fantasia,
    'rubro' => $comercio->rubro()->nombre,
    'subrubro' => $comercio->subrubro,
    'telefono' => $comercio->telefono,
    'email_contacto' =>  $comercio->email_contacto,
    'sitio_web' => $comercio->sitio_web,
    'direccion' => $comercio->direccion,
    'localidad' => $comercio->localidad,
    'provincia' => $comercio->provincia,
    'codigo_postal' => $comercio->codigo_postal,
    'barrio' => $comercio->barrio,
    'estado' => $comercio->estado
]);

 