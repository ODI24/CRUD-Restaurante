<!-- Variable para el ingreso a la bd -->
<?php
$mysqli = new mysqli('localhost', 'root', '','restaurante') or die ("Fallo en la conexion");
?>

<html>
    <head>
        <title>Modificar Ingrediente</title>
    </head>
    <body>
        <h1>Modificar Ingrediente</h1>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['i'])) {
                echo '<h3>Datos Modificados :</h3>';
                include ('show_mod.php');
                echo '<br>';
            }
        ?>
        <form action="" method="post">
            <h4>Ingrediente a modificar</h4>
            <input type="hidden" name="i" value="ingrediente">
            Producto: <select name = "id" required>
            <?php
            $query = $mysqli -> query("SELECT * FROM ingredientes") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['id_ing'].'">'.$valores['nombre_ing'].'</option>';
            }
            ?>
            </select> <br>
            <h4>Ingrese los datos:</h4>
            nombre: <input type="text" name="nombre" placeholder="Huevo" pattern="[A-Za-z ]+" maxlength="20"
                 title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
            cantidad: <input type="text" name="cant" placeholder="50" pattern="[0-9]+" maxlength="5"
                 title="Por favor, ingresa solo numeros (no letras ni caracteres especiales)." required> <br>
            ultimo abastecimiento: <input type="datetime-local" name="abast" required><br>
            <input type="submit" value="Modificar">
        </form>
        <a href="http://localhost/codes/CRUD-Restaurante/Mod/menu_mod.html">Regresar</a>
    </body>
</html>

<?php
$mysqli->close();
?>