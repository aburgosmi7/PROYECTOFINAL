<?php require __DIR__ . "/../layouts/header.php"; ?>
<h1>Bienvenido, <?= strtoupper(htmlspecialchars($nombre)); ?></h1>
<p>Elige tus productos favoritos 🍫</p>
<?php
if (!empty($_SESSION["mensaje"])) {
    echo "<p style='background:#d4edda; padding:10px; border-left:5px solid #28a745;'>
            " . $_SESSION["mensaje"] . "
          </p>";
    unset($_SESSION["mensaje"]);
}
?>
<style>
.producto-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
}
.card {
    background:#fff;
    width:240px;
    padding:15px;
    border-radius:10px;
    box-shadow:0 0 8px rgba(0,0,0,0.2);
    text-align:center;
}
.btn-pagar {
    background:#007bff;
    color:white;
    padding:10px 20px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    margin-top:15px;
}
.btn-pagar:hover { background:#0056b3; }
</style>
<div class="productos" style="display:flex; flex-wrap:wrap; gap:20px;">
<?php foreach ($productos as $p): ?>
    <?php
        $img = trim($p['imagen']);
        $carpeta = "/PROYECTO_FINAL/public/imagenes/";
        $rutaFisica = $_SERVER["DOCUMENT_ROOT"] . $carpeta . $img;
        if ($img === "" || !file_exists($rutaFisica)) {
            $img = "default.png";
        }
        $rutaFinal = $carpeta . $img;
    ?>
    <div class="card">
        <img src="<?= $rutaFinal ?>" class="producto-img">
        <h3><?= htmlspecialchars($p['nombre']); ?></h3>
        <p><?= htmlspecialchars($p['descripcion']); ?></p>
        <strong>S/ <?= number_format($p['precio'], 2); ?></strong>
        <p style="margin:5px 0; font-weight:bold; color:#333;">
            Stock disponible: <?= $p['stock']; ?>
        </p>
        <?php if ($p['stock'] > 0): ?>
            <form method="POST" action="/PROYECTO_FINAL/public/index.php?controller=Carrito&action=agregar">
                <input type="hidden" name="id_producto" value="<?= $p['id_producto']; ?>">
                <label>Cantidad:</label>
                <input type="number" 
                       name="cantidad" 
                       min="1" 
                       max="<?= $p['stock']; ?>" 
                       value="1" 
                       style="width:70px;">
                <button type="submit"
                    style="background:#28a745; color:white; padding:10px; width:100%; border:none; border-radius:5px;">
                    Comprar
                </button>
            </form>
        <?php else: ?>
            <button disabled
                style="background:#777; width:100%; padding:10px; color:white; border:none; border-radius:5px;">
                AGOTADO
            </button>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
</div>
<br><br>
<?php if (!empty($_SESSION['carrito'])): ?>
<div style="background:white; padding:20px; border-radius:10px; box-shadow:0 0 8px rgba(0,0,0,0.2); max-width:700px;">
    <h2>Carrito de Compras</h2>
    <table width="100%" border="1" style="border-collapse:collapse;">
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach ($_SESSION['carrito'] as $id => $item): ?>
            <?php $total += $item['subtotal']; ?>
            <tr>
                <td><?= htmlspecialchars($item['nombre']); ?></td>
                <td><?= $item['cantidad']; ?></td>
                <td>S/ <?= number_format($item['precio'],2); ?></td>
                <td>S/ <?= number_format($item['subtotal'],2); ?></td>
                <td>
                    <form method="POST" action="/PROYECTO_FINAL/public/index.php?controller=Carrito&action=eliminar">
                        <input type="hidden" name="id_eliminar" value="<?= $id; ?>">
                        <button style="background:red; color:white; padding:5px 10px; border:none; border-radius:5px;">
                            X
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h2>Total: S/ <?= number_format($total, 2); ?></h2>
    <form method="POST" action="/PROYECTO_FINAL/public/index.php?controller=Carrito&action=pagar">
        <button class="btn-pagar">Pagar 🧾</button>
    </form>
</div>
<?php else: ?>
<p style="font-size:18px; font-weight:bold; color:#444;">El carrito está vacío.</p>
<?php endif; ?>
<p><a href="/PROYECTO_FINAL/public/index.php?controller=Login&action=logout" style="color:red;">Cerrar sesión</a></p>
<?php require __DIR__ . "/../layouts/footer.php"; ?>
