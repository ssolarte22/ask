<?php
session_start();
require_once __DIR__ . '/../inc/database.php';

if (!isset($_SESSION['autenticado'])) {
    header('Location: home.php');
    exit();
}

$usuarioId = (int) ($_SESSION['usuario_id'] ?? 0);
$mensaje = '';
$error = '';

if ($usuarioId <= 0) {
    $error = 'No se pudo identificar al docente en sesión.';
}

if (isset($_POST['crear_curso']) && $usuarioId > 0) {
    $nombreCurso = trim((string) ($_POST['nombre_curso'] ?? ''));
    $descripcionCurso = trim((string) ($_POST['descripcion_curso'] ?? ''));

    if ($nombreCurso === '') {
        $error = 'Escribe un nombre para el curso.';
    } else {
        ask_create_docente_course($usuarioId, $nombreCurso, $descripcionCurso);
        $mensaje = 'Curso creado correctamente.';
    }
}

if (isset($_POST['crear_tema']) && $usuarioId > 0) {
    $cursoTemaId = (int) ($_POST['curso_tema_id'] ?? 0);
    $nombreTema = trim((string) ($_POST['nombre_tema'] ?? ''));
    $descripcionTema = trim((string) ($_POST['descripcion_tema'] ?? ''));
    $ordenTema = (int) ($_POST['orden_tema'] ?? 1);

    if ($cursoTemaId <= 0) {
        $error = 'Selecciona un curso para el tema.';
    } elseif ($nombreTema === '') {
        $error = 'Escribe un nombre para el tema.';
    } else {
        $cursoSeleccionado = ask_find_docente_course_by_id($cursoTemaId, $usuarioId);
        if ($cursoSeleccionado === null) {
            $error = 'El curso seleccionado no pertenece a tu cuenta.';
        } else {
            ask_create_docente_topic($usuarioId, $cursoTemaId, $nombreTema, $descripcionTema, max(1, $ordenTema));
            $mensaje = 'Tema agregado correctamente.';
        }
    }
}

$cursos = $usuarioId > 0 ? ask_list_docente_courses($usuarioId) : [];
$temas = $usuarioId > 0 ? ask_list_docente_topics($usuarioId) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos del Docente - Tutor IA</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .panel-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        .card-box { background: #fff; border: 2px solid #002244; padding: 20px; box-shadow: 8px 8px 0 #D4AF37; }
        .course-item { border: 2px solid #121212; padding: 14px; margin-bottom: 12px; background: #fcfdff; }
        .muted { color: #555; font-size: 0.95rem; }
        .msg-ok { background: #dcfce7; color: #166534; border: 1px solid #166534; padding: 10px; margin-bottom: 15px; }
        .msg-error { background: #fee2e2; color: #991b1b; border: 1px solid #991b1b; padding: 10px; margin-bottom: 15px; }
        @media (max-width: 900px) { .panel-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<?php
$tituloPlataforma = 'Plataforma Docente - Cursos';
$subtituloPlataforma = 'Gestiona los cursos del profesor';
$badgePlataforma = 'Bienvenido Profesor: ' . ($_SESSION['docente'] ?? '');
include 'top_docente.php';
?>

<section>
    <h2>Cursos del profesor</h2>
    <p>Agrega cursos propios para organizar a tus estudiantes. Luego podrás registrarlos en la sección de estudiantes.</p>

    <div class="panel-grid">
        <div class="card-box">
            <h3>Crear curso</h3>
            <?php if ($mensaje !== ''): ?>
                <div class="msg-ok"><?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
            <?php if ($error !== ''): ?>
                <div class="msg-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
            <form method="post">
                <label for="nombre_curso">Nombre del curso</label>
                <input type="text" id="nombre_curso" name="nombre_curso" placeholder="Ej: Matemáticas 8B" required>

                <label for="descripcion_curso">Descripción breve</label>
                <input type="text" id="descripcion_curso" name="descripcion_curso" placeholder="Ej: Grupo de refuerzo" maxlength="255">

                <input type="submit" name="crear_curso" value="Guardar curso">
            </form>
        </div>

        <div class="card-box">
            <h3>Mis cursos</h3>
            <?php if (empty($cursos)): ?>
                <p class="muted">Aún no has creado cursos.</p>
            <?php else: ?>
                <?php foreach ($cursos as $curso): ?>
                    <div class="course-item">
                        <strong><?php echo htmlspecialchars($curso['nombre'], ENT_QUOTES, 'UTF-8'); ?></strong>
                        <?php if (!empty($curso['descripcion'])): ?>
                            <div class="muted"><?php echo htmlspecialchars($curso['descripcion'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <?php endif; ?>
                        <div style="margin-top:10px;">
                            <a href="curso_detalle.php?id=<?php echo (int) $curso['id']; ?>" class="btn">Ver curso</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="panel-grid" style="margin-top: 30px;">
        <div class="card-box">
            <h3>Agregar tema al curso</h3>
            <?php if (empty($cursos)): ?>
                <p class="muted">Primero crea al menos un curso para poder agregar temas.</p>
            <?php else: ?>
                <form method="post">
                    <label for="curso_tema_id">Curso</label>
                    <select id="curso_tema_id" name="curso_tema_id" required>
                        <option value="">Selecciona un curso</option>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?php echo (int) $curso['id']; ?>"><?php echo htmlspecialchars($curso['nombre'], ENT_QUOTES, 'UTF-8'); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="nombre_tema">Nombre del tema</label>
                    <input type="text" id="nombre_tema" name="nombre_tema" placeholder="Ej: Introducción a hardware" required>

                    <label for="descripcion_tema">Descripción breve</label>
                    <input type="text" id="descripcion_tema" name="descripcion_tema" placeholder="Ej: Conceptos básicos" maxlength="255">

                    <label for="orden_tema">Orden</label>
                    <input type="number" id="orden_tema" name="orden_tema" value="1" min="1" max="255">

                    <input type="submit" name="crear_tema" value="Guardar tema">
                </form>
            <?php endif; ?>
        </div>

        <div class="card-box">
            <h3>Temas creados</h3>
            <?php if (empty($temas)): ?>
                <p class="muted">Aún no has agregado temas.</p>
            <?php else: ?>
                <?php foreach ($temas as $tema): ?>
                    <div class="course-item">
                        <strong><?php echo htmlspecialchars($tema['nombre'], ENT_QUOTES, 'UTF-8'); ?></strong>
                        <div class="muted">Curso: <?php echo htmlspecialchars($tema['curso_nombre'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <?php if (!empty($tema['descripcion'])): ?>
                            <div class="muted"><?php echo htmlspecialchars($tema['descripcion'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>
</body>
</html>
