<?php

    /*
        Librería proyecto 33 CRUD libros
    */

    # Obtiene la tabla de libros
    function get_tabla_libros () {

        $tabla = [
            [
                'id' => '1',
                'titulo' => 'Los Señores del tiempo',
                'autor' => 'García Sénz de Urturi',
                'genero' => 'Novela',
                'precio' => '19.5'
            ],
            [
                'id' => '2',
                'titulo' => 'El rey Recibe',
                'autor' => 'Eduardo Mendoza',
                'genero' => 'Novela',
                'precio' => '20.5'
            ],
            [
                'id' => '3',
                'titulo' => 'Diario de una mujer',
                'autor' => 'Eduardo Mendoza',
                'genero' => 'Juvenil',
                'precio' => '12.95'
            ],
            [
                'id' => '4',
                'titulo' => 'El Quijote de la Mancha',
                'autor' => 'Miguel de Cervantes',
                'genero' => 'Novela',
                'precio' => '15.95'
            ]
        ];
        
    return $tabla;

    }