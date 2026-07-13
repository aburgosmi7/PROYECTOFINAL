<?php
require_once __DIR__ . "/../models/Producto.php";

class ClienteController {

    public function tienda() {
        session_start();

        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'cliente') {
            header("Location: /PROYECTO_FINAL/public/index.php?controller=Login&action=index");
            exit;
        }

        $nombre = $_SESSION['nombre'];

        $model = new Producto();
        $productos = $model->listar();

        require __DIR__ . "/../views/cliente/tienda.php";
    }
}
