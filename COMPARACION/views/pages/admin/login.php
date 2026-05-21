<section class="content-card form-narrow">
    <h1>Acceso Administrador</h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert-error" role="alert">Usuario o contraseña incorrectos.</div>
    <?php endif; ?>

    <form action="verificar_admin.php" method="post" class="form-card">
        <div class="form-group">
            <label for="admin-login">Usuario</label>
            <input type="text" id="admin-login" name="login" required autocomplete="username">
        </div>
        <div class="form-group">
            <label for="admin-clave">Contraseña</label>
            <input type="password" id="admin-clave" name="clave" required autocomplete="current-password">
        </div>
        <div class="form-actions">
            <button type="submit" name="enviar" value="1">Ingresar</button>
            <button type="reset" class="btn-secondary">Limpiar</button>
        </div>
    </form>
    <p class="mt-lg"><a href="../home.php">Volver al inicio</a></p>
</section>
