<?php
/**
 * Calificación de una nota de 0 a 10
 * Mosrtará: deficiente, insuficiente, suficiente, bien, notable o sobresaliente
 */
$a = 11;

if ($a >= 0 && $a < 3) {
    echo "Deficiente";
} else if ($a >= 3 && $a < 5) {
    echo "Insuficiente";
} else if ($a == 5) {
    echo "Suficiente";
} else if ($a == 6) {
    echo "Bien";
} else if ($a > 6 && $a < 10) {
    echo "Notable";
} elseif ($a == 10) {
    echo "Sobresaliente";
} else {
    echo "Calificación no permitida";
}

?>