<!-- Ejercicio 7.

Este ejercicio se guardará en la carpeta DWES/Tema-02/Actividades/01/07/index.php

A partir del ejercicio anterior, crear un párrafo en el que se cuente una pequeña historia 
o descripción con los datos de dicha variables. 
Colocar un título.-->
<?php
echo "<center><h1>Descripción personal</h1></center>";


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


echo"<p>";
echo"En Ubrique, vivía un joven llamado Juan Manuel Saborido. Tiene 20 años, Juan Manuel siempre mostró un gran interés por aprender y crecer. Actualmente,
 está cursando su segundo año en el ciclo superior de Programación Web.";
 echo"</p>";

 echo"<p>";
 echo"Con una edad que permite el equilibrio entre la juventud y la experiencia, 
 Juan se encuentra en plena etapa de formación. 
 Su dedicación al estudio es evidente en cada uno de los módulos que aborda con entusiasmo.";
 echo"</p>";
?>