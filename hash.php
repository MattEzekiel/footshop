<?php

$nombre = "hola1234";

$hash = password_hash($nombre,PASSWORD_DEFAULT);

echo '<pre>';
var_dump($nombre);
echo '</pre>';

echo '<pre>';
var_dump($hash);
echo '</pre>';