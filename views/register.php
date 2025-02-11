<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página web del Reto1 del Grupo 1 WWW">
    <meta name="author" content="Ieltxu Albin, Erlaitz Alonso, Andoni Alonso, Juan Garcia e Ibai Garcia">
    <link rel="icon" href="../img/Logo_muskiz.svg">
    <title>Biblioteca de Muskiz</title>
    <link rel="stylesheet" href="../css/account/login.css">
    <link rel="stylesheet" href="../css/common.css">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['username'])) {
        header('Location: account.php');
    }
    include '.\conexion.php';
    ?>
    <header class="header">
        <!--este es el titulo-->
        <section class="title">
            <h1> BIBLIOTECA DE MUSKIZ</h1>
            <!--Aparatado para la pagina de inicio que te redige hacia otro lado-->
        </section>
        <nav class="menu">
            <ul>
                <li><a href="../index.html">Inicio</a></li>
                <li><a href="noticias.html">Noticias</a></li>
                <li><a href="catalogo_1.html">Catálogo</a></li>
                <li><a href="acercade.html">Acerca de</a></li>
                <li><a href="login.php">Mi cuenta</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2 class="title-info">Mi Cuenta</h2>
        <section class="box-account">
            <article class="form-box">
                <div class="form" id="register-form">
                    <h2>Registro</h2>
                    <form action="register.php" method="post">
                        <input type="text" name="name" placeholder="Nombre" required>
                        <input type="text" name="user_name" placeholder="Nombre de usuario" required>
                        <input type="email" name="email" placeholder="Correo Electrónico" required>
                        <input type="password" name="password" placeholder="Contraseña" required>
                        <input type="password" name="password_sec" placeholder="Confirmar Contraseña" required>
                        <button type="submit" name="register-submit">Registrarse</button>
                        <p>¿Ya tienes una cuenta? <a href="login.php" id="show-login">Iniciar Sesión</a></p>
                    </form>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $name = $_POST['name'];
                        $username = $_POST['user_name'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $password_sec = $_POST['password_sec'];
                        if (!empty($name) && !empty($username) && !empty($email) && !empty($password) && !empty($password_sec)) {
                            if ($password !== $password_sec) {
                                echo "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
                            } else {
                                $insert = 'insert into usuarios (correo,nombre,usuario,contraseña) values ("'.$email.'","'.$name.'","'.$username.'","'.$password.'")';
                                try {
                                    $resultado = mysqli_query($CONEXION, $insert);
                                    $_SESSION['username'] = $username;
                                    $_SESSION['user_name'] = $name;
                                    $_SESSION['user_email'] = $email;
                                    $_SESSION['password'] = $password;
                                    header('Location: account.php');
                                } catch (\Throwable $th) {
                                    echo '<p>Usuario Existente</p>';
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </article>
        </section>
        <?php
        mysqli_close($CONEXION);
        ?>
    </main>
    <footer class="footer">
        <section class="footer-content">
            <article class="footer-section">
                <h2>Biblioteca de Muskiz</h2>
                <p>Tu fuente de conocimiento y entretenimiento en Muskiz.</p>
                <div class="footer-images">
                    <div><img src="../img/Logo_muskiz.png" alt="Logo Muskiz"></div>
                    <div><img src="../img/Imaganes/Logo_govierno vasco.png" alt="Logo Gobierno Vasco"></div>
                    <div><img src="../img/Imaganes/Logo_www.png" alt="Logo WWW"></div>
                </div>
            </article>
            <article class="footer-section">
                <h2>Enlaces Rápidos</h2>
                <ul>
                    <li><a href="../index.html">Inicio</a></li>
                    <li><a href="noticias.html">Noticias</a></li>
                    <li><a href="catalogo_1.html">Catálogo</a></li>
                    <li><a href="acercade.html">Acerca de</a></li>
                    <li><a href="login.php">Mi cuenta</a></li>
                </ul>
            </article>
            <article class="footer-section">
                <h2>Contacto</h2>
                <p>Email: biblioteca@muskiz.eus</p>
                <p>Teléfono: +34 946 707 275</p>
                <p>Dirección: Cendeja 29. Muskiz, 48550 </p>
            </article>
        </section>
        <article class="footer-bottom">
            &copy; 2024 Biblioteca de Muskiz | Todos los derechos reservados
        </article>
    </footer>
</body>

</html>