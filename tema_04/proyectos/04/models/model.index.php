<?php

/*
    Modelos: model.index.php
    Descripción: genero array objetos de la clase profesor
*/

#   Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

#   Creo un objeto de la clase tabla profesor
$obj_tabla_profesor = new Class_tabla_profesor();

#   Cargo tabla de especialidades
$especialidades = $obj_tabla_profesor->getEspecialidad();

#   Cargo tabla de asignaturas
$asignaturas = $obj_tabla_profesor->getAsignaturas();

#  Relleno el array de objetos
$obj_tabla_profesor->getDatos();

#   Obtener tabla de profesroes sin encapsulamiento
$array_profesores = $obj_tabla_profesor->tabla;