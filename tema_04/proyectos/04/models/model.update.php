<?php

/*
    Modelo: models/model.update.php
    Descripción: actualiza los detalles del profesor

    Método POST:
    - id
    - nombre
    - apellidos
    - nrp
    - fecha_nacimiento
    - poblacion
    - especialidad (indice)
    - asignaturas (array)

    Método GET:
    - indice (índice de la tabla correspondiente de dicho profesor)
*/

#   Símbolo local monetario
setlocale(LC_MONETARY, "es_ES");

#   Cargo el índice
$indice = $_GET['indice'];

#   Cargo los detalles del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$nrp = $_POST['nrp'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$poblacion = $_POST['poblacion'];
$especialidad = $_POST['especialidad'];
$asignaturas = $_POST['asignaturas'];

#   Creo un objeto de la clase profesores a partir de los detalles del formulario
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

#   Creo un objeto de la clase tabla profesores
$obj_tabla_profesor = new Class_tabla_profesor();

#   Cargo los profesores
$obj_tabla_profesor->getDatos();

#   Obtengo el array especialidades
$especialidades = $obj_tabla_profesor->getEspecialidad();

#   Obtengo el array asignaturas
$array_asignaturas = $obj_tabla_profesor->getAsignaturas();

#   Actualizo los detalles del profesor
$obj_tabla_profesor->update($profesor, $indice);

#   Comando alternativo por la propiedad NO encapsulamiento
$obj_tabla_profesor->tabla[$indice] = $profesor;

#   Obtener array profesores
$array_profesores = $obj_tabla_profesor->tabla;









