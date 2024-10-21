<?php

/*
    Librería proyecto 37 CRUD libros
*/

# Obtiene la tabla de libros
function get_tabla_libros()
{

    $tabla = [
        [
            'id' => 1,
            'titulo' => 'Los Señores del tiempo',
            'autor' => 'García Sénz de Urturi',
            'editorial' => 'Anaya',
            'genero' => 'Novela',
            'precio' => '19.5'
        ],
        [
            'id' => 2,
            'titulo' => 'El rey Recibe',
            'autor' => 'Eduardo Mendoza',
            'editorial' => 'Santillana',
            'genero' => 'Novela',
            'precio' => '20.5'
        ],
        [
            'id' => 3,
            'titulo' => 'Diario de una mujer',
            'autor' => 'Eduardo Mendoza',
            'editorial' => 'Síntesis',
            'genero' => 'Juvenil',
            'precio' => '12.95'
        ],
        [
            'id' => 4,
            'titulo' => 'El Quijote de la Mancha',
            'autor' => 'Miguel de Cervantes',
            'editorial' => 'Neptuno',
            'genero' => 'Novela',
            'precio' => '15.95'
        ]
    ];
    return $tabla;
}

function buscar_tabla($tabla, $columna, $valor)
{
    $columna_id = array_column($tabla, $columna);
    $indice = array_search($valor, $columna_id);
    return $indice;
}

function buscar_tabla_2($tabla, $columna, $valor)
{
    foreach ($tabla as $indice => $registro) {
        if ($registro[$columna] == $valor) {
            return $indice;
        }
    }
    return false;
}