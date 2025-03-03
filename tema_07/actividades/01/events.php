<?php
//  Inicio se sesión o continuar sesión
session_name('Actividad7_1');

session_start();

// Creamos variables de sesión
if (isset($_SESSION['num_visitas_events'])) {   //  Si la variable ya existe (si ya ha visitado la página)
    $_SESSION['num_visitas_events']++; //  Se incrementa un contador de visitas cada vez que el usuario navegue por la página
} else {    //  Si la variable no existe, es la primera vez que se visita la página
    $_SESSION['num_visitas_events'] = 1;    //  Se inicializa el contador
}

// Variable de sesión para la fecha de inicio de sesión
if (!isset($_SESSION['inicio_sesion'])) {
    $_SESSION['inicio_sesion'] = date("Y-m-d H:i:s");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 7.1</title>
</head>

<body>
    <ul>
        <li>
            <a href="home.php">Home</a>
        </li>
        <li>
            <a href="about.php">About</a>
        </li>
        <li>
            <a href="services.php">Services</a>
        </li>
        <li>
            <a href="events.php">Events</a>
        </li>
        <li>
            <a href="close.php">Close</a>
        </li>
    </ul>
    <hr>
    <h3>Información</h3>
    <ul>
        <li>
            Página: Events
        </li>
        <li>
            SID: <?= session_id() ?>
        </li>
        <li>
            Nombre Sesión: <?= session_name() ?>
        </li>
        <li>
            Fecha/Hora Inicio Sesión: <?= $_SESSION['inicio_sesion'] ?>
        </li>
        <li>
            Visitas Home: <?= $_SESSION['num_visitas_events'] ?>
        </li>
    </ul>
</body>

</html>