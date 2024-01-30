<?php

namespace Model;

require_once './includes/database.php';

class Reserva
{
    public $id;
    public $nombre;
    public $email;
    public $telefono;
    public $id_habitacion;
    public $fecha_ini;
    public $fecha_fin;
    public $num_personas;
    public $preferencias;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->id_habitacion = $args['id_habitacion'] ?? null;
        $this->fecha_ini = $args['fecha_ini'] ?? null;
        $this->fecha_fin = $args['fecha_fin'] ?? null;
        $this->num_personas = $args['num_personas'] ?? null;
        $this->preferencias = $args['preferencias'] ?? null;
    }

    // Validaciones 
    public function validar()
    {
        $errores = [];

        if (!$this->nombre) {
            $errores['nombre'] = 'El Nombre es Obligatorio';
        }
        if (!$this->email) {
            $errores['email'] = 'El campo E-mail es Obligatorio';
        }
        if (!$this->telefono) {
            $errores['telefono'] = 'El Telefono es Obligatorio';
        }

        if (!is_numeric($this->num_personas) || $this->num_personas <= 0 || $this->num_personas > 9) {
            $errores['num_personas'] = 'El número de personas debe ser un valor numérico positivo y no mayor a 8.';
        }

        return $errores;
    }

    public function guardar()
    {
        $conexion = conectar();
        $sql = "INSERT INTO reserva (id, nombre, telefono, email, id_habitacion, fecha_ini, fecha_fin, num_personas, preferencias) VALUES (UUID_TO_BIN(UUID()), ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        if (!$stmt) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        // Bind parameters
        $resultado = $stmt->bind_param("ssssssis", $this->nombre, $this->telefono, $this->email, $this->id_habitacion, $this->fecha_ini, $this->fecha_fin, $this->num_personas, $this->preferencias);
        if (!$resultado) {
            die("Error al enlazar parámetros: " . $stmt->error);
        }

        // Execute statement
        $resultado = $stmt->execute();
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        return $resultado;
    }

    public static function getAll()
    {
        $conexion = conectar();
        $sql = "SELECT nombre, telefono, email, id_habitacion, fecha_ini, fecha_fin, num_personas, preferencias 
            FROM reserva
            ORDER BY fecha_ini DESC"; // Filtra fecha_ini en orden descendente (más reciente primero)
        $result = $conexion->query($sql);
        $reservas = [];
        while ($row = $result->fetch_assoc()) {
            $reserva = new Reserva($row);
            $reservas[] = $reserva;
        }
        return $reservas;
    }


    public static function validarDisponibilidad($numHabitacion, $fechaIni, $fechaFin)
    {
        // Convertir fechas a formato adecuado para consultas SQL 
        $fechaIniSQL = date("Y-m-d", strtotime($fechaIni));
        $fechaFinSQL = date("Y-m-d", strtotime($fechaFin));

        // Conectar a la base de datos
        $conexion = conectar();

        // Consultar si hay reservas existentes para la habitación durante el período especificado
        $sql = "SELECT COUNT(*) AS total_reservas FROM reserva WHERE id_habitacion = $numHabitacion AND (fecha_ini BETWEEN '$fechaIniSQL' AND '$fechaFinSQL' OR fecha_fin BETWEEN '$fechaIniSQL' AND '$fechaFinSQL')";
        $resultado = $conexion->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $totalReservas = $fila['total_reservas'];

            // Si hay alguna reserva para la habitación durante el período especificado, entonces no está disponible
            return $totalReservas == 0;
        } else {
            // Manejo de errores si la consulta falla o no devuelve resultados
            return false;
        }
    }
}
