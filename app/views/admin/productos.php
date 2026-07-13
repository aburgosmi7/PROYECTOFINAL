<?php
require __DIR__ . "/../layouts/header.php";



if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: /PROYECTO_FINAL/public/index.php?controller=Login&action=index");
    exit;
}


$prod = $prod ?? null;
?>

<style>
    .panel {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,.1);
        margin-bottom: 20px;
    }

    table th, table td {
        text-align: center;
    }

    .btn {
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        color: white;
        font-weight: bold;
    }

    .btn-edit { background: #3498db; }
    .btn-delete { background: #e74c3c; }
    .btn-save { background: #27ae60; padding: 10px 18px; }
    .btn-back { background: #8e44ad; }
</style>

<div class="panel">
    <h2>Gestión de Productos</h2>

    <a href="/PROYECTO_FINAL/public/index.php?controller=Admin&action=panel" class="btn btn-back">
        ← Volver al panel
    </a>

    <h3 style="margin-top:20px;">
        <?= $prod ? "Editar producto" : "Registrar nuevo producto" ?>
    </h3>

    <form action="/PROYECTO_FINAL/public/index.php?controller=Producto&action=guardar"
          method="POST" enctype="multipart/form-data" style="margin-top:20px;">

        <input type="hidden" name="id_producto" value="<?= htmlspecialchars($prod['id_producto'] ?? '') ?>">
        <input type="hidden" name="imagen_actual" value="<?= htmlspecialchars($prod['imagen'] ?? '') ?>">

        <label>Categoría:</label>
        <input type="number" name="id_categoria" required
               value="<?= htmlspecialchars($prod['id_categoria'] ?? '') ?>">

        <label>Nombre:</label>
        <input type="text" name="nombre" required
               value="<?= htmlspecialchars($prod['nombre'] ?? '') ?>">

        <label>Descripción:</label>
        <textarea name="descripcion"><?= htmlspecialchars($prod['descripcion'] ?? '') ?></textarea>

        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" required
               value="<?= htmlspecialchars($prod['precio'] ?? '') ?>">

        <label>Stock:</label>
        <input type="number" name="stock" required
               value="<?= htmlspecialchars($prod['stock'] ?? '') ?>">

        <label>Imagen:</label>
        <?php if (!empty($prod['imagen'])): ?>
            <img src="/PROYECTO_FINAL/public/imagenes/<?= htmlspecialchars($prod['imagen']); ?>"
                 width="90" style="border:1px solid #ccc; border-radius:6px; display:block; margin:10px 0;">
        <?php endif; ?>

        <input type="file" name="imagen" accept="image/*">

        <button type="submit" class="btn btn-save" style="margin-top:15px;">
            Guardar
        </button>

    </form>
</div>

<div class="panel">
    <h3>Listado de Productos</h3>

    <table width="100%" border="1" cellpadding="8" style="border-collapse:collapse; margin-top:10px;">
        <tr>
            <th>ID</th>
            <th>Categoría</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($lista as $p): ?>
        <tr>
            <td><?= $p['id_producto'] ?></td>
            <td><?= $p['id_categoria'] ?></td>
            <td><?= htmlspecialchars($p['nombre']) ?></td>
            <td>S/ <?= number_format($p['precio'], 2) ?></td>
            <td><?= $p['stock'] ?></td>
            <td>
                <?php if ($p['imagen']): ?>
                    <img src="/PROYECTO_FINAL/public/imagenes/<?= htmlspecialchars($p['imagen']); ?>"
                         width="70" style="border-radius:6px;">
                <?php else: ?>
                    <small>Sin imagen</small>
                <?php endif; ?>
            </td>
            <td>
                <a class="btn btn-edit"
                   href="/PROYECTO_FINAL/public/index.php?controller=Producto&action=editar&id=<?= $p['id_producto'] ?>">
                    Editar
                </a>

                <a class="btn btn-delete"
                   href="/PROYECTO_FINAL/public/index.php?controller=Producto&action=eliminar&id=<?= $p['id_producto'] ?>"
                   onclick="return confirm('¿Eliminar este producto?')">
                    Eliminar
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require __DIR__ . "/../layouts/footer.php"; ?>
