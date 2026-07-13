<?php
require_once __DIR__ . "/../models/Usuario.php";
class LoginController {
    public function index() {
        require __DIR__ . "/../views/login.php";
    }
    public function validar() {
        session_start();
        $user = new Usuario();
        $correo = $_POST['correo'];
        $pass   = $_POST['contrasena'];
        $datos = $user->buscarPorCorreo($correo);
        if ($datos && password_verify($pass, $datos['contrasena'])) {
            $_SESSION['id']      = $datos['id_cliente'];
            $_SESSION['nombre']  = $datos['nombres'];
            $_SESSION['rol']     = $datos['rol'];
            if ($datos['rol'] === "administrador") {
                header("Location: /PROYECTO_FINAL/public/index.php?controller=Admin&action=panel");
            } else {
                header("Location: /PROYECTO_FINAL/public/index.php?controller=Cliente&action=tienda");
            }
            exit;
        }
        $error = "Correo o contraseña incorrectos.";
        require __DIR__ . "/../views/login.php";
    }
    public function logout(){
        session_start();
        session_destroy();
        header("Location: /PROYECTO_FINAL/public/index.php?controller=Login&action=index");
        exit;
    }
}
