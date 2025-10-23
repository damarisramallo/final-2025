<?php 

require_once __DIR__ . '/../Config/Conexion.php';

Class Comercio extends Conexion {
    public $id,	$titular_id, $rubro_id,	$subrubro, $nombre,	$nombre_fantasia, $direccion, $localidad, $provincia, $codigo_postal, $barrio, $telefono, $sitio_web, $email_contacto, $estado,	$fecha_alta, $fecha_aprobacion,	$fecha_actualizacion, $observaciones;
}