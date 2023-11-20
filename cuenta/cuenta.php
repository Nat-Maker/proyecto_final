<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Registro</title>
    <link rel="stylesheet" href="../css/registro.css">
    <link rel="stylesheet" href="../css/responsivo.css">
</head>

<body>
    <nav>
        <input type="checkbox" id="menu" style="position: relative;"> <label for="menu">☰</label>
        <ul>
            <li><a href="../index.html">
                    <h2>Inicio</h2>
                </a></li>
            <li><a href="../tienda.html">
                    <h2>Tienda</h2>
                </a></li>
            <li><a href="../ubicacion.html">
                    <h2>Ubicaciones</h2>
                </a></li>
            <li><a href="../us.html">
                    <h2>Nosotros</h2>
                </a></li>
            <li><a href="cuenta/cuenta.php">
                    <h2>Cuenta</h2>
                </a></li>
            <div class="buscar">
                <input type="text" placeholder="Buscar" required>
            </div>

        </ul>
    </nav>

    <!-- register -->
    <div id="wrap">
        <?php
        require('db.php');
        if (isset($_REQUEST['username'])) {
            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($con, $username);
            $email = stripslashes($_REQUEST['email']);
            $email = mysqli_real_escape_string($con, $email);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);
            $create_datetime = date("Y-m-d H:i:s");
            $query = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
            $result = mysqli_query($con, $query);
            if ($result) {
                header("Location: ../index.html");
                exit();
            } else {
                echo "<div class='form'>
                  <h3>Complete todos los campos</h3><br/>
                  <p class='link'>Presione aqui para <a href='registration.php'>registrarse</a> de nuevo.</p>
                  </div>";
            }
        } else {
            ?>
            <form class="form" action="" method="post">
                <h1 class="login-title">Registro de Cuenta</h1>
                <input type="text" class="login-input" name="username" placeholder="Nombre de Usuario" required />
                <input type="text" class="login-input" name="email" placeholder="Correo Electronico">
                <input type="password" class="login-input" name="password" placeholder="Contraseña">
                <input type="submit" name="submit" value="Registrate" class="login-button">
                <p class="link"><a href="login.php">¿Ya tienes una cuenta?</a></p>
            </form>
            <?php
        }
        ?>

        <!-- login -->

        <?php
        require('db.php');
        session_start();
        if (isset($_POST['username'])) {
            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($con, $username);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);
            $query = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
            $result = mysqli_query($con, $query) or die(mysql_error());
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
            } else {
                echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
            }
        } else {
            ?>
            <form class="form" method="post" name="login">
                <h1 class="login-title">Inicio de Sesion</h1>
                <input type="text" class="login-input" name="username" placeholder="Nombre de Usuario" autofocus="true" />
                <input type="password" class="login-input" name="password" placeholder="Contraseña" />
                <input type="submit" value="Login" name="submit" class="login-button" />
                <p class="link"><a href="registration.php">¿No tienes cuenta?</a></p>
            </form>
            <?php
        }
        ?>
    </div>

    <!-- footer -->
    <footer>
        <div class="com">
            <h4>Compañia</h4>
            <ul>
                <li><a href="#">Sobre Nosotros</a></li>
                <li><a href="#">Nuestros Servicios</a></li>
                <li><a href="#">Politica de Privacidad</a></li>
            </ul>
        </div>
        <div class="ayd">
            <h4>Ayuda</h4>
            <ul>
                <li><a href="#">Preguntas</a></li>
                <li><a href="#">Entregas</a></li>
                <li><a href="#">Devoluciones</a></li>
                <li><a href="#">Estatus de orden</a></li>
                <li><a href="#">Opciones de pago</a></li>
            </ul>
        </div>
        <img class="logof" src="../img/logo.png">
        <div class="red">
            <h4>Redes Sociales</h4>
            <div class="reso">
                <a href="#"><img src="../img/red1.jpg" alt="facebook"></a>
                <a href="#"><img src="../img/red2.jpg" alt="instagram"></a>
                <a href="#"><img src="../img/red3.jpg" alt="twitter"></a>
                <a href="#"><img src="../img/red4.jpg" alt="youtube"></a>
            </div>
        </div>
    </footer>

</body>

</html>