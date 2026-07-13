<?php
require_once __DIR__ . "/../models/Producto.php";
class ProductoController {
    public function index() {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
            header("Location: /PROYECTO_FINAL/public/index.php?controller=Login&action=index");
            exit;
        }
        $modelo = new Producto();
        $lista = $modelo->listar();
        require __DIR__ . "/../views/admin/productos.php";
    }
    public function guardar() {
        session_start();
        if ($_SESSION['rol'] !== 'administrador') exit;
        $modelo = new Producto();
        $id     = $_POST['id_producto'] ?? null;
        $cat    = $_POST['id_categoria'];
        $nom    = $_POST['nombre'];
        $desc   = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock  = $_POST['stock'];
        $imagen = null;
        if (!empty($_FILES["imagen"]["name"])) {
            $newName = time() . "_" . basename($_FILES["imagen"]["name"]);
            $destino = __DIR__ . "/../../public/imagenes/" . $newName;
            move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);
            $imagen = $newName;
        }
        if ($id && empty($_FILES["imagen"]["name"])) {
            $imagen = $_POST["imagen_actual"] ?? null;
        }
        if ($id) {
            $modelo->actualizar($id, $cat, $nom, $desc, $precio, $stock, $imagen);
        } else {
            $modelo->agregar($cat, $nom, $desc, $precio, $stock, $imagen);
        }
        header("Location: /PROYECTO_FINAL/public/index.php?controller=Producto&action=index");
    }
    public function editar() {
        session_start();
        $modelo = new Producto();
        $id = $_GET["id"];
        $prod  = $modelo->obtener($id);
        $lista = $modelo->listar();
        require __DIR__ . "/../views/admin/productos.php";
    }
    public function eliminar() {
        session_start();
        $modelo = new Producto();
        $modelo->eliminar($_GET["id"]);
        header("Location: /PROYECTO_FINAL/public/index.php?controller=Producto&action=index");
    }
}
