<?php

    /*
        Modelo: model.delete.php
        Descripción: Elimina un elemento de la lista

        Método GET:
            - id alumno que se desea eliminar
    */

    # Cargo id 
    $id = $_GET['id'];

    # Cargar la tabla de alumnos
    $libros = get_tabla_libros();

    # Buscar id en la tabla alumnos y devuelvo índice.
    $indice_eliminar = buscar_tabla($libros, 'id', $id);

    # Validar la búsqueda
    if ($indice_eliminar !== false) {
        
        // Eliminar Alumno
        unset($libros[$indice_eliminar]);

    } else {
        
        echo "ERROR: libro no encontrado";
        exit();
    }

    
