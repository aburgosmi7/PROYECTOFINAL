<?php 

require __DIR__ . "/../layouts/header.php"; 

$nombre = $_SESSION['nombre'] ?? "Administrador";
?>

<div style="max-width:600px; margin:0 auto; padding:20px;">
    <h2 style="text-align:center;">Panel de Administración</h2>

    <p style="text-align:center;">
        Bienvenido, <strong><?= htmlspecialchars($nombre); ?></strong> 👋
    </p>

    <div style="margin-top:20px;">
        <a href="/PROYECTO_FINAL/public/index.php?controller=Producto&action=index"
           style="display:block; padding:15px; background:#3498db; color:white;
                  text-decoration:none; border-radius:8px; margin-bottom:12px;
                  text-align:center; font-size:17px;">
           🛒 Gestionar Productos
        </a>

        <a href="/PROYECTO_FINAL/public/index.php?controller=Admin&action=usuarios"
           style="display:block; padding:15px; background:#8e44ad; color:white;
                  text-decoration:none; border-radius:8px; margin-bottom:12px;
                  text-align:center; font-size:17px;">
           👥 Gestionar Usuarios (opcional)
        </a>

        <a href="/PROYECTO_FINAL/public/index.php?controller=Login&action=logout"
           style="display:block; padding:15px; background:#e74c3c; color:white;
                  text-decoration:none; border-radius:8px; text-align:center;
                  font-size:17px;">
           ❌ Cerrar sesión
        </a>
    </div>
</div>

<?php require __DIR__ . "/../layouts/footer.php"; ?>
