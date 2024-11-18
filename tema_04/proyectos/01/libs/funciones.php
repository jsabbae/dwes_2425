<?php

// Buscar en tabla
function buscar($tabla = [], $columna, $valor)
{
    $columnaValores = array_column($tabla, $columna);
    return array_search($valor, $columnaValores, false);
}


// Generar tabla de categorías
function generar_tabla_categorías()
{
    $categorias = [
        'Portátiles',
        'PCs Sobremesa',
        'Componentes',
        'Pantallas',
        'Impresoras',
        'Tablets',
        'Móviles',
        'Fotografía',
        'Imagen',
        'Accesorios'

    ];
    // Ordenamos el array, manteniendo la asociación de indices
    asort($categorias);
    return $categorias;
}

// Generar tabla con las marcas

function generar_tabla_marcas()
{
    $marcas = [
        'Apple',
        'Xiaomi',
        'Casio',
        'Nokia',
        'Logitech',
        'IBM',
        'BQ',
        'Hacendado'

    ];
    // Ordenamos el array, manteniendo la asociación de indices
    asort($marcas);
    return $marcas;
}

// DATOS
// Generar tabla de artículos
function generar_tabla()
{
    $tabla = [
        [
            'id' => 1,
            'descripcion' => 'Laptop Acer Aspire 15',
            'modelo' => 'A315-42',
            'marca' => 0,
            'categorias' => [1, 2, 3],
            'unidades' => 10,
            'precio' => 799.99
        ],
        [
            'id' => 2,
            'descripcion' => 'Monitor HP 27 pulgadas',
            'modelo' => 'HP27X',
            'marca' => 3,
            'categorias' => [1, 2, 0],
            'unidades' => 15,
            'precio' => 299.99
        ],
        [
            'id' => 3,
            'descripcion' => 'Teclado inalámbrico Logitech',
            'modelo' => 'K780',
            'marca' => 5,
            'categorias' => [1, 4],
            'unidades' => 20,
            'precio' => 49.99
        ],
        [
            'id' => 4,
            'descripcion' => 'Impresora Epson EcoTank',
            'modelo' => 'ET-2750',
            'marca' => 4,
            'categorias' => [1],
            'unidades' => 5,
            'precio' => 349.99
        ],
        [
            'id' => 5,
            'descripcion' => 'Disco Duro Externo Seagate 2TB',
            'modelo' => 'STEA2000400',
            'marca' => 2,
            'categorias' => [2, 3],
            'unidades' => 12,
            'precio' => 79.99
        ],
        [
            'id' => 6,
            'descripcion' => 'Router Wi-Fi TP-Link Archer C7',
            'modelo' => 'AC1750',
            'marca' => 5,
            'categorias' => [4],
            'unidades' => 8,
            'precio' => 89.99
        ],
        [
            'id' => 7,
            'descripcion' => 'Tarjeta gráfica NVIDIA GeForce RTX 3080',
            'modelo' => 'RTX 3080',
            'marca' => 2,
            'categorias' => [2, 3],
            'unidades' => 3,
            'precio' => 899.99
        ]
    ];
    return $tabla;
}


// Funcion nuevo
function nuevo($tabla = [], $elemento)
{
    $tabla[] = $elemento;
    return $tabla;
}
// Funcion actualizar
function actualizar($tabla = [], $indice, $elemento)
{
    $tabla[$indice] = $elemento;
    return $tabla;
}

// Funcion eliminar
function eliminar($tabla = [], $id)
{
    // Buscar el índice a eliminar
    $indiceEliminar = buscar($tabla, 'id', $id);

    if ($indiceEliminar !== false) {
        // Eliminamos el artículo seleccionado
        unset($tabla[$indiceEliminar]);

        // Reconstruimos el array para quitar huecos
        $tabla = array_values($tabla);
    }

    return $tabla;
}

// MUESTRA LAS CATEGORIAS
function mostrarCategorias($categorias, $categoriasArticulo = [], )
{
    $arrayCategorias = [];
    foreach ($categoriasArticulo as $indice) {
        $arrayCategorias[] = $categorias[$indice];
    }
    asort($arrayCategorias);
    return $arrayCategorias;
}

?>