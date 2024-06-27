<?php
   require_once __DIR__ . '/../config.php';
// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Autocarga de clases
spl_autoload_register(function ($class_name) {
    include '../core/' . $class_name . '.php';
});

// Depuración
//echo 'Entrando en index.php </br>';

$url = isset($_GET['url']) ? $_GET['url'] : '';
new Router();