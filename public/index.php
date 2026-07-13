<?php

// Controlador y acción por defecto
$controller = $_GET["controller"] ?? "Login";
$action     = $_GET["action"] ?? "index";
// Normalizamos el nombre del controlador
$controller = ucfirst(strtolower($controller));
$action     = strtolower($action);

// Ubicación del archivo del controlador
$file = __DIR__ . "/../app/controllers/{$controller}Controller.php";

// Validar si existe el archivo
if (!file_exists($file)) {
    die("ERROR: El controlador '{$controller}' no existe.");
}
require_once $file;

// Validar si la clase del controlador existe
$class = $controller . "Controller";

if (!class_exists($class)) {
    die("ERROR: La clase '{$class}' no existe dentro del controlador.");
}
$instance = new $class();

// Validar si la acción existe
if (!method_exists($instance, $action)) {
    die("ERROR: La acción '{$action}' no existe en el controlador '{$class}'.");
}
// Ejecutar acción
$instance->$action();
