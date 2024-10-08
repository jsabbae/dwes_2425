<?php
/**
 * Devuelve el item de una calificación:
 * - Deficiente, insuficiente, suficiente ...
 */
$calif = 7;

switch (true) {
    case ($calif < 0):
        $item = "Calificación no permitida";
        break;

    case ($calif <= 3):
        $item = "Deficiente";
        break;

    case ($calif > 3):
        $item = "Insuficiente";
        break;

    case ($calif >= 4.50):
        $item = "Suficiente";
        break;

    case ($calif >= 5.50):
        $item = "Bien";
        break;

    case ($calif >= 7):
        $item = "Notable";
        break;

    case ($calif == 10):
        $item = "Sobresaliente";
        break;

    default:
        $item = "Calificación no permitida";
}

?>