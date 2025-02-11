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
                <div class="form" id="login-form">
                    <h2>Iniciar Sesión</h2>
                    <form action="" method="post">
                        <input type="text" name="user" placeholder="Nombre de usuario" required>
                        <input type="password" name="password" placeholder="Contraseña" required>
                        <button type="submit" name="login-submit">Iniciar Sesión</button>
                        <p>¿No tienes una cuenta? <a href="register.php" id="show-register">Regístrate</a></p>
                        <?php
                        if (isset($_POST['login-submit'])&& $_SERVER["REQUEST_METHOD"] == "POST") {
                            $user = $_POST['user'];
                            $password = $_POST['password'];
                            $comprobacion = 'select * from usuarios where usuario="'.$user.'" and contraseña="'.$password.'"';
                            $resultado = mysqli_query($CONEXION,$comprobacion);
                            $filas=mysqli_num_rows($resultado);

                            if ($filas==1) {
                                while ($cuenta=mysqli_fetch_array($resultado)) {
                                    $_SESSION['username'] = $cuenta['usuario'];
                                    $_SESSION['password'] = $cuenta['contraseña'];
                                }
                                header('Location:account.php');
                            } else {
                                echo "Nombre de usuario o contraseña incorrectos.";
                            }
                        }
                        ?>
                    </form>
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