<?php
/*
    Modelo: model.create.php
    Método POST 
        - id
        - descripcion
        - modelo
        - marca
        - categorias
        - unidades
        - precio
*/


// Carga de categorias y marcas
$categorias = ArrayArticulos::getCategorias();
$marcas = ArrayArticulos::getMarcas();

// Cargamos el array de objetos con articulos
$articulos = new ArrayArticulos();
$articulos->getDatos();

// Recogemos los datos del formulario
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$modelo = $_POST['modelo'];
$marca = $_POST['marcas'];
$categorias_art = $_POST['categorias'];
$unidades = $_POST['unidades'];
$precio = $_POST['precio'];


// Invocamos a la función nuevo(), que nos permitirá introducir
//nuevo($articulos,$id,$descripcion,$modelo,$categori,$unidades,$precio);
$articulo = new Articulo($id, $descripcion, $modelo, $marca, $categorias_art, $unidades, $precio);

// Añadimos el nuevo artículo(objeto) usando la funcion create
$articulos->create($articulo);

// Generamos una notificación
$notificacion = "Has creado un artículo";

?>