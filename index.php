<?php

use Controllers\ReservaController;
use Dotenv\Dotenv;


require __DIR__ . '/vendor/autoload.php';

// Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Ruta principal para mostrar el formulario de reserva
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/') {
    $reservaController = new ReservaController();
    $reservaController->mostrarFormularioReserva(); // Metodo que muestra el formulario HTML
    exit;
}

// Ruta principal para mostrar las reservas
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/reservas') {
    $reservaController = new ReservaController();
    $reservaController->mostrarReservas(); // Metodo que muestra las reservas
    exit;
}

// Ruta para manejar la creación de una nueva reserva
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/') {
    $reservaController = new ReservaController();
    $reservaController->crearReserva(); // Método para crear una nueva reserva
    exit;
}


// Mostrar error 404 si la ruta no se encuentra
http_response_code(404);
echo "Error 404 - Pagina no encontrada";
