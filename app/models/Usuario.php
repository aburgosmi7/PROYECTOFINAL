<?php
require_once __DIR__ . "/../../config/database.php";
class Usuario {
    private $pdo;
    public function __construct() {
        $db = new Database();
        $this->pdo = $db->connect();
    }
    public function buscarPorCorreo($correo) {
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function registrar($nombre, $correo, $password, $rol) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nombre, correo, contrasena, rol) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $correo, $hash, $rol]);
    }
    public function listarClientes() {
        $sql = "SELECT id_usuario, nombre, correo, rol, creado_en 
                FROM usuarios 
                WHERE rol = 'cliente'";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function actualizarCliente($id, $nombre, $correo) {
        $sql = "UPDATE usuarios SET nombre = ?, correo = ? WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $correo, $id]);
    }
    public function eliminar($id) {
        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
