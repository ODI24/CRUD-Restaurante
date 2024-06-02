<!-- Variable para el ingreso a la bd -->
<?php
$mysqli = new mysqli('localhost', 'root', '','restaurante') or die ("Fallo en la conexion");
?>

<html>
    <head>
        <title>Modificar cliente</title>
    </head>
    <body>
        <h1>Modificar Cliente</h1>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['i'])) {
                echo '<h3>Datos Modificados :</h3>';
                include ('show_mod.php');
                echo '<br>';
            }
        ?>
        <form action="" method="post">
            <input type="hidden" name="i" value="cliente">
            cliente: <select name = "id">
            <?php
            $query = $mysqli -> query("SELECT * FROM cliente") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['n_cliente'].'">'.$valores['nombre']." ".$valores['apellido_p'].'</option>';
            }
            ?>
            </select> <br>
            nombre: <input type="text" name="nombre"> <br>
            apellido paterno: <input type="text" name="paterno"> <br>
            apellido materno: <input type="text" name="materno"> <br>
            telefono: <input type="number" name="telephone"><br>
            <input type="submit" value="Modificar">
        </form>

        <a href="http://localhost/codes/CRUD-Restaurante/Rodri/menu_mod.html">Regresar</a>
    </body>
</html>