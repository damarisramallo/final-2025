<?php

require_once __DIR__ . '/../Models/Titular.php';

$idRazon = $_GET['id'];

$razon = Titular::obtenerPorId($idRazon);


header('Content-Type: application/json');
echo json_encode([
    'nombre' => $razon->nombre,
    'tipo' => $razon->tipo,
    'email' => $razon->email,
    'cuit' => $razon->cuit,
    'telefono' => $razon->telefono,
    'web' => $razon->web,
    'celular' => $razon->celular,
    'localidad' =>  $razon->localidad,
    'provincia' => $razon->provincia,
    'estado' => $razon->estado,
]);
