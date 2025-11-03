<?php

header('Content-Type: application/json');
error_reporting(0);

try {
    require_once __DIR__ . '/../Config/Conexion.php';
    require_once __DIR__ . '/../Models/Titular.php';

    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido');
    }

    $tipo = $_POST['tipoPersona'] ?? '';
    $nombre = $_POST['razonSocial'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? ''; 
    $fecha_inicio = $_POST['fechaInicioActividades'] ?? '';
    $cuit = $_POST['cuitCuil'] ?? '';
    $celular = $_POST['celular'] ?? '';
    $web = $_POST['paginaWeb'] ?? '';
    $calle = $_POST['calle'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $piso = $_POST['piso'] ?? '';
    $localidad = $_POST['localidad'] ?? '';
    $provincia = $_POST['provincia'] ?? '';
    $cod_postal = $_POST['codigoPostal'] ?? '';
    $observaciones = $_POST['observaciones'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $condicion_iva = $_POST['condicionIva'] ?? '';

    $razon = new Titular();
    $razon->tipo = $tipo;
    $razon->nombre = $nombre;
    $razon->email = $email;
    $razon->telefono = $telefono;
    $razon->fecha_inicio = $fecha_inicio;
    $razon->cuit = $cuit;
    $razon->celular = $celular;
    $razon->web = $web;
    $razon->calle = $calle;
    $razon->numero = $numero;
    $razon->piso = $piso;
    $razon->localidad = $localidad;
    $razon->provincia = $provincia;
    $razon->cod_postal = $cod_postal;
    $razon->observaciones = $observaciones;
    $razon->estado = $estado;
    $razon->condicion_iva = $condicion_iva;

    $resultado = $razon->crearRazonSocial();


    echo json_encode([
        'success' => true,
        'message' => 'Razón social guardada correctamente'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}