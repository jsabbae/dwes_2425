<?php

/*
    Creamos una clase para cada tabla
    las propiedades públicas y una propiedad para cada columna

    No respetará la propiedad de encapsulamiento.
*/

class classLibro
{

    public $id;
    public $titulo;
    public $autor_id;
    public $editorial_id;
    public $generos_id;
    public $stock;  //  Unidades
    public $precio;
    public $fecha_edicion;
    public $isbn;

    public function __construct(
        $id = null,
        $titulo = null,
        $autor_id = null,
        $editorial_id = null,
        $generos_id = null,
        $stock = null,
        $precio = null,
        $fecha_edicion = null,
        $isbn = null,
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor_id = $autor_id;
        $this->editorial_id = $editorial_id;
        $this->generos_id = $generos_id;
        $this->stock = $stock;
        $this->precio = $precio;
        $this->fecha_edicion = $fecha_edicion;
        $this->isbn = $isbn;
    }
}