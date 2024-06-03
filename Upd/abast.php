<!-- Variable para el ingreso a la bd -->
<?php
$mysqli = new mysqli('localhost', 'root', '','restaurante') or die ("Fallo en la conexion");
?>

<html>
    <head>
        <title>Abastecimiento</title>
    </head>
    <body>
        <h1>Nuevo Abastecimiento</h1>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['i'])) {
                echo '<h3>Datos Modificados :</h3>';
                include ('show_upd.php');
                echo '<br>';
            }
        ?>
        <form action="" method="post">
            <h4>Abastecimiento</h4>
            <input type="hidden" name="i" value="abast">
            Producto: <select name = "id" required>
            <?php
            $query = $mysqli -> query("SELECT * FROM ingredientes") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['id_ing'].'">'.$valores['nombre_ing'].'</option>';
            }
            ?>
            </select> <br>
            <h4>Ingrese los datos:</h4>
            cantidad: <input type="text" name="cant" placeholder="50" pattern="[0-9]+" maxlength="5"
                 title="Por favor, ingresa solo numeros (no letras ni caracteres especiales)." required> <br>
            ultimo abastecimiento: <input type="datetime-local" name="abast" required><br>
            <input type="submit" value="Actualizar">
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