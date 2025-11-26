<?php

require_once __DIR__ . '/../Config/Conexion.php';


class Rubro extends Conexion
{
    public $id, $nombre, $codigo, $descripcion, $visible_publico, $activo, $fecha_creacion, $fecha_actualizacion;

    public static function obtenerRubros()
    {
        $conexion = new Conexion();
        $conexion->conectar();
        $preparacion = mysqli_prepare($conexion->conexion, "SELECT * FROM rubros");
        $preparacion->execute();
        $resultado = $preparacion->get_result();

        $rubros = array();
        while ($rubro = $resultado->fetch_object(Rubro::class)) {
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

    public function crearRubro($nombre, $codigo, $descripcion, $visible_publico, $activo, $documentacion)
    {
        try {
            $this->conexion->begin_transaction();
            $fecha_creacion = date('Y-m-d H:i:s');
            $fecha_actualizacion = date('Y-m-d H:i:s');

            $preparacion = mysqli_prepare($this->conexion, "INSERT INTO rubros (nombre, codigo, descripcion, visible_publico, activo, fecha_creacion, fecha_actualizacion) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $preparacion->bind_param("sssiiss", $nombre, $codigo, $descripcion, $visible_publico, $activo, $fecha_creacion, $fecha_actualizacion);

            if (!$preparacion->execute()) {
                throw new Exception("Error al registrar el rubro");
            }

            $ultimo_id_rubro = $this->conexion->insert_id;

            foreach ($documentacion as $id_documentacion) {
                $fecha_creacion = date('Y-m-d H:i:s');
                $pre_documento = mysqli_prepare($this->conexion, "INSERT INTO rubro_documentacion (rubro_id, tipo_documento_id, fecha_creacion) VALUES (?, ?, ?)");
                $pre_documento->bind_param("iis", $ultimo_id_rubro, $id_documentacion, $fecha_creacion);

                if (!$pre_documento->execute()) {
                    throw new Exception("Error al registrar documentación");
                }
            }

            $this->conexion->commit();
            return $ultimo_id_rubro;
        } catch (Exception $e) {
            $this->conexion->rollback();
            throw $e;
        }
    }

    public function eliminar()
    {
        $this->conectar();
        $preparacion = mysqli_prepare($this->conexion, "DELETE FROM rubros WHERE id = ?");
        $preparacion->bind_param("i", $this->id);
        $preparacion->execute();
    }

    public static function documentosDelRubro($id)
    {
        $conexion = new Conexion();
        $conexion->conectar();
        $preparacion = mysqli_prepare($conexion->conexion, "SELECT tipo_documento_id FROM `rubro_documentacion` WHERE rubro_id = ?");
        $preparacion->bind_param("i", $id);
        $preparacion->execute();
        $resultado = $preparacion->get_result();

        $documentacion = array();
        while ($fila = $resultado->fetch_assoc()) {
            array_push($documentacion, $fila['tipo_documento_id']);
        }

        return $documentacion;
    }

    public function actualizarRubro($id, $nombre, $codigo, $descripcion, $visible_publico, $activo, $documentacion)
    {
        try {
            $this->conexion->begin_transaction();
            $fecha_actualizacion = date('Y-m-d H:i:s');

            $preparacion = mysqli_prepare($this->conexion, "UPDATE rubros SET nombre = ?, codigo = ?, descripcion = ?, visible_publico = ?, activo = ?, fecha_actualizacion = ? WHERE id = ?");
            $preparacion->bind_param("sssiisi", $nombre, $codigo, $descripcion, $visible_publico, $activo, $fecha_actualizacion, $id);

            if (!$preparacion->execute()) {
                throw new Exception("Error al actualizar el rubro");
            }

            $pre_eliminar = mysqli_prepare($this->conexion, "DELETE FROM rubro_documentacion WHERE rubro_id = ?");
            $pre_eliminar->bind_param("i", $id);

            if (!$pre_eliminar->execute()) {
                throw new Exception("Error al eliminar documentación anterior");
            }

            if(!empty($documentacion)){
                foreach ($documentacion as $id_documentacion) {
                $fecha_creacion = date('Y-m-d H:i:s');
                $pre_documento = mysqli_prepare($this->conexion, "INSERT INTO rubro_documentacion (rubro_id, tipo_documento_id, fecha_creacion) VALUES (?, ?, ?)");
                $pre_documento->bind_param("iis", $id, $id_documentacion, $fecha_creacion);

                if (!$pre_documento->execute()) {
                    throw new Exception("Error al registrar documentación");
                }
            }
            }

            $this->conexion->commit();
            return $id;
            
        } catch (Exception $e) {
            $this->conexion->rollback();
            throw $e;
        }
    }


    // SELECT COUNT(comercios.id) FROM `comercios` INNER JOIN rubros ON comercios.rubro_id = rubros.id WHERE rubros.id = 1
    // public function comercio()
    // {
    //     return Comercio::obtenerPorId($this->);
    // }
}
