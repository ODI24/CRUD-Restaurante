<!-- Variable para el ingreso a la bd -->
<?php
$mysqli = new mysqli('localhost', 'root', '','restaurante') or die ("Fallo en la conexion");
?>

<html>
    <head>
        <title>Eliminar Personal</title>
    </head>
    <body>
        <h1>Eliminar Personal</h1>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['i'])) {
                echo '<h3>Datos Eliminados:</h3>';
                include ('show_del.php');
                echo '<br>';
            }
        ?>
        <form action="" method="post">
            <input type="hidden" name="i" value="personal">
            <h4>Seleccione personal a eliminar (ctrl + click): </h4>
            personal: <select name = "id[]" multiple required>
            <?php
            $query = $mysqli -> query("SELECT * FROM personal") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['personal_id'].'">'.$valores['nombre']." ".$valores['apellido'].'</option>';
            }
            ?>
            </select> <br><br>
            <input type="submit" value="Eliminar">
        </form>

        <br> <br>
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