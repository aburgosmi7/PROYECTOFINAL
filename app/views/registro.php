<?php require __DIR__ . "/layouts/header.php"; ?>

<div style="width:380px; margin:70px auto; background:white; padding:20px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,.1);">

    <h2 style="text-align:center; color:#442a1b;">Crear cuenta</h2>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="/PROYECTO_FINAL/public/index.php?controller=Registro&action=registrar">

        <input type="text" name="nombres" placeholder="Nombres completos" required
               style="width:100%; padding:10px; margin:6px 0; border-radius:5px;">

        <input type="email" name="correo" placeholder="Correo electrónico" required
               style="width:100%; padding:10px; margin:6px 0; border-radius:5px;">

        <input type="password" name="contrasena" placeholder="Contraseña" required
               style="width:100%; padding:10px; margin:6px 0; border-radius:5px;">

        <label style="font-weight:bold; margin-top:10px;">Selecciona tu rol:</label>
        <select name="rol" required
                style="width:100%; padding:10px; margin-top:6px; margin-bottom:12px; border-radius:5px;">
            <option value="cliente">Cliente</option>
            <option value="administrador">Administrador</option>
        </select>

        <button type="submit"
                style="background:#8B4513; width:100%; padding:10px; border:none; color:#fff; border-radius:5px; cursor:pointer;">
            Registrar
        </button>
    </form>

    <p style="text-align:center; margin-top:10px;">
        ¿Ya tienes cuenta?
        <a href="/PROYECTO_FINAL/public/index.php?controller=Login&action=index" style="color:#8B4513;">Inicia sesión</a>
    </p>
</div>

<?php require __DIR__ . "/layouts/footer.php"; ?>
