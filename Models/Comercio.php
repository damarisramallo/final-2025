<?php 

require_once __DIR__ . '/../Config/Conexion.php';
require_once __DIR__ . '/../Models/Titular.php';
require_once __DIR__ . '/../Models/Rubro.php';

Class Comercio extends Conexion {
    public $id,	$titular_id, $rubro_id,	$subrubro, $nombre,	$nombre_fantasia, $direccion, $localidad, $provincia, $codigo_postal, $barrio, $telefono, $sitio_web, $email_contacto, $estado,	$fecha_alta, $fecha_aprobacion,	$fecha_actualizacion, $observaciones;

    public static function obtenerComercios()
    {
        $conexion = new Conexion(); 
        $conexion->conectar();
        $preparacion = mysqli_prepare($conexion->conexion, "SELECT * FROM comercios");
        $preparacion->execute();
        $resultado = $preparacion->get_result(); 

        $comercios = array();
        while($comercio = $resultado->fetch_object(Comercio::class)){
            array_push($comercios, $comercio);
        }

        return $comercios;
    }

    public function titular()
    {
        return Titular::obtenerTitularPorId($this->titular_id);
    }

    public function rubro()
    {
        return Rubro::obtenerRubroPorId($this->rubro_id);
    }
}