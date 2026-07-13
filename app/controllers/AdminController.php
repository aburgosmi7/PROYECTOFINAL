<?php
class AdminController {
    public function panel() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
            header("Location: /PROYECTO_FINAL/public/index.php?controller=Login&action=index");
            exit;
        }
        $nombre = $_SESSION['nombre'] ?? "Administrador";
        require __DIR__ . "/../views/admin/panel_admin.php";
    }

    public function usuarios() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
            header("Location: /PROYECTO_FINAL/public/index.php?controller=Login&action=index");
            exit;
        }
        require_once __DIR__ . "/../models/Usuario.php";
        $user = new Usuario();
        $lista = $user->listarClientes();
        require __DIR__ . "/../views/admin/usuarios.php";
    }
    public function editarCliente() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
            header("Location: /PROYECTO_FINAL/public/index.php?controller=Login&action=index");
            exit;
        }
        require_once __DIR__ . "/../models/Usuario.php";
        $user = new Usuario();
        $id = $_GET["id"];
        $cliente = $user->obtenerPorId($id);
        require __DIR__ . "/../views/admin/editar_cliente.php";
    }
    public function actualizarCliente() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once __DIR__ . "/../models/Usuario.php";
        $user = new Usuario();
        $id = $_POST["id_usuario"];
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $user->actualizarCliente($id, $nombre, $correo);
        header("Location: /PROYECTO_FINAL/public/index.php?controller=Admin&action=usuarios");
    }
    public function eliminarCliente() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once __DIR__ . "/../models/Usuario.php";
        $user = new Usuario();
        $id = $_GET["id"];
        $user->eliminar($id);
        header("Location: /PROYECTO_FINAL/public/index.php?controller=Admin&action=usuarios");
    }
}
