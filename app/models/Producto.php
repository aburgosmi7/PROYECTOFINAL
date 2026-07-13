<?php
require_once __DIR__ . "/../../config/database.php";
class Producto {
    private $pdo;
    public function __construct() {
        $db = new Database();
        $this->pdo = $db->connect();
    }
    public function listar() {
        $sql = "SELECT * FROM productos ORDER BY id_producto ASC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtener($id) {
        $sql = "SELECT * FROM productos WHERE id_producto = ?";
        $s = $this->pdo->prepare($sql);
        $s->execute([$id]);
        return $s->fetch(PDO::FETCH_ASSOC);
    }
    public function agregar($cat, $nom, $desc, $precio, $stock, $imagen) {
        if ($imagen === "" || $imagen === null) {
            $imagen = null;
        }
        $sql = "INSERT INTO productos (id_categoria, nombre, descripcion, precio, stock, imagen)
                VALUES (?, ?, ?, ?, ?, ?)";
        $s = $this->pdo->prepare($sql);
        return $s->execute([$cat, $nom, $desc, $precio, $stock, $imagen]);
    }
    public function actualizar($id, $cat, $nom, $desc, $precio, $stock, $imagen = null) {
        if ($imagen === null || $imagen === "") {
            $sql = "SELECT imagen FROM productos WHERE id_producto = ?";
            $query = $this->pdo->prepare($sql);
            $query->execute([$id]);
            $current = $query->fetch(PDO::FETCH_ASSOC);
            $imagen = $current["imagen"]; 
        }
        $sql = "UPDATE productos 
                SET id_categoria=?, nombre=?, descripcion=?, precio=?, stock=?, imagen=?
                WHERE id_producto=?";

        $params = [$cat, $nom, $desc, $precio, $stock, $imagen, $id];
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
    public function eliminar($id) {
        $sql = "SELECT imagen FROM productos WHERE id_producto=?";
        $s = $this->pdo->prepare($sql);
        $s->execute([$id]);
        $img = $s->fetchColumn();
        if ($img && file_exists(__DIR__ . "/../../../public/imagenes/" . $img)) {
            unlink(__DIR__ . "/../../../public/imagenes/" . $img);
        }
        $sql = "DELETE FROM productos WHERE id_producto=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
