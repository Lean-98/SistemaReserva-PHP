<?php

namespace Model;

require_once './includes/database.php';

class Habitacion
{
    public $num_habitacion;
    public $tipo_habitacion;
    public $descripcion;

    public function __construct($args = [])
    {
        $this->num_habitacion = $args['num_habitacion'] ?? null;
        $this->tipo_habitacion = $args['tipo_habitacion'] ?? null;
        $this->descripcion = $args['descripcion'] ?? null;
    }

    // Mensajes de validación para la creación de una habitación
    public function validar()
    {
        $errores = [];

        if (!$this->num_habitacion) {
            $errores['num_habitacion'] = 'El número de habitación es obligatorio';
        }
        if (!$this->tipo_habitacion) {
            $errores['tipo_habitacion'] = 'El tipo de habitación es obligatorio';
        }

        return $errores;
    }


    public static function getAll()
    {
        $conexion = conectar();
        $sql = "SELECT tipo_habitacion, num_habitacion, descripcion FROM habitacion";
        $result = $conexion->query($sql);
        $habitaciones = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        $conexion->close();
        return $habitaciones;
    }
}
