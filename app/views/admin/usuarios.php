<?php require __DIR__ . "/../layouts/header.php"; ?>

<h2>Gestión de Usuarios</h2>


<a href="/PROYECTO_FINAL/public/index.php?controller=Admin&action=panel"
   style="display:inline-block; margin-bottom:15px; padding:8px 15px; background:#6c757d; color:white; 
          text-decoration:none; border-radius:5px;">
    ← Regresar al panel
</a>

<table border="1" width="100%" cellpadding="10" style="border-collapse:collapse;">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>

    <?php if (!empty($lista)): ?>
        <?php foreach ($lista as $u): ?>
            <tr>
                <td><?= $u['id_usuario'] ?></td>
                <td><?= htmlspecialchars($u['nombre']) ?></td>
                <td><?= htmlspecialchars($u['correo']) ?></td>
                <td><?= htmlspecialchars($u['rol']) ?></td>

                <td>
                    <a href="/PROYECTO_FINAL/public/index.php?controller=Admin&action=editarCliente&id=<?= $u['id_usuario'] ?>"
                       style="color:blue;">Editar</a>

                    |

                    <a href="/PROYECTO_FINAL/public/index.php?controller=Admin&action=eliminarCliente&id=<?= $u['id_usuario'] ?>"
                       onclick="return confirm('¿Eliminar este cliente?')"
                       style="color:red;">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="5">No hay clientes registrados.</td></tr>
    <?php endif; ?>
</table>

<?php require __DIR__ . "/../layouts/footer.php"; ?>
