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

$cursos = $usuarioId > 0 ? ask_list_docente_courses($usuarioId) : [];
$alumnos = $usuarioId > 0 ? ask_list_docente_students($usuarioId) : [];
$asignaciones = $usuarioId > 0 ? ask_list_docente_course_students($usuarioId) : [];

if ($usuarioId <= 0) {
    $error = 'No se pudo identificar al docente en sesión.';
}

if (isset($_POST['registrar_estudiante']) && $usuarioId > 0) {
    $nombre = trim((string) ($_POST['nombre_estudiante'] ?? ''));
    $cedula = trim((string) ($_POST['cedula_estudiante'] ?? ''));

    if ($nombre === '' || $cedula === '') {
        $error = 'Completa nombre y cédula.';
    } else {
        try {
            ask_create_docente_student($usuarioId, $nombre, $cedula);
            $mensaje = 'Estudiante registrado en tu tabla correctamente.';
            $alumnos = ask_list_docente_students($usuarioId);
        } catch (Throwable $e) {
            $error = 'No se pudo registrar el estudiante. Verifica si la cédula ya existe.';
        }
    }
}

if (isset($_POST['asignar_estudiante']) && $usuarioId > 0) {
    $cursoId = (int) ($_POST['curso_asignar_id'] ?? 0);
    $alumnoId = (int) ($_POST['alumno_id'] ?? 0);

    if ($cursoId <= 0 || $alumnoId <= 0) {
        $error = 'Selecciona un curso y un alumno.';
    } elseif (ask_find_docente_course_by_id($cursoId, $usuarioId) === null) {
        $error = 'El curso seleccionado no te pertenece o no existe.';
    } elseif (ask_find_docente_student_by_id($alumnoId, $usuarioId) === null) {
        $error = 'El alumno seleccionado no te pertenece o no existe.';
    } else {
        try {
            ask_assign_docente_student_to_course($usuarioId, $cursoId, $alumnoId);
            $mensaje = 'Alumno asignado al curso correctamente.';
            $asignaciones = ask_list_docente_course_students($usuarioId);
        } catch (Throwable $e) {
            $error = 'No se pudo asignar el alumno al curso.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes del Docente - Tutor IA</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .panel-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        .card-box { background: #fff; border: 2px solid #002244; padding: 20px; box-shadow: 8px 8px 0 #D4AF37; }
        .student-item { border: 2px solid #121212; padding: 14px; margin-bottom: 12px; background: #fcfdff; }
        .muted { color: #555; font-size: 0.95rem; }
        .msg-ok { background: #dcfce7; color: #166534; border: 1px solid #166534; padding: 10px; margin-bottom: 15px; }
        .msg-error { background: #fee2e2; color: #991b1b; border: 1px solid #991b1b; padding: 10px; margin-bottom: 15px; }
        @media (max-width: 900px) { .panel-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<?php
$tituloPlataforma = 'Plataforma Docente - Estudiantes';
$subtituloPlataforma = 'Registra estudiantes en un curso propio';
$badgePlataforma = 'Bienvenido Profesor: ' . ($_SESSION['docente'] ?? '');
include 'top_docente.php';
?>

<section>
    <h2>Estudiantes del profesor</h2>
    <p>Primero registras al alumno en tu tabla. Después lo asignas a un curso propio.</p>

    <div class="panel-grid">
        <div class="card-box">
            <h3>Registrar alumno</h3>
            <?php if ($mensaje !== ''): ?>
                <div class="msg-ok"><?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
            <?php if ($error !== ''): ?>
                <div class="msg-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>

            <form method="post">
                <label for="nombre_estudiante">Nombre del alumno</label>
                <input type="text" id="nombre_estudiante" name="nombre_estudiante" placeholder="Ej: Juan Pérez" required>

                <label for="cedula_estudiante">Cédula</label>
                <input type="text" id="cedula_estudiante" name="cedula_estudiante" placeholder="Ej: 123456789" required>

                <input type="submit" name="registrar_estudiante" value="Guardar alumno">
            </form>
        </div>

        <div class="card-box">
            <h3>Asignar alumno a curso</h3>
            <?php if (empty($cursos) || empty($alumnos)): ?>
                <p class="muted">Necesitas al menos un curso y un alumno registrados.</p>
                <a href="cursos.php" class="btn" style="margin-right:10px;">Ir a Cursos</a>
                <a href="#" class="btn">Ir a Alumnos</a>
            <?php else: ?>
                <form method="post">
                    <label for="curso_asignar_id">Curso</label>
                    <select id="curso_asignar_id" name="curso_asignar_id" required>
                        <option value="">Selecciona un curso</option>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?php echo (int) $curso['id']; ?>"><?php echo htmlspecialchars($curso['nombre'], ENT_QUOTES, 'UTF-8'); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="alumno_id">Alumno</label>
                    <select id="alumno_id" name="alumno_id" required>
                        <option value="">Selecciona un alumno</option>
                        <?php foreach ($alumnos as $alumno): ?>
                            <option value="<?php echo (int) $alumno['id']; ?>"><?php echo htmlspecialchars($alumno['nombre'] . ' - ' . $alumno['cedula'], ENT_QUOTES, 'UTF-8'); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <input type="submit" name="asignar_estudiante" value="Asignar alumno al curso">
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="panel-grid" style="margin-top: 30px;">
        <div class="card-box">
            <h3>Mis alumnos</h3>
            <?php if (empty($alumnos)): ?>
                <p class="muted">Aún no has registrado alumnos.</p>
            <?php else: ?>
                <?php foreach ($alumnos as $alumno): ?>
                    <div class="student-item">
                        <strong><?php echo htmlspecialchars($alumno['nombre'], ENT_QUOTES, 'UTF-8'); ?></strong>
                        <div class="muted">Cédula: <?php echo htmlspecialchars($alumno['cedula'], ENT_QUOTES, 'UTF-8'); ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="card-box">
            <h3>Alumnos por curso</h3>
            <?php if (empty($asignaciones)): ?>
                <p class="muted">Todavía no has asignado alumnos a cursos.</p>
            <?php else: ?>
                <?php foreach ($asignaciones as $asignacion): ?>
                    <div class="student-item">
                        <strong><?php echo htmlspecialchars($asignacion['alumno_nombre'], ENT_QUOTES, 'UTF-8'); ?></strong>
                        <div class="muted">Cédula: <?php echo htmlspecialchars($asignacion['alumno_cedula'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="muted">Curso: <?php echo htmlspecialchars($asignacion['curso_nombre'], ENT_QUOTES, 'UTF-8'); ?></div>
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
