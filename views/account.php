<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página web del Reto1 del Grupo 1 WWW">
    <meta name="author" content="Ieltxu Albin, Erlaitz Alonso, Andoni Alonso, Juan Garcia e Ibai Garcia">
    <link rel="icon" href="../img/Logo_muskiz.svg">
    <title>Biblioteca de Muskiz</title>
    <link rel="stylesheet" href="../css/account/account.css">
    <link rel="stylesheet" href="../css/common.css">
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header('Location: login.php');
    }
    
    include '.\conexion.php';
    if (!isset($_SESSION['user_email'])) {
        $comprobacion = 'select * from usuarios where usuario="'.$_SESSION['username'].'" and contraseña="'.$_SESSION['password'].'"';
        $resultado = mysqli_query($CONEXION,$comprobacion);
        while ($cuenta=mysqli_fetch_array($resultado)) {
            $_SESSION['user_name'] = $cuenta['nombre'];
            $_SESSION['user_email'] = $cuenta['correo'];
            $_SESSION['username'] = $cuenta['usuario'];
            $_SESSION['password'] = $cuenta['contraseña'];
        }
    }
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
        <section class="global-account">
            <article class="account-box">
                <div class="user-info">
                    <h2>Datos personales y de contacto</h2>
                    <p><strong>Nombre:</strong> <?php
                        echo $_SESSION['username'];
                    ?></p>
                    <p><strong>Pseudónimo:</strong> <?php
                        echo $_SESSION['user_name'];
                    ?></p>
                    <p><strong>Email:</strong> <?php
                        echo $_SESSION['user_email'];
                    ?></p>
                    <form action="account.php" method="post">
                        <button class="logout" name="logout">Cerrar Sesión</button>
                    </form>
                </div>

                <div class="change-password">
                    <h2>Datos de acceso</h2>
                    <p><strong>Email:</strong> <?php
                        echo $_SESSION['user_email'];
                    ?></p>
                    <form action="" method="post">
                        <label for="old-password">Contraseña Actual:</label>
                        <input type="password" id="old-password" name="password_old" required>

                        <label for="new-password">Nueva Contraseña:</label>
                        <input type="password" id="new-password" name="password" required>

                        <label for="confirm-password">Confirmar Nueva Contraseña:</label>
                        <input type="password" id="confirm-password" name="password_sec" required>

                        <button type="submit">Cambiar Contraseña</button>

                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $password_old = $_POST['password_old'];
                            $password = $_POST['password'];
                            $password_sec = $_POST['password_sec'];

                            if ($password !== $password_sec) {
                                echo "La nueva contraseña no coinciden. Por favor, inténtalo de nuevo." ;
                            } elseif ($password_old == $password) {
                                echo("No se puede poner la antigua contraseña. Por favor, inténtalo de nuevo.");
                            } else {
                                $update = 'update usuarios set contraseña='.$password.'" where usuario="'.$_SESSION['username'].'" and contraseña="'.$password.'"';
                                try {
                                    //code...
                                    $resultado = mysqli_query($CONEXION, $update);
                                    $_SESSION['password'] = $password;
                                    echo "Se cambio la contraseña!";
                                } catch (\Throwable $th) {
                                    //throw $th;
                                    echo "No se ha podido cambiar la contraseña!";
                                }
                            }
                        }
                        ?>
                    </form>
                </div>
            </article>

            <article class="books-box">
                <h2>Libros Prestados</h2>
                <hr>
                <div class="book-box">
                    <div class="book-img"><img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.vexels.com%2Fmedia%2Fusers%2F3%2F140908%2Fisolated%2Fpreview%2Fbdc30bbe3c022a11e2d7fd0e642c61ae-icono-de-libro-abierto.png&f=1&nofb=1&ipt=d0831dcfe1d3c14dcfff8aa9d4c51b47e2e1a8185ed577aa8f07abcff55f7bff&ipo=images" alt="Libro"></div>
                    <p>Libro: Sin préstamo<br><br>Autor: Sin préstamo</p>
                </div>
                <hr>
                <div class="book-box">
                    <div class="book-img"><img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.vexels.com%2Fmedia%2Fusers%2F3%2F140908%2Fisolated%2Fpreview%2Fbdc30bbe3c022a11e2d7fd0e642c61ae-icono-de-libro-abierto.png&f=1&nofb=1&ipt=d0831dcfe1d3c14dcfff8aa9d4c51b47e2e1a8185ed577aa8f07abcff55f7bff&ipo=images" alt="Libro"></div>
                    <p>Libro: Sin préstamo<br><br>Autor: Sin préstamo</p>
                </div>
                <hr>
                <div class="book-box">
                    <div class="book-img"><img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.vexels.com%2Fmedia%2Fusers%2F3%2F140908%2Fisolated%2Fpreview%2Fbdc30bbe3c022a11e2d7fd0e642c61ae-icono-de-libro-abierto.png&f=1&nofb=1&ipt=d0831dcfe1d3c14dcfff8aa9d4c51b47e2e1a8185ed577aa8f07abcff55f7bff&ipo=images" alt="Libro"></div>
                    <p>Libro: Sin préstamo<br><br>Autor: Sin préstamo</p>
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