<?php require __DIR__ . "/../layouts/header.php"; ?>

<h2>Editar Cliente</h2>

<form method="POST" action="/PROYECTO_FINAL/public/index.php?controller=Admin&action=actualizarCliente">

    <input type="hidden" name="id_usuario" value="<?= $cliente['id_usuario'] ?>">

    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($cliente['nombre']) ?>" required>

    <label>Correo:</label>
    <input type="email" name="correo" value="<?= htmlspecialchars($cliente['correo']) ?>" required>

    <button type="submit">Guardar cambios</button>
</form>

<?php require __DIR__ . "/../layouts/footer.php"; ?>
