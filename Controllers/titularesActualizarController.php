<?php

require_once __DIR__ . '/../Models/Titular.php';

$id = $_POST['idRazon'];
$tipo_persona = $_POST['tipoPersona'];
$nombre = $_POST['razonSocial'];
$cuil = $_POST['cuitCuil'];
$fecha_inicio = $_POST['fechaInicioActividades']; 
$condicion = $_POST['condicionIva'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$pagina_web = $_POST['paginaWeb'];
$calle = $_POST['calle'];
$numero = $_POST['numero'];
$piso = $_POST['piso'];
$localidad = $_POST['localidad'];
$provincia = $_POST['provincia'];
$cod_postal = $_POST['codigoPostal'];
$observaciones = $_POST['observaciones'];
$estado = $_POST['estado'];



$razon = Titular::obtenerPorId($id);
$razon->tipo = $tipo_persona;
$razon->nombre = $nombre;
$razon->cuit = $cuil;
$razon->fecha_inicio = $fecha_inicio;
$razon->condicion_iva = $condicion;
$razon->email = $email;
$razon->telefono = $telefono;
$razon->celular = $celular;
$razon->web = $pagina_web;
$razon->calle = $calle;
$razon->numero = $numero;
$razon->piso = $piso;
$razon->localidad = $localidad;
$razon->provincia = $provincia;
$razon->cod_postal = $cod_postal;
$razon->observaciones = $observaciones;
$razon->estado = $estado;

$razon->actualizar();



header("Location: ".$_SERVER['HTTP_REFERER']);