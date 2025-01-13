<?php

/*
    archivo:class.corredor.php
    titulo: define la clase corredor sin encapsulamiento
*/

class Class_corredor
{

    public $id;
    public $nombre;
    public $apellidos;
    public $ciudad;
    public $sexo;
    public $email;
    public $fechaNacimiento;
    public $dni;
    public $id_categoria;
    public $id_club;

    public function __construct(
        $id = null,
        $nombre = null,
        $apellidos = null,
        $ciudad = null,
        $sexo = null,
        $email = null,
        $fechaNacimiento = null,
        $dni = null,
        $id_categoria = [],
        $id_club = [],
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->ciudad = $ciudad;
        $this->sexo = $sexo;
        $this->email = $email;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->dni = $dni;
        $this->id_categoria = $id_categoria;
        $this->id_club = $id_club;
    }
    public function edad()
    {
        $fechaActual = new DateTime(); // Fecha actual
        $fechaNacimiento = new DateTime($this->fechaNacimiento); // Fecha de nacimiento
        $edad = $fechaNacimiento->diff($fechaActual); // Diferencia entre las fechas
        return $edad->y; // Devuelve solo los años

    }
}

