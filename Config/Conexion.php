<?php
class Conexion
{
    public $conexion;
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $database = "sistema_comercios";

    public function conectar()
    { 
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $this->conexion = mysqli_connect($this->host, $this->user, $this->password, $this->database);

            if(!$this->conexion){
                throw new Exception("Error de conexión: " . mysqli_connect_error());
            }
            
            return $this->conexion;

        } catch (Exception $e) {
            die("Error al conectar: " . $e->getMessage());
        }


        
    }
}