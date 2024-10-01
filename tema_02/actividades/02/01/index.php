<!-- Actividad 2.2 - Estado de una variable. isset(), empty(), is_null() -->
<?php
//  Ejercicio 1. Conversiones de datos en expresiones.

// Crear un script PHP donde se muestre el tipo de dato y resultado de las siguientes expresiones matemáticas:

// Multiplica valor entero con una cadena que contiene un número inicial
// Sumar valor entero con cadena con número inicial
// Sumar valor entero con valor float
// Concatenar valor entero con cadena
// Sumar valor entero con valor booleano




$integer = 5;
$string = "10 poemas de amor y una canción desesperada";
$float = 3.14;
$boolean = true;


$result1 = $integer * $string;
var_dump($result1);
echo "<br>";

$result2 = $integer + $string;
var_dump($result2);
echo "<br>";

$result3 = $integer + $float;
var_dump($result3);
echo "<br>";

$result4 = $integer . $string;
var_dump($result4);
echo "<br>";

$result5 = $integer + $boolean;
var_dump($result5);
?>