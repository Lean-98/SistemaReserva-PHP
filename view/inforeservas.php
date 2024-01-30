<?php

use Model\Reserva;

// Obtener todas las reservas
$reservas = Reserva::getAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <!-- Styles-->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End Styles -->
</head>

<body>
    <!-- Navbar -->
    <?php include_once(__DIR__ . '/../view/navbar.php'); ?>
    <!-- End Navbar -->

    <div class="container">
        <h1 class="text-center">Listado de Reservas</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <!-- <th scope="col">Teléfono</th>
                    <th scope="col">Email</th> -->
                    <th scope="col">N° Habitación</th>
                    <th scope="col">Fecha Inicio</th>
                    <th scope="col">Fecha Fin</th>
                    <th scope="col">N° Personas</th>
                    <th scope="col">Preferencias</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva) : ?>
                    <tr>
                        <td><?php echo $reserva->nombre; ?></td>
                        <!-- <td><?php echo $reserva->telefono; ?></td>
                        <td><?php echo $reserva->email; ?></td> -->
                        <td><?php echo $reserva->id_habitacion; ?></td>
                        <td><?php echo $reserva->fecha_ini; ?></td>
                        <td><?php echo $reserva->fecha_fin; ?></td>
                        <td><?php echo $reserva->num_personas; ?></td>
                        <td><?php echo $reserva->preferencias; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <?php include_once(__DIR__ . '/../view/footer.php'); ?>
    <!-- End Footer -->

    <!-- Scripts -->
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- End Scripts -->
</body>

</html>