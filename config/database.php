<?php

class Database {
    private $host = "localhost";
    private $db   = "rellenoschoco_db";
    private $user = "root";
    private $pass = "";
    private $pdo;

    public function connect() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4",
                $this->user,
                $this->pass
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->pdo;

        } catch (PDOException $e) {
            die("Error de conexión: ".$e->getMessage());
        }
    }
}
