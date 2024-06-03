<!-- Variable para el ingreso a la bd -->
<?php
$mysqli = new mysqli('localhost', 'root', '','restaurante') or die ("Fallo en la conexion");
?>

<html>
    <head>
        <title>Eliminar ingredientes producto</title>
    </head>
    <body>
        <h1>Eliminar ingredientes del producto</h1>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['i'])) {
                echo '<h3>Datos Modificados :</h3>';
                include ('show_del.php');
                echo '<br>';
            }
        ?>
        <form action="" method="post">
            <h4>Producto a modificar</h4>
            <input type="hidden" name="i" value="ip">
            productos: <select name = "id" required>
            <?php
            $query = $mysqli -> query("SELECT * FROM producto") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['id_producto'].'">'.$valores['nombre_producto'].'</option>';
            }
            ?>
            </select> <br>
            <h4>Ingrese los ingredientes a eliminar (ctrl + click):</h4>
            ingredientes: <select name = "id_i[]" multiple required>
            <?php
            $query = $mysqli -> query("SELECT * FROM ingredientes") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['id_ing'].'">'.$valores['nombre_ing'].'</option>';
            }
            ?>
            <input type="submit" value="Eliminar">
        </form>
        
        <br>
        <button id="btn_return" onclick="returntoMenu()">Regresar</button>

        <script>
            function returntoMenu() {
                window.location.href = "menu_del.html";
            }
        </script>
    </body>
</html>

<?php
$mysqli->close();
?>