<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas</title>
    <!-- Style -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End Style -->
</head>

<body>
    <!-- Navbar -->
    <?php include_once(__DIR__ . '/../view/navbar.php'); ?>
    <!-- End Navbar -->

    <!-- Formulario -->
    <h1 class="text-center mt-5">Sistema de Reservas</h1>
    <div class="container">
        <form id="reservaForm" action="/" method="post">
            <!-- Campos de datos del cliente -->
            <h3>Datos Cliente</h3>
            <label class="form-label" for="nombre_cliente">Nombre Completo:</label>
            <input class="form-control" type="text" name="nombre_cliente" id="nombre_cliente" required>
            <?php if (!empty($errores['nombre'])) : ?>
                <span class="text-danger"><?php echo $errores['nombre']; ?></span>
            <?php endif; ?>

            <label class="form-label" for="telefono">Teléfono:</label>
            <input class="form-control" type="number" name="telefono" id="telefono" required>
            <?php if (!empty($errores['telefono'])) : ?>
                <span class="text-danger"><?php echo $errores['telefono']; ?></span>
            <?php endif; ?>

            <label class="form-label" for="email">Email:</label>
            <input class="form-control" type="email" name="email" id="email" required>
            <?php if (!empty($errores['email'])) : ?>
                <span class="text-danger"><?php echo $errores['email']; ?></span>
            <?php endif; ?>

            <!-- Detalles de la reserva -->
            <h3 class="mt-2">Detalles Reserva</h3>
            <label class="form-label" for="check_in">Fecha de reserva inicial:</label>
            <input class="form-control" type="date" name="check_in" id="check_in" required>

            <label class="form-label" for="check_out">Fecha de salida:</label>
            <input class="form-control" type="date" name="check_out" id="check_out" required>

            <!-- Selectores de tipo y número de habitación -->
            <h3 class="mt-2">Selección de Habitación</h3>
            <label class="form-label" for="habitacion">Seleccione la habitación:</label>
            <select class="form-select" name="habitacion" id="habitacion" required>
                <option value="" selected disabled>Elija una opción:</option>
                <?php foreach ($habitacionesDisponibles as $habitacion) : ?>
                    <option value="<?php echo $habitacion['num_habitacion']; ?>"><?php echo $habitacion['num_habitacion']; ?> - <?php echo $habitacion['tipo_habitacion']; ?>: <?php echo $habitacion['descripcion']; ?></option>
                <?php endforeach; ?>
            </select>

            <label class="form-label" for="nro_personas">Número de personas:</label>
            <input class="form-control" type="number" name="nro_personas" id="nro_personas" required>
            <?php if (!empty($errores['num_personas'])) : ?>
                <span class="text-danger"><?php echo $errores['num_personas']; ?></span>
            <?php endif; ?>

            <div class="form-floating mt-3">
                <textarea class="form-control" placeholder="" name="preferencias" id="preferencias" style="height: 100px"></textarea>
                <label for="preferencias">Preferencias especiales</label>
            </div>

            <button type="submit" class="btn btn-warning mt-4">Enviar</button>
        </form>
    </div>
    <!-- End Formulario -->

    <!-- Footer -->
    <?php include_once(__DIR__ . '/../view/footer.php'); ?>
    <!-- End Footer -->

    <!-- Scripts -->
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- End Scripts -->
</body>

</html>