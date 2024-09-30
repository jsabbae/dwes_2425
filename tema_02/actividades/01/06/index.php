<!-- Ejercicio 6.

Este ejercicio se guardará en la carpeta DWES/Tema-02/Actividades/01/06/index.php

Crear un programa PHP en el que se declaren las siguientes variables: 
Nombre, Apellidos, Población, Edad, Ciclo, Curso y Módulo. Asignar valor a dichas variables.
 Insertar un título en la cabecera de la página y mostrar los valores de dichas variables en una tabla a
  dos columnas (Campo y Valor). -->
<?php
$nombre = "Juan Manuel";
$apellidos = "Saborido Baena";
$poblacion = "Ubrique";
$edad = 20;
$ciclo = "Superior";
$curso = "2ºDAW";
$modulo = "Desarrollo Web en Entorno Servidor";

echo "<table border = 1>";
echo "<tr><td>Nombre</td><td>$nombre</td></tr>";
echo "<tr><td>Apellidos</td><td>$apellidos</td></tr>";
echo "<tr><td>Población</td><td>$poblacion</td></tr>";
echo "<tr><td>Edad</td><td>$edad</td></tr>";
echo "<tr><td>Ciclo</td><td>$ciclo</td></tr>";
echo "<tr><td>Curso</td><td>$curso</td></tr>";
echo "<tr><td>Modulo</td><td>$modulo</td></tr>";
echo "</table>";
?>