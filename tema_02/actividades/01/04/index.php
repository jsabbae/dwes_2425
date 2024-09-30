<!-- Ejercicio 4.

Este ejercicio se guardará en la carpeta DWES/Tema-02/Actividades/01/04/index.php

Crear en un script Php que cree dos variables una de tipo float y otra de tipo int. 
Almacenar en nuevas variables el resultado de la suma, resta, división, producto y potencia.
 Mostrar mediante var_dump() 
las variables con los resultados de las operaciones anteriores. -->


<?php
$numeroDecimal = 4.56;
$numeroEntero = 2;


$suma = $numeroDecimal + $numeroEntero;
$resta = $numeroDecimal - $numeroEntero;
$multiplicacion = $numeroDecimal * $numeroEntero;
$division = $numeroDecimal / $numeroEntero;
$potencia = pow($numeroDecimal, $numeroEntero);

echo "suma: ";
var_dump($suma);
echo "<br>";

echo "resta: ";
var_dump($resta);
echo "<br>";

echo "multiplicación: ";
var_dump($multiplicacion);
echo "<br>";

echo "división: ";
var_dump($division);
echo "<br>";

echo "potencia: ";
var_dump($potencia);
?>