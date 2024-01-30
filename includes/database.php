<?php

function conectar()
{
    $host = $_ENV['DB_HOST'];
    $usuario = $_ENV['DB_USER'];
    $contrasena = $_ENV['DB_PASS'];
    $nombre_base_de_datos = $_ENV['DB_NAME'];

    $conexion = new mysqli($host, $usuario, $contrasena, $nombre_base_de_datos);

    if ($conexion->connect_errno) {
        die("Error al conectar a la base de datos: " . $conexion->connect_error);
    }

    $conexion->set_charset("utf8");

    return $conexion;
}
