<?php
/*
Descripción: crear objetos a partir de la clase  class.calculadora
*/

// Cargamos la clase
include 'class/class.calculadora.php';

// Creamos un objeto por cada operacion
$operacionSuma = new Calculadora();
$operacionResta = new Calculadora();
$operacionDividir = new Calculadora();
$operacionMultiplicar = new Calculadora();
$operacionPotencia = new Calculadora();

// Asignamos valores a la operacion suma
$operacionSuma->setValor1(1);
$operacionSuma->setValor2(2);
// Función suma
$resultadoSuma = $operacionSuma->sumar();

// Asignamos valores a la operacion resta
$operacionResta->setValor1(15);
$operacionResta->setValor2(10);
// Función resta
$resultadoResta = $operacionResta->restar();

// Asignamos valores a la operacion dividir
$operacionDividir->setValor1(12);
$operacionDividir->setValor2(2);
// Función dividir
$resultadoDividir = $operacionDividir->dividir();

// Asignamos valores a la operacion multiplicar
$operacionMultiplicar->setValor1(5);
$operacionMultiplicar->setValor2(6);
// Función multiplicar
$resultadoMultiplicar = $operacionMultiplicar->multiplicar();

// Asignamos valores a la operacion potencia
$operacionPotencia->setValor1(3);
$operacionPotencia->setValor2(6);
// Función potencia
$resultadoPotencia = $operacionPotencia->potencia();

// SOLUCIÓN
echo $operacionSuma->getOperacion() . ": " . $operacionSuma->getValor1() . " + " . $operacionSuma->getValor2() . " = " . $resultadoSuma;
echo "<br>";
echo $operacionResta->getOperacion() . ": " . $operacionResta->getValor1() . " - " . $operacionResta->getValor2() . " = " . $resultadoResta;
echo "<br>";
echo $operacionDividir->getOperacion() . ": " . $operacionDividir->getValor1() . " / " . $operacionDividir->getValor2() . " = " . $resultadoDividir;
echo "<br>";
echo $operacionMultiplicar->getOperacion() . ": " . $operacionMultiplicar->getValor1() . " x " . $operacionMultiplicar->getValor2() . " = " . $resultadoMultiplicar;
echo "<br>";
echo $operacionPotencia->getOperacion() . ": " . $operacionPotencia->getValor1() . "^" . $operacionPotencia->getValor2() . " = " . $resultadoPotencia;
?>