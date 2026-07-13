<?php
require_once __DIR__ . "/../models/Producto.php";
class CarritoController {
    public function agregar() {
        session_start();
        $id = intval($_POST["id_producto"]);
        $cantidad = intval($_POST["cantidad"]);
        if ($cantidad < 1) $cantidad = 1;
        $prodModel = new Producto();
        $prod = $prodModel->obtener($id);
        if (!isset($_SESSION["carrito"])) {
            $_SESSION["carrito"] = [];
        }
        if (isset($_SESSION["carrito"][$id])) {
            $_SESSION["carrito"][$id]["cantidad"] += $cantidad;
        } else {
            $_SESSION["carrito"][$id] = [
                "nombre" => $prod["nombre"],
                "precio" => $prod["precio"],
                "cantidad" => $cantidad
            ];
        }
        $_SESSION["carrito"][$id]["subtotal"] =
            $_SESSION["carrito"][$id]["cantidad"] * $prod["precio"];

        header("Location: /PROYECTO_FINAL/public/index.php?controller=Cliente&action=tienda");
    }
    public function eliminar() {
        session_start();
        $id = intval($_POST["id_eliminar"]);
        unset($_SESSION["carrito"][$id]);
        header("Location: /PROYECTO_FINAL/public/index.php?controller=Cliente&action=tienda");
    }
    public function pagar() {
        session_start();
        require_once __DIR__ . "/../models/Producto.php";
        if (!isset($_SESSION["carrito"]) || empty($_SESSION["carrito"])) {
            header("Location: /PROYECTO_FINAL/public/index.php?controller=Cliente&action=tienda");
            exit;
        }
        $prodModel = new Producto();
        foreach ($_SESSION["carrito"] as $id => $item) {
            $producto = $prodModel->obtener($id);
            $nuevoStock = $producto["stock"] - $item["cantidad"];
            if ($nuevoStock < 0) $nuevoStock = 0;
            $prodModel->actualizarStock($id, $nuevoStock);
        }
        unset($_SESSION["carrito"]);
        $_SESSION["mensaje"] = "Compra realizada con éxito 🎉";
        header("Location: /PROYECTO_FINAL/public/index.php?controller=Cliente&action=tienda");
    }
}
