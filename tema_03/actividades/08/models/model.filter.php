<?php
/*
    Modelo: model.filter.php
    Descripción: permite filtrar la tabla a partir de una expresión. 
    Todas las filas que contengan dicha expresión se mostrarán

    Método GET:
        - expresion: expresión de filtrado

*/

# Obtenemos patrón
$expresion = $_GET['expresion'];

# cargamos la tabla
$libros = get_tabla_libros();

# Filtramos la tabla a partir de la expresión

// Creo un array vacio donde irá cargando las filas que cumplen
// con la expresión de filtrado
$aux = [];

// Recorrer la  tabla fila a fila para comprobar la expresión
foreach ($libros as $registro) {
    if (array_search($expresion, $registro, false)) {
        $aux[] = $registro;
    }
}

$libros = $aux;