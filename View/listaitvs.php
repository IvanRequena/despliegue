<?php
require_once '../Controller/UsuarioController.php';
require_once '../Controller/VehiculoController.php';
require_once '../Controller/CitasController.php';
require_once '../Controller/ItvsController.php';
session_start();
?>


<html>
    <head>
        <title>Menu</title>
    </head>
    <body>
        <?php
        if (isset($_POST['cerrarSesion'])) {
            session_unset();
            session_destroy();
            setcookie("PHPSESSID",0, time()-1000000, "/");
            header("location:index.php");
        }
        if (!isset($_SESSION['logeado'])) {
            header("location:index.php");
        }
        echo "<p>Hola administrador de ".$_SESSION['user']->provincia."</p>";
        echo "<p>Telefono: ".$_SESSION['user']->telefono."</p>";
            ?>
        
        <form action="" method="post">
            <input type="submit" name="cerrarSesion" value="Salir">
        </form>
        <a href="menu.php">Volver al menú</a>
        <h1>Sedes de ITV de la provincia de <?php echo $_SESSION['user']->provincia; ?></h1>
        <?php
        $itvs = ItvsController::recuperarTodasDe($_SESSION['user']->provincia);
        if ($itvs == 0) {
            echo 'No existen sedes de ITV para esta provincia';
        }
        else {
            ?>
        <table border="1">
            <tr><th>Localidad</th><th>Direccion</th><th>Citas</th></tr>
            <?php
                foreach ($itvs as $itv) {
                    echo "<tr>";
                    echo "<td>$itv->localidad</td>";
                    echo "<td>$itv->direccion</td>";
                    echo "<td><a href=citas.php?id=$itv->id><button>Mis citas</button></a></td>";
                    
                    echo "</tr>";
                }

            ?>
        </table>
        
        <?php
        }
        
        ?>
    </body>
</html>

