<?php
session_start();
date_default_timezone_set('America/Bogota');
require_once __DIR__ . '/../inc/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['enviar'])) {
    header('Location: login.php');
    exit();
}

$login = trim((string) ($_POST['login'] ?? ''));
$clave = (string) ($_POST['clave'] ?? '');
$usuario = $login !== '' ? ask_find_user_by_login($login) : null;

if ($usuario !== null && $usuario['rol'] === 'admin' && password_verify($clave, $usuario['password_hash'])) {
    $_SESSION['autenticado'] = true;
    $_SESSION['rol'] = 'admin';
    $_SESSION['usuario_id'] = (int) $usuario['id'];
    $_SESSION['usuario'] = $usuario['nombre'];
    $_SESSION['docente'] = $usuario['nombre'];
    $_SESSION['login'] = $usuario['login'];
    $_SESSION['hora_ingreso'] = date('Y-m-d H:i:s');

    header('Location: homeAdmin.php');
    exit();
}

header('Location: login.php?error=1');
