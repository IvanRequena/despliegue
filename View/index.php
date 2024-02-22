<html>
    <head>
        <title>Index</title>
    </head>
    <body>
        <?php
        require_once '../Controller/UsuarioController.php';
        session_start();
        if (isset($_SESSION['logeado'])) {
            header("location:menu.php");
        }
        $errores = false;
        if (isset($_POST['entrar'])) {
            $usuario = UsuarioController::buscarUsuario($_POST['usu']);
            if ($usuario == false) {
                $errores = true;
            }
            else {
                if(password_verify($_POST['pass'], $usuario->pass)) {
                    $_SESSION['user'] = $usuario;
                    $_SESSION['logeado'] = true;
                    header("location:menu.php");
                }
                else {
                    $errores = true;
                }
            }
        }

            ?>
        
        <form action="" method="POST">
            <h1>Gestion de citas ITV Andalucia</h1><br>
            Usuario: <input type="text" name="usu" required=""><br>
            Clave: <input type="password" name="pass"required=""><br>
            <input type="submit" name="entrar" value="Acceder">
        </form>
<?php if ($errores) echo "<span style=color:red>Usuario o clave incorrecta</span>";?>
    </body>
</html>
