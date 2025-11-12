<?php 

require_once __DIR__ . '/../Config/Conexion.php';


Class Rubro extends Conexion {
    public $id, $nombre, $codigo, $descripcion, $visible_publico, $activo, $fecha_creacion, $fecha_actualizacion;

    public static function obtenerRubros()
    {
        $conexion = new Conexion(); 
        $conexion->conectar();
        $preparacion = mysqli_prepare($conexion->conexion, "SELECT * FROM rubros");
        $preparacion->execute();
        $resultado = $preparacion->get_result(); 

        $rubros = array();
        while($rubro = $resultado->fetch_object(Rubro::class)){
            array_push($rubros, $rubro);
        }

        return $rubros;
    }

    public static function obtenerRubroPorId($id)
    {
        $conexion = new Conexion(); 
        $conexion->conectar();
        $preparacion = mysqli_prepare($conexion->conexion, "SELECT * FROM rubros WHERE id = ?");
        $preparacion->bind_param("i", $id);
        $preparacion->execute();
        $resultado = $preparacion->get_result(); 

        return $resultado->fetch_object(Rubro::class); 
    }

}