<?php

/*
    Modelo: model.filtrar.php
    Descripción: muestra los corredores que contienen el patrón de búsqueda. 
                 el registro seleccionado debe contener dicha expresión en cualquiera de los campos

    Parámetros:
        - expresion: patrón de búsqueda
        
*/

# Símbolo monetario local
setlocale(LC_MONETARY, "es_ES");

# Obtener el criterio de ordenación
$expresion = $_GET['expresion'];

# Creo un objeto de la clase tabla corredores
$tabla_corredores = new Class_tabla_corredores();

# Ejecuto el  método filter() y devuelve objeto de la clase
# mysqli_result
$corredores = $tabla_corredores->filter($expresion);


