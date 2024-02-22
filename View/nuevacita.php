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
        <form action="" method="post">
            <h1>Gestion de citas de las ITV de <?php echo $_SESSION['user']->provincia; ?></h1>
            Matricula: <input type="text" name="mat"> <input type="submit" name="buscarMat" value="Buscar">
        </form>
        <?php
        if (isset($_POST['anular'])) {
            CitasController::borrarCita($_POST['matricula']);
            $ruta = "../fotos/".$_POST['archivo'];
            unlink($ruta);
            echo "Cita anulada";
        }
        
        if (isset($_POST['registrar'])) {
            if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
                
                    $fich = time()."-".$_POST['matricula']."ficha.jpg";
                    $ruta = "../fotos/".$fich;
                    move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
            }
            
            $cita = new Citas($_POST['matricula'], $_POST['itv'], $_POST['fecha'], $_POST['hora'], $fich);
            if (CitasController::insertarCita($cita)) {
                $_SESSION['nuevaCita'] = true;
                $_SESSION['obCita'] = $cita;
                header("location:menu.php");
            }
        }
        
        if (isset($_POST['buscarMat'])) {
            $v = VehiculoController::buscarVehiculo($_POST['mat']);
            if ($v === 0) {
                echo "No existe ningun vehiculo con la matricula $_POST[mat]";
            }
            else {
                $c = CitasController::buscarCita($v->matricula);
                if ($c === 0) {
                    $itvs = ItvsController::recuperarTodas();
                    
                    ?>
        <form action="" method="POST" enctype="multipart/form-data">
        <h1>Datos del Vehiculo</h1>
        Matrícula: <input type="text" name="matricula" value="<?php echo $v->matricula; ?>" readonly=""><br>
        Marca: <input type="text" value="<?php echo $v->marca; ?>" readonly=""><br>
        Modelo: <input type="text" value="<?php echo $v->modelo; ?>" readonly=""><br>
        Color: <input type="text" value="<?php echo $v->color; ?>" readonly=""><br>
        Plazas: <input type="text" value="<?php echo $v->plazas; ?>" readonly=""><br>
        Fecha de la ultima revision: <input type="date" value="<?php echo $v->fechaUltimaRevision; ?>"readonly=""><br><br>
        <h1>Elegir ITV</h1>
            <select name="itv">
            <?php
                foreach ($itvs as $itv) {
                    echo "<option value='$itv->id'>$itv->localidad - $itv->direccion</option>";
                }
            ?>
            </select>
            Fecha: <input type="date" name="fecha" required><br>
            Hora: <input type="time" name="hora" required><br>
            Ficha tecnica del vehiculo: <input type="file" name="foto" required><br>
            <input type="submit" name="registrar" value="Registrar">
        </form>
                    <?php
                }
                else {
                    $itv = ItvsController::buscarItv($c->idItv);
                    echo "<p>Ya tiene una cita el dia $c->fecha a las $c->hora en la ITV de $itv->localidad en la provincia de $itv->provincia</p>";
                    echo "<form action='' method='POST'>";
                    echo "<input type='hidden' name='matricula' value='$c->matricula'>";
                    echo "<input type='hidden' name='archivo' value='$c->ficha'>";
                    echo "<input type='submit' name='anular' value='Anular'>";
                    echo "</form>";
                }
            }
        }
        
        ?>
        
    </body>
</html>

