<?php

/*
    Modelo: model.create.php
    Descripción: Añade un nuevo profesor a la tabla

    Método POST:
    - id
    - nombre
    - apellidos
    - nrp
    - fecha_nacimiento
    - poblacion
    - especialidad
    - asignaturas
*/

#   Cargo los detalles del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$nrp = $_POST['nrp'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$poblacion = $_POST['poblacion'];
$especialidad = $_POST['especialidad'];
$asignaturas = $_POST['asignaturas'];

#   Creo un objeto de la clase tabla profesores
$obj_tabla_profesor = new Class_tabla_profesor();

#   Cargo los profesores
$obj_tabla_profesor->getDatos();

#   Cargo las especialidades
$especialidades = $obj_tabla_profesor->getEspecialidad();

#   Cargo las asignaturas
$array_asignaturas = $obj_tabla_profesor->getAsignaturas(); //  OJO!!!  Poner un nombre que no sea $asignaturas para que almacene la carga

#   Creo un objeto a partir de los detalles del formulario

$profesor = new Class_profesor(
    $id,
    $nombre,
    $apellidos,
    $nrp,
    $fecha_nacimiento,
    $poblacion,
    $especialidad,
    $asignaturas
);

#   Añadir profesor a la tabla
$obj_tabla_profesor->create($profesor);

#   Obtener array del profesor creado
$array_profesores = $obj_tabla_profesor->tabla;
