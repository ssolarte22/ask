<?php
session_start();
require_once __DIR__ . '/../inc/database.php';

if (!isset($_SESSION['autenticado'])) {
    header('Location: home.php');
    exit();
}

$rows = ask_list_admin_docente_table_rows();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Administrativa - Tutor IA</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .table-wrap {
            overflow-x: auto;
            margin-top: 20px;
        }
        .admin-table {
            width: 100%;
            min-width: 900px;
        }
        .admin-table th,
        .admin-table td {
            vertical-align: top;
            text-align: left;
        }
        .admin-table th {
            text-align: left;
        }
        .empty-note {
            color: #555;
            font-style: italic;
        }
        .teacher-block {
            background: #f8fbff;
            border-left: 6px solid #D4AF37;
            padding: 10px 12px;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
<?php
$tituloPlataforma = 'Plataforma Administrador - Videos con IA';
$subtituloPlataforma = 'Tabla de docentes, estudiantes y cursos';
$badgePlataforma = 'Bienvenido Administrador: ' . ($_SESSION['docente'] ?? ($_SESSION['usuario'] ?? ''));
include 'top_admin.php';
?>

<section>
    <h2>Tabla administrativa</h2>
    <p>Desde aquí puedes revisar los docentes registrados, sus estudiantes y los cursos que cada estudiante tiene asignados.</p>

    <div class="panel-academico">
        <h3>Resumen general</h3>
        <p>Si un docente no tiene alumnos registrados, aparecerá igualmente en la tabla para mantener el control completo.</p>
    </div>

    <div class="table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Docente</th>
                    <th>Usuario</th>
                    <th>Alumno</th>
                    <th>Cédula</th>
                    <th>Cursos asignados</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($rows)): ?>
                    <tr>
                        <td colspan="5" class="empty-note">No hay docentes registrados para mostrar.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td>
                                <div class="teacher-block">
                                    <strong><?php echo htmlspecialchars($row['docente_nombre'], ENT_QUOTES, 'UTF-8'); ?></strong>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($row['docente_login'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['alumno_nombre'] ?? 'Sin alumnos', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['alumno_cedula'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['cursos'] ?? 'Sin cursos asignados', ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2026</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>
</body>
</html>
