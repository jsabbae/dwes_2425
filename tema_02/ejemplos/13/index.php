<?php

/**
 * Conversiones de tipo
 */

$var = 3;

var_dump(value: $var);

//  Conversiones mediante fuciones
//  strval
$var1 = strval(value: $var);
echo "<BR>";
var_dump(value: $var1);

//  intval
$var2 = intval(value: $var1);
echo "<BR>";
var_dump(value: $var2);

//  floatval
$var3 = floatval(value: $var);
echo "<BR>";
var_dump(value: $var3);

//  Conversión (tipo de dato) variable
$var4 = 7.89;
$var5 = (float) $var5;
echo "<BR>";
var_dump(value: $var4);

$var6 = 89;
$var6 = (string) $var6;
echo "<BR>";
var_dump(value: $var7);

$var7 = 100;
$var7= (array) $var7;
echo "<BR>";
var_dump(value: $var8);

//CONVERSIÓN MEDIANTE settype
/*
$var8 = 45;
settype($var8)
*/
