<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio Mayor del Cauca - Inicio</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Si está en una carpeta css/, usa: href="css/estilos.css" -->
</head>
<body>

<header>
    <div class="logo-container">
        <span class="logo-icon">🏛️</span>
        <div>
            <h1>Tutor para creacion de videos con IA</h1>
            <p>Innovación, Tecnología y Excelencia</p>
        </div>
    </div>
</header>

<nav>
    <?php 
        include 'menu.html';
    ?>
</nav>

<section>
    <h2 align="center">Verificar Usuario</h2>

    <form action="verificacion.php" method="POST">
        <table>
            <thead>
                <tr><th colspan="2">Datos usuario</th></tr>
            </thead>
            <tbody>
                <tr>
                    <th>Login</th>
                    <td><input type="text" name="login"></td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td><input type="password" name="clave"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="enviar"></td>
                    <td><input type="reset" name="restablecer"></td>
                </tr>
            </tbody>
        </table>
    </form>
    
    <?php
        session_start();

        date_default_timezone_set('America/Bogota');
        if(isset($_POST['enviar'])){
            $login = $_POST['login'];
            $clave = $_POST['clave'];

            if($login === $login && $clave === '123'){

                //creo variables de sesion, que mantiene sus datos
                $_SESSION['docente'] = "$login";
                $_SESSION['autenticado'] = true;
                $_SESSION['hora_ingreso'] = date('Y-m-d H:i:s');

                //redirecciona a la pagina de inicio automaticamente
                header('Location: docente/homeDocente.php');

            }else{
                header('Location: home.php');
            }
        }    
    ?>

</section>

<footer>
    <p>Colegio Mayor del Cauca - Todos los derechos reservados © 2025</p>
    <p>📍 Calle 5 # 8-20, Popayán | 📞 (602) 8234567</p>
</footer>

<script>
const links = document.querySelectorAll("nav a");
const current = window.location.pathname.split("/").pop();

links.forEach(link => {
    link.classList.remove("active"); // 🔥 limpia todos
    if (link.getAttribute("href") === current) {
        link.classList.add("active");
    }
});
</script>

</body>
</html>