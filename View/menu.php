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
        <h1>Gestion de citas de las ITV de <?php echo $_SESSION['user']->provincia; ?></h1>
        <a href="nuevacita.php">Registrar nueva cita</a><br>
        <a href="listaitvs.php">Listados de sedes ITV</a><br>
        <?php
        if (isset($_SESSION['nuevaCita'])) {
            if ($_SESSION['nuevaCita'] == true) {
            $_SESSION['nuevaCita'] = false;
            $cita = $_SESSION['obCita'];
            $vehi = VehiculoController::buscarVehiculo($cita->matricula);
            $it = ItvsController::buscarItv($cita->idItv);
            echo "<p>El vehiculo con matricula $vehi->matricula tiene una cita el dia $cita->fecha a las $cita->hora en la sede de $it->localidad en la provincia de $it->provincia</p>";
            }
        }
        ?>
    </body>
</html>
