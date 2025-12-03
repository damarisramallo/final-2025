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

    public static function cantidadDeComercios()
    {
        $conexion = new Conexion();
        $conexion->conectar();
        $preparacion = mysqli_prepare($conexion->conexion, "SELECT COUNT(*) as total_comercios FROM `comercios`");
        $preparacion->execute();
        $resultado = $preparacion->get_result();

        $cantComercios = $resultado->fetch_assoc();

        return $cantComercios['total_comercios'];
    }

    public static function obtenerPorId($id)
    {
        $conexion = new Conexion(); 
        $conexion->conectar();
        $preparacion = mysqli_prepare($conexion->conexion, "SELECT * FROM comercios WHERE id = ?");
        $preparacion->bind_param("i", $id);
        $preparacion->execute();
        $resultado = $preparacion->get_result(); 

        return $resultado->fetch_object(Comercio::class); 
    }

    public static function cantidadComerciosPorRubro($rubro_id)
    {
        $conexion = new Conexion(); 
        $conexion->conectar();
        $preparacion = mysqli_prepare($conexion->conexion, "SELECT COUNT(comercios.id) FROM `comercios` INNER JOIN rubros ON comercios.rubro_id = rubros.id WHERE rubros.id = ?");
        $preparacion->bind_param("i", $rubro_id);
        $preparacion->execute();
        $resultado = $preparacion->get_result(); 

        return $resultado->fetch_object(Comercio::class); 
    }

    public function crearComercio()
    {
        $this->conectar();
        $preparacion = mysqli_prepare($this->conexion, "INSERT INTO comercios (titular_id, rubro_id, subrubro, nombre, nombre_fantasia, direccion, localidad, provincia, codigo_postal, barrio, telefono, sitio_web, email_contacto, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
        $preparacion->bind_param("iissssssssssss", $this->titular_id, $this->rubro_id, $this->subrubro, $this->nombre, $this->nombre_fantasia, $this->direccion, $this->localidad, $this->provincia, $this->codigo_postal, $this->barrio, $this->telefono, $this->sitio_web, $this->email_contacto, $this->estado); 
        $preparacion->execute();
    }

    public function actualizar()
    {
        $this->conectar();
        $preparacion = mysqli_prepare($this->conexion, "UPDATE comercios SET titular_id = ?, rubro_id = ?, subrubro = ?, nombre = ?, nombre_fantasia = ?, direccion = ?, localidad = ?, provincia = ?, codigo_postal = ?, barrio = ?, telefono = ?, sitio_web = ?, email_contacto = ?, estado = ? WHERE id = ?");
        $preparacion->bind_param("iissssssssssssi", $this->titular_id, $this->rubro_id, $this->subrubro, $this->nombre, $this->nombre_fantasia, $this->direccion, $this->localidad, $this->provincia, $this->codigo_postal, $this->barrio, $this->telefono, $this->sitio_web, $this->email_contacto, $this->estado, $this->id); 
        $preparacion->execute();
    }

    public function eliminar()
    {
        $this->conectar();
        $preparacion = mysqli_prepare($this->conexion, "DELETE FROM comercios WHERE id = ?");
        $preparacion->bind_param("i", $this->id);
        $preparacion->execute();
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
