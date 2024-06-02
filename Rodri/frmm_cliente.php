<!-- Variable para el ingreso a la bd -->
<?php
$mysqli = new mysqli('localhost', 'root', '','restaurante') or die ("Fallo en la conexion");
?>

<html>
    <head>
        <title>Modificar cliente</title>
    </head>
    <body>
        <p>Seleccione el cliente a modificar:</p>
        <form action="show.php" method ="post">
            cliente: <select name = "cliente">
                <?php
                $query = $mysqli -> query("SELECT * FROM cliente") or die ("no se puede generar el query");
                while($valores = mysqli_fetch_array($query)) {
                    echo '<option value="'.$valores['n_cliente'].'">'.$valores['nombre']." ".$valores['apellido_p'].'</option>';
                }
                ?>
            </select>
        <br>
        <input type="submit" value="Seleccionar cliente">
        </form>
    </body>
</html>