<?php
// Cargamos los valores correspondientes
$categorias = ArrayArticulos::getCategorias();
$marcas = ArrayArticulos::getMarcas();

// Creamos un objeto 
$articulos = new ArrayArticulos;

// Cargamos los datos
$articulos->getDatos();

// obtenemos el indice
$indice = $_GET['indice'];

// Recogemos los datos del formulario
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$modelo = $_POST['modelo'];
$marca = $_POST['marca'];
$categorias_art = $_POST['categorias'];
$unidades = $_POST['unidades'];
$precio = $_POST['precio'];


// Creamos un objeto de articulo
$articulo = new Articulo(
    $id,
    $descripcion,
    $modelo,
    $marca,
    $categorias_art,
    $unidades,
    $precio
);
// Añadimos el objeto artículo actualizado
$articulos->update($indice, $articulo);

// Notificación
$notificacion = "Artículo modificado";
?>