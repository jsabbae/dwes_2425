<!-- Actividad 2.2 - Estado de una variable. isset(), empty(), is_null() -->
<?php
//  Ejercicio 1. Conversiones de datos en expresiones.

// Crear un script PHP donde se muestre el tipo de dato y resultado de las siguientes expresiones matemáticas:

// Multiplica valor entero con una cadena que contiene un número inicial
// Sumar valor entero con cadena con número inicial
// Sumar valor entero con valor float
// Concatenar valor entero con cadena
// Sumar valor entero con valor booleano

$v1 = 3;
$v2 = "10 poemas de amor y una canción desesperada";
$v3 = 3.64;
$v4 = " poemas de amor y una canción desesperada";
$v5 = false;

var_dump($v1 * $v2);


echo "<br>";

var_dump($v1 + $v2);

echo "<br>";

var_dump($v1 + $v3);

echo "<br>";

var_dump($v1 + $v4);

echo "<br>";

var_dump($v1 + $v5);

echo "<br>";

// Ejercicio 2. is_null().

// Crear un script PHP donde se muestre el resultado de 3 valores verdaderos y tres valores falsos para la función is_null()

$var6 = true;
$var7 = true;
$var8 = true;
$var9 = false;
$var10 = false;
$var11 = false;

// Ejercicio 3. issetl().

// Crear un script PHP donde se muestre el resultado de 3 valores verdaderos y tres valores falsos para la función isset()


// Ejercicio 4. empty().

// Crear un script PHP donde se muestre el resultado de 3 valores verdaderos y tres valores falsos para la función empty()
