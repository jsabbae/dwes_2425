<?php
    // Cargamos los valores correspondientes
    $categorias = ArrayArticulos::getCategorias();
    $marcas = ArrayArticulos::getMarcas();

    //  Creamos un objeto de la clase ArrayArticulos
    $articulos = new ArrayArticulos;

    // Cargamos los datos
    $articulos->getDatos();

    // Extraemos el id
    $indice = $_GET['indice'];

    // cargamos los detallas del artículo a partir del indice (dentro de un objeto de la clase artículo)
    $articulo = $articulos->read($indice);


?>