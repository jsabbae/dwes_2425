<?php
/*
    La página close cierra la sesión y muestra la duración y el número de visitas
*/

//  Inicio se sesión o continuar sesión
session_name('Actividad7_1');
session_start();

$visitas_totales = 0;

//  La variables que están definidas en $_SESSION se almacenarán en visitas_totales

if (isset($_SESSION['num_visitas_home'])) {
    $visitas_totales += $_SESSION['num_visitas_home'];
}
if (isset($_SESSION['num_visitas_services'])) {
    $visitas_totales += $_SESSION['num_visitas_services'];
}
if (isset($_SESSION['num_visitas_events'])) {
    $visitas_totales += $_SESSION['num_visitas_events'];
}
if (isset($_SESSION['num_visitas_about'])) {
    $visitas_totales += $_SESSION['num_visitas_about'];
}

if (!isset($_SESSION['inicio_sesion'])) {
    $_SESSION['inicio_sesion'] = date("Y-m-d H:i:s");
}

?>

<!DOCTYPE html>
<html lang="en">

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
    <h3>Información</h3>
    <ul>
        <li>
            Página: Close
        </li>
        <li>
            SID: <?= session_id() ?>
        </li>
        <li>
            Nombre Sesión: <?= session_name() ?>
        </li>
        <li>
            Visitas Totales: <?= $visitas_totales; ?>
        </li>
        <li>
            Fecha/Hora Inicio Sesión: <?= $_SESSION['inicio_sesion'] ?>
        </li>

        <?php

        $fin_sesion = date("Y-m-d H:i:s");
        $duracion_sesion = strtotime($fin_sesion) - strtotime($_SESSION['inicio_sesion']);
        session_destroy();

        ?>
        <li>
            Fecha/Hora Fin Sesión: <?php echo $fin_sesion ?>
        </li>
        <li>
            Duración Sesión: <?= $duracion_sesion ?> segundos.
        </li>

    </ul>
</body>

</html>