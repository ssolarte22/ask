<section class="content-card">
    <h1>Acceso Docente</h1>
    <p class="lead">Ingresa con tus credenciales para acceder al sistema de aprendizaje.</p>

    <?php if (!empty($mensajeError)): ?>
        <div class="alert alert-error" role="alert" aria-live="polite">
            <?= App\Utils\Sanitizer::escape($mensajeError) ?>
        </div>
    <?php endif; ?>

    <form method="post" class="form-card" novalidate>
        <h2 id="login-heading">Inicio de sesión</h2>

        <div class="form-group">
            <label for="login">Usuario</label>
            <input type="text" id="login" name="login" required autocomplete="username"
                   aria-describedby="login-hint<?= isset($errors['login']) ? ' login-error' : '' ?>"
                   value="<?= App\Utils\Sanitizer::escape($_POST['login'] ?? '') ?>">
            <span id="login-hint" class="form-hint">Mínimo 3 caracteres</span>
            <?php if (!empty($errors['login'])): ?>
                <span id="login-error" class="field-error" role="alert"><?= App\Utils\Sanitizer::escape($errors['login']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="clave">Contraseña</label>
            <input type="password" id="clave" name="clave" required autocomplete="current-password"
                   aria-describedby="<?= isset($errors['clave']) ? 'clave-error' : '' ?>">
            <?php if (!empty($errors['clave'])): ?>
                <span id="clave-error" class="field-error" role="alert"><?= App\Utils\Sanitizer::escape($errors['clave']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" name="enviar" value="1">Ingresar</button>
            <button type="reset" class="btn-secondary">Limpiar</button>
        </div>
    </form>

    <p class="text-center mt-lg">
        ¿Eres administrador? <a href="administrador/login.php">Accede aquí</a>
    </p>
</section>
