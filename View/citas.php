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
        
        $itv = ItvsController::buscarItv($_GET['id']);
            ?>
        
        <form action="" method="post">
            <input type="submit" name="cerrarSesion" value="Salir">
        </form>
        <a href="menu.php">Volver al menú</a>
        <h1>Vehiculos con cita en la ITV de <?php echo $itv->localidad; ?></h1>
        <?php
        $citas = CitasController::recuperarTodasId($itv->id);
        if ($citas == 0) {
            echo 'No existen citas para esta sede';
        }
        else {
            ?>
        <table border="1">
            <tr><th>Matricula</th><th>Marca</th><th>Modelo</th><th>Fecha</th><th>Hora</th><th>Ficha tecnica</th></tr>
            <?php
                foreach ($citas as $c) {
                    $v = VehiculoController::buscarVehiculo($c->matricula);
                    echo "<tr>";
                    echo "<td>$v->matricula</td>";
                    echo "<td>$v->marca</td>";
                    echo "<td>$v->modelo</td>";
                    echo "<td>$c->fecha</td>";
                    echo "<td>$c->hora</td>";
                    echo "<td><a href=mostrar.php?ruta=$c->ficha target='_blank'><img src='../fotos/$c->ficha' width='200'></img></a></td>";
                    
                    echo "</tr>";
                }

            ?>
        </table>
        
        <?php
        }
        
        ?>
    </body>
</html>

