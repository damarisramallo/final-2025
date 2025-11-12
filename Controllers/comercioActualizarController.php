<?php

require_once __DIR__ . '/../Models/Comercio.php';
require_once __DIR__ . '/../Config/Conexion.php';
require_once __DIR__ . '/../Models/Titular.php';
require_once __DIR__ . '/../Models/Rubro.php';

$razonesSociales = Titular::obtenerRazonesSociales();
$rubros = Rubro::obtenerRubros();

$id = $_POST['idComercio'];
$id_titular = $_POST['razonSocialId'];
$nombre = $_POST['nombreComercio'];
$nombre_fantasia = $_POST['nombreFantasia'];
$rubro_id = $_POST['rubroId']; 
$subrubro = $_POST['subrubro'];
$telefono = $_POST['telefonoComercio'];
$email = $_POST['emailComercio'];
$sitio_web = $_POST['sitioWeb'];
$direccion = $_POST['direccion'];
$localidad = $_POST['localidadComercio'];
$provincia = $_POST['provinciaComercio'];
$codigo_postal = $_POST['codigoPostalComercio'];
$barrio = $_POST['barrio'];
$estado = $_POST['estadoComercio'];


$comercio = Comercio::obtenerPorId($id);
$comercio->titular_id = $id_titular;
$comercio->rubro_id = $rubro_id;
$comercio->subrubro = $subrubro;
$comercio->nombre = $nombre;
$comercio->nombre_fantasia = $nombre_fantasia;
$comercio->direccion = $direccion;
$comercio->localidad = $localidad;
$comercio->provincia = $provincia;
$comercio->codigo_postal = $codigo_postal;
$comercio->barrio = $barrio;
$comercio->telefono = $telefono;
$comercio->sitio_web = $sitio_web;
$comercio->email_contacto = $email;
$comercio->estado = $estado;







$comercio->actualizar();

header("Location: ".$_SERVER['HTTP_REFERER']);
