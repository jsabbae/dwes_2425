<?php

/*
    Definimos los privilegios de la palicación

    Recordamos los perfiles:
    - 1: Administrador
    - 2: Editor
    - 3:  Registro

            Recordamos los controladores o recursos:
        - 1: Libro
    
    Los privilegios son:
    -1: main
    -2: new
    -3: edit
    -4: delete
    -5: show
    -6: order
    -7: filter

    Los perfiles se asignarán mediante un array asociativo,
     donde la clave principal se corresponde con el controlador
     la clave secundaria con el método.

    $GLOBALS['libros']['main'] = [1, 2, 3];

    Se asignan que tienen acceso a un determinado método del controlador libro

*/
$GLOBALS['libros']['main'] = [1, 2, 3];
$GLOBALS['libros']['nuevo'] = [1, 2];
$GLOBALS['libros']['editar'] = [1, 2];
$GLOBALS['libros']['eliminar'] = [1];
$GLOBALS['libros']['mostrar'] = [1, 2, 3];
$GLOBALS['libros']['filtrar'] = [1, 2, 3];
$GLOBALS['libros']['ordenar'] = [1, 2, 3];
$GLOBALS['libros']['exportar'] = [1];
$GLOBALS['libros']['importar'] = [1];