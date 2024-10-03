<?php
//  Valor constante de la gravedad
define("G", 9.8);

$vInicial = $_POST["valor1"];
$aGrados = $_POST["valor2"]; //  Convierte de grados a radianes


//  Fórmulas para los cálculos

//  Ángulo en Radianes (A0)
$rad = deg2rad($_POST["valor2"]);

//Velocidad Inicial Horizontal (Vox) m/s
$V0x = $vInicial * cos($rad);

//  Velocidad Inicial Vertical (Voy) m/s
$V0y = $vInicial * sin($rad);

//  El alcance máximo (Xmax) metros
$xMax = (pow($vInicial, 2) * sin($rad * 2)) / (G);

//  Altura máxima alcanzada por el proyectil (Ymax) metros
$yMax = (pow($vInicial, 2) * pow(sin($rad), 2)) / ((G) * 2);

//  Tiempo total en vuelo  (t) segundos
$t = ($V0y * 2) / (G);


//  FORMATO

$vInicial = number_format($vInicial, 2, ",", ".");
$aGrados = number_format($aGrados, 0, ",", ".");
$V0x = number_format($V0x, 2, ",", ".");
$V0y = number_format($V0y, 2, ",", ".");
$rad = number_format($rad, 5, ",", ".");
$xMax = number_format($xMax, 2, ",", ".");
$t = number_format($t, 2, ",", ".");
$yMax = number_format($yMax, 2, ",", ".");

?>