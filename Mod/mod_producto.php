<!-- Variable para el ingreso a la bd -->
<?php
$mysqli = new mysqli('localhost', 'root', '','restaurante') or die ("Fallo en la conexion");
?>

<html>
    <head>
        <title>Modificar producto</title>
    </head>
    <body>
        <h1>Modificar Producto</h1>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['i'])) {
                echo '<h3>Datos Modificados :</h3>';
                include ('show_mod.php');
                echo '<br>';
            }
        ?>
        <form action="" method="post">
            <h4>Producto a modificar</h4>
            <input type="hidden" name="i" value="producto">
            Producto: <select name = "id" required>
            <?php
            $query = $mysqli -> query("SELECT * FROM producto") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['id_producto'].'">'.$valores['nombre_producto'].'</option>';
            }
            ?>
            </select> <br>
            <h4>Ingrese los datos:</h4>
            nombre: <input type="text" name="nombre" placeholder="Huevo con tortilla" pattern="[A-Za-z ]+" maxlength="20"
                 title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
            descripcion: <input type="text" name="desc" placeholder="Huevo preparado con tortilla frita" pattern="[A-Za-z0-9 ]+" maxlength="100"
                 title="Por favor, ingresa solo letras o numeros." required> <br>
            precio: <input type="text" name="precio" placeholder="50" pattern="[0-9]+" maxlength="5" size="5"
                 title="Por favor, ingresa solo numeros (no letras ni caracteres especiales)." required><br>
            <input type="submit" value="Modificar">
        </form>

        <a href="http://localhost/codes/CRUD-Restaurante/Mod/menu_mod.html">Regresar</a>
    </body>
</html>

<?php
$mysqli->close();
?>