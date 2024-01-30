<?php

namespace Controllers;

use Model\Habitacion;
use Model\Reserva;

class ReservaController
{

    public function mostrarFormularioReserva()
    {
        // Obtener todas las habitaciones disponibles desde la DB
        $habitacionesDisponibles = Habitacion::getAll();

        include_once(__DIR__ . '/../view/formulario.php');
    }

    public function mostrarReservas()
    {
        // Obtener todas las habitaciones disponibles desde la DB
        $habitacionesDisponibles = Reserva::getAll();

        include_once(__DIR__ . '/../view/inforeservas.php');
    }


    public function crearReserva()
    {
        // Recibir datos del formulario
        $nombreCliente = $_POST['nombre_cliente'] ?? null;
        $telefonoCliente = $_POST['telefono'] ?? null;
        $emailCliente = $_POST['email'] ?? null;
        $fechaIni = $_POST['check_in'] ?? null;
        $fechaFin = $_POST['check_out'] ?? null;
        $numPersonas = $_POST['nro_personas'] ?? null;
        $preferencias = $_POST['preferencias'] ?? null;
        $numHabitacion = $_POST['habitacion'] ?? null;

        $numHabitacion = intval($_POST['habitacion']);
        $numPersonas = intval($_POST['nro_personas']);

        // Validar disponibilidad de la habitación
        if (!Reserva::validarDisponibilidad($numHabitacion, $fechaIni, $fechaFin)) {
            echo '<script>';
            echo 'alert("Lo sentimos, la habitación seleccionada no está disponible para las fechas especificadas. Por favor, elija otra habitación o ajuste las fechas de su reserva!");';
            echo 'window.location.href = "/";';
            echo '</script>';
            return;
        }

        // Crear reserva
        $reserva = new Reserva([
            'nombre' => $nombreCliente,
            'telefono' => $telefonoCliente,
            'email' => $emailCliente,
            'id_habitacion' => $numHabitacion,
            'fecha_ini' => $fechaIni,
            'fecha_fin' => $fechaFin,
            'num_personas' => $numPersonas,
            'preferencias' => $preferencias
        ]);

        // Validar los campos del form
        $errores = $reserva->validar();
        if (!empty($errores)) {
            // Mostrar los errores de validación en el frontend
            foreach ($errores as $campo => $mensaje) {
                echo $mensaje;
                echo '<br>';
            }
            return;
        }

        // Guardar la reserva en la DB
        $resultado = $reserva->guardar();
        if ($resultado) {
            echo '<script>';
            echo 'alert("Reserva creada con éxito!");';
            echo 'window.location.href = "/";'; // Redirigir pag principal
            echo '</script>';
        } else {
            echo '<script>';
            echo 'alert("Oops... Algo salió mal!");';
            echo 'window.location.href = "/";'; // Redirigir pag principal
            echo '</script>';
        }
    }
}
