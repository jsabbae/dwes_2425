<?php

/*
    Modelo: model.delete.php
    Descripción: Elimina un elemento de la lista

    Método GET:
        - id libro que se desea eliminar
*/

# Cargo id 
$id = $_GET['id'];

# Cargar la tabla de libros
$libros = get_tabla_libros();

# Buscar id en la tabla libros y devuelvo índice.
$indice_eliminar = buscar_tabla_2($libros, 'id', $id);

# Validar la búsqueda
if ($indice_eliminar !== false) {

    // Eliminar Libro
    unset($libros[$indice_eliminar]);

} else {

    echo "ERROR: libro no encontrado";
    exit();
}


