<?php
/**
 * Calificación de una nota de 0 a 10
 * Mosrtará: deficiente, insuficiente, suficiente, bien, notable o sobresaliente
 */
$a = 7;

if ($a < 2) {
    echo "Deficiente";
} else if ($a < 5) {
    echo "Insuficiente";
} else if ($a < 6) {
    echo "Suficiente";
} else if ($a < 7) {
    echo "Bien";
} else if ($a < 9) {
    echo "Notable";
} elseif ($a <= 10) {
    echo "Sobresaliente";
} else {
    echo "Calificación no permitida";
}

?>