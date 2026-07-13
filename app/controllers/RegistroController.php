<?php
require_once __DIR__ . "/../models/Usuario.php";

class RegistroController {

    public function index() {
        require __DIR__ . "/../views/registro.php";
    }

    public function registrar() {

        $user = new Usuario();

        $nombre = $_POST["nombres"];
        $correo = $_POST["correo"];
        $pass   = $_POST["contrasena"];
        $rol    = $_POST["rol"];

        if ($user->buscarPorCorreo($correo)) {
            $error = "El correo ya está registrado.";
            require __DIR__ . "/../views/registro.php";
            return;
        }

        if ($user->registrar($nombre, $correo, $pass, $rol)) {
            header("Location: /PROYECTO_FINAL/public/index.php?controller=Login&action=index");
            exit;
        } else {
            $error = "Error al registrar el usuario.";
            require __DIR__ . "/../views/registro.php";
        }
    }
}
