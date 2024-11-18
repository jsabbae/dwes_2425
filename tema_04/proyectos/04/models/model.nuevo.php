<?php

/*
    Modelo: model.nuevo.php
    Descripción: genera los datos necesarios para crear un profesor
*/

#   Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

#   Creo un objeto de la clase tabla profesor
$obj_tabla_profesor = new Class_tabla_profesor();

#   Cargo tabla especialidades
$especialidades = $obj_tabla_profesor->getEspecialidad();

#   Cargo tabla asignaturas
$asignaturas = $obj_tabla_profesor->getAsignaturas();





