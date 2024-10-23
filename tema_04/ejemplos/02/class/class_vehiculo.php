<?php
/*
Clase: class.vehiculo.php
Descripción: definición de la clase vehiculo
autor:
fecha:
*/

class Vehiculo
{
    public $matricula;
    public $velocidad;

    // Constructor que inicializa las propiedades
    public function __construct($matricula = null, $velocidad = 0)
    {
        $this->matricula = $matricula;
        $this->velocidad = $velocidad;
    }

    // Métodos getters
    public function getMatricula(): ?string
    {
        return $this->matricula;
    }

    public function getVelocidad(): int
    {
        return $this->velocidad;
    }

    // Métodos setters
    public function setMatricula($matricula): void
    {
        $this->matricula = $matricula;
    }

    public function setVelocidad($velocidad): void
    {
        $this->velocidad = $velocidad;
    }

    // Método que aumenta la velocidad
    public function aumentarVelocidad($incremento): void
    {
        $this->velocidad += $incremento;
    }

    // Método que disminuye la velocidad
    public function disminuirVelocidad($decremento): void
    {
        $this->velocidad -= $decremento;
        // Asegurarse de que la velocidad no sea negativa
        if ($this->velocidad < 0) {
            $this->velocidad = 0;
        }
    }

    // Método para detener el vehículo
    public function parar(): void
    {
        $this->velocidad = 0;
    }
}

?>