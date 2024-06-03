<!-- Variable para el ingreso a la bd -->
<?php
$mysqli = new mysqli('localhost', 'root', '','restaurante') or die ("Fallo en la conexion");
?>

<html>
    <head>
        <title>Anadir productos</title>
    </head>
    <body>
        <h1>Anadir productos a la orden</h1>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['i'])) {
                echo '<h3>Datos Modificados :</h3>';
                include ('show_upd.php');
                echo '<br>';
            }
        ?>
        <form action="" method="post">
            <h4>Orden a modificar</h4>
            <input type="hidden" name="i" value="orden">
            orden: <select name = "id" required>
            <?php
            $query = $mysqli -> query("SELECT * FROM ordenar") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['id'].'">'.$valores['nombre'].'</option>';
            }
            ?>
            </select> <br>
            <h4>Ingrese los productos a anadir (ctrl + click):</h4>
            orden: <select name = "id_p[]" multiple required>
            <?php
            $query = $mysqli -> query("SELECT * FROM producto") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['id_producto'].'">'.$valores['nombre_producto'].'</option>';
            }
            ?>
            <input type="submit" value="Anadir">
        </form>
        
        <br>
        <button id="btn_return" onclick="returntoMenu()">Regresar</button>

        <script>
            function returntoMenu() {
                window.location.href = "menu_upd.html";
            }
        </script>
    </body>
</html>

<?php
$mysqli->close();
?>