<?php
/*
Ejemplo
Descripción: crear objetos a partir de la clase  Clases_alumno

*/
include 'class/class.vehiculo.php';
# Crea un objeto de la clase vehiculo
$vehiculo = new Class_vehiculo();

# Establecer la matrícula del vehículo  6712HRM
$vehiculo->setMatricula('6712HRM');

# Establecer velocidad a 10 km
$vehiculo->setVelocidad(10);

# Mostrar detalles del vehiculo
echo "Matrícula: " . $vehiculo->getMatricula();
echo "<br>";
echo "Velocidad: " . $vehiculo->getVelocidad();
?>