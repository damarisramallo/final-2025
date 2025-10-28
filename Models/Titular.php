<?php

require_once __DIR__ . '/../Config/Conexion.php';

Class Titular extends Conexion {

    public $id, $tipo, $nombre, $email, $telefono, $fecha_inicio, $cuit, $celular, $web, $calle, $numero, $piso, $localidad, $provincia, $cod_postal, $observaciones, $estado, $fecha_creacion, $fecha_actualizacion, $condicion_iva;

    public static function obtenerRazonesSociales()
    {
        $conexion = new Conexion(); 
        $conexion->conectar();
        $preparacion = mysqli_prepare($conexion->conexion, "SELECT * FROM titulares");
        $preparacion->execute();
        $resultado = $preparacion->get_result(); 

        $razonesSociales = array();
        while($razon = $resultado->fetch_object(Titular::class)){
            array_push($razonesSociales, $razon);
        }

        return $razonesSociales;
    }

    public function crearRazonSocial()
    {
        $this->conectar();
        $preparacion = mysqli_prepare($this->conexion, "INSERT INTO titulares (tipo, nombre, email, telefono, fecha_inicio, cuit, celular, web, calle, numero, piso, localidad, provincia, cod_postal, observaciones, estado, condicion_iva) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
        $preparacion->bind_param("sssssssssssssssss", $this->tipo, $this->nombre, $this->email, $this->telefono, $this->fecha_inicio, $this->cuit, $this->celular, $this->web, $this->calle, $this->numero, $this->piso, $this->localidad, $this->provincia, $this->cod_postal, $this->observaciones, $this->estado, $this->condicion_iva); 
        $preparacion->execute();
    }
}