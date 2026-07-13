<?php require __DIR__ . "/layouts/header.php"; ?>

<div style="width:350px; margin:80px auto; background:#fff; padding:25px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,.1);">

    <center>
        <img src="/PROYECTO_FINAL/public/img/LOGO.jpg" alt="Logo" style="max-width:200px; margin-bottom:10px;">
    </center>

    <h2 style="text-align:center; color:#442a1b">Iniciar Sesión</h2>

    <?php if (!empty($error)): ?>
        <p style="color:red; text-align:center;"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="/PROYECTO_FINAL/public/index.php?controller=Login&action=validar">
        
        <input type="email" name="correo" placeholder="Correo electrónico" required
               style="width:100%; padding:10px; margin:8px 0; border-radius:5px;">

        <input type="password" name="contrasena" placeholder="Contraseña" required
               style="width:100%; padding:10px; margin:8px 0; border-radius:5px;">

        <button type="submit" style="background:#8B4513; width:100%; padding:10px; border:none; color:#fff; border-radius:5px; cursor:pointer;">
            Ingresar
        </button>
    </form>

    <div style="text-align:center; margin-top:10px;">
        ¿No tienes cuenta?
        <a href="/PROYECTO_FINAL/public/index.php?controller=Registro&action=index" style="color:#8B4513;">Regístrate</a>
    </div>
</div>

<?php require __DIR__ . "/layouts/footer.php"; ?>
