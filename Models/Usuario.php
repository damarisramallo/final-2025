<?php

require_once __DIR__ . '/../Config/Conexion.php';

class Usuario extends Conexion {
    public $id, $username, $email, $password, $nombre, $apellido, $rol, $activo, $fecha_creacion, $ultimo_acceso;

    public static function getUser($email, $password){
        $con = new Conexion();
        $con->conectar();
        $pre = mysqli_prepare($con->conexion, "SELECT * FROM usuarios WHERE email = ? AND password_hash = ?");
        $pre->bind_param("ss", $email, $password);
        $pre->execute();

        $resultado = $pre->get_result();
        if($resultado) {
            $usuario = $resultado->fetch_object(Usuario::class);
            return $usuario;
        } else {
            return null;
        }
    }
}