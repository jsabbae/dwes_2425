<?php
/*
Ejemplo
Descripción: crear objetos a partir de la clase  Clases_alumno

*/
include 'class/class.vehiculo.php';

# Establecer velocidad a 10 km
$vehiculo=new Class_vehiculo();

# Mostrar detalles del vehiculo
echo "Matrícula: " . $vehiculo->getMatricula();
echo "<br>";
echo "Velocidad: " . $vehiculo->getVelocidad();
echo "<br>";
var_dump($vehiculo);
?>