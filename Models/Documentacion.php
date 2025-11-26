<?php

require_once __DIR__ . '/../Config/Conexion.php';

Class Documentacion extends Conexion {
    public $id,	$codigo, $nombre, $descripcion, $categoria, $obligatorio_por_defecto, $vigencia_meses, $instrucciones, $activo;

    public static function obtenerTiposDocumentacion()
    {
        $conexion = new Conexion(); 
        $conexion->conectar();
        $preparacion = mysqli_prepare($conexion->conexion, "SELECT * FROM tipos_documentacion");
        $preparacion->execute();
        $resultado = $preparacion->get_result(); 

        $tipos = array();
        while($tipo = $resultado->fetch_object(Documentacion::class)){
            array_push($tipos, $tipo);
        }

        return $tipos;
    }

}