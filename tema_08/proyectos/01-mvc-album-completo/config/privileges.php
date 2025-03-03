<?php

/*
    Definimos los privilegios de la palicación

    Recordamos los perfiles:
    - 1: Administrador
    - 2: Editor
    - 3:  Registro

            Recordamos los controladores o recursos:
        - 1: Album
    
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

    $GLOBALS['album']['main'] = [1, 2, 3];

    Se asignan que tienen acceso a un determinado método del controlador album

*/
$GLOBALS['album']['main'] = [1, 2, 3];
$GLOBALS['album']['nuevo'] = [1, 2];
$GLOBALS['album']['editar'] = [1, 2];
$GLOBALS['album']['eliminar'] = [1];
$GLOBALS['album']['agregarImagenes'] = [1, 2];
$GLOBALS['album']['mostrar'] = [1, 2, 3];
$GLOBALS['album']['filtrar'] = [1, 2, 3];
$GLOBALS['album']['ordenar'] = [1, 2, 3];