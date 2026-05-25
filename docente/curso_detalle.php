<?php
session_start();
require_once __DIR__ . '/../inc/database.php';

if (!isset($_SESSION['autenticado'])) {
    header('Location: home.php');
    exit();
}

$usuarioId = (int) ($_SESSION['usuario_id'] ?? 0);
$cursoId = (int) ($_GET['id'] ?? 0);
$mensaje = '';
$error = '';

if ($usuarioId <= 0 || $cursoId <= 0) {
    header('Location: cursos.php');
    exit();
}

$curso = ask_find_docente_course_by_id($cursoId, $usuarioId);
if ($curso === null) {
    header('Location: cursos.php');
    exit();
}

if (isset($_POST['quitar_alumno'])) {
    $alumnoId = (int) ($_POST['alumno_id'] ?? 0);
    if ($alumnoId <= 0) {
        $error = 'Selecciona un alumno para quitar.';
    } else {
        ask_unassign_docente_student_from_course($usuarioId, $cursoId, $alumnoId);
        $mensaje = 'Alumno quitado del curso correctamente.';
    }
}

$alumnosCurso = ask_list_docente_course_students_by_course($usuarioId, $cursoId);
$temasCurso = ask_list_docente_topics_by_course($usuarioId, $cursoId);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Curso - Tutor IA</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .course-card { background: #fff; border: 2px solid #002244; padding: 20px; box-shadow: 8px 8px 0 #D4AF37; }
        .student-item { border: 2px solid #121212; padding: 14px; margin-bottom: 12px; background: #fcfdff; }
        .muted { color: #555; font-size: 0.95rem; }
        .msg-ok { background: #dcfce7; color: #166534; border: 1px solid #166534; padding: 10px; margin-bottom: 15px; }
        .msg-error { background: #fee2e2; color: #991b1b; border: 1px solid #991b1b; padding: 10px; margin-bottom: 15px; }
        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        @media (max-width: 900px) { .detail-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<?php
$tituloPlataforma = 'Detalle del curso';
$subtituloPlataforma = 'Información del curso y alumnos asignados';
$badgePlataforma = 'Bienvenido Profesor: ' . ($_SESSION['docente'] ?? '');
include 'top_docente.php';
?>

<section>
    <a href="cursos.php" class="btn" style="margin-bottom:20px; display:inline-flex;">Volver a cursos</a>

    <div class="detail-grid">
        <div class="course-card">
            <h2><?php echo htmlspecialchars($curso['nombre'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <?php if (!empty($curso['descripcion'])): ?>
                <p class="muted"><?php echo htmlspecialchars($curso['descripcion'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>

            <h3>Temas del curso</h3>
            <?php if (empty($temasCurso)): ?>
                <p class="muted">Todavía no hay temas registrados para este curso.</p>
            <?php else: ?>
                <?php foreach ($temasCurso as $tema): ?>
                    <div class="student-item">
                        <strong><?php echo htmlspecialchars($tema['nombre'], ENT_QUOTES, 'UTF-8'); ?></strong>
                        <?php if (!empty($tema['descripcion'])): ?>
                            <div class="muted"><?php echo htmlspecialchars($tema['descripcion'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="course-card">
            <h3>Alumnos en este curso</h3>
            <?php if ($mensaje !== ''): ?>
                <div class="msg-ok"><?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
            <?php if ($error !== ''): ?>
                <div class="msg-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>

            <?php if (empty($alumnosCurso)): ?>
                <p class="muted">Todavía no hay alumnos asignados a este curso.</p>
            <?php else: ?>
                <?php foreach ($alumnosCurso as $alumno): ?>
                    <div class="student-item">
                        <strong><?php echo htmlspecialchars($alumno['alumno_nombre'], ENT_QUOTES, 'UTF-8'); ?></strong>
                        <div class="muted">Cédula: <?php echo htmlspecialchars($alumno['alumno_cedula'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <form method="post" style="margin-top:10px;">
                            <input type="hidden" name="alumno_id" value="<?php echo (int) $alumno['alumno_id']; ?>">
                            <input type="submit" name="quitar_alumno" value="Quitar del curso">
                        </form>
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
