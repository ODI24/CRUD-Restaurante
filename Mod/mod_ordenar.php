<!-- Variable para el ingreso a la bd -->
<?php
$mysqli = new mysqli('localhost', 'root', '','restaurante') or die ("Fallo en la conexion");
?>

<html>
    <head>
        <title>Modificar Orden</title>
    </head>
    <body>
        <h1>Modificar Orden</h1>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['i'])) {
                echo '<h3>Datos Modificados :</h3>';
                include ('show_mod.php');
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
            <h4>Ingrese los datos:</h4>
            nombre: <input type="text" name="nombre" placeholder="Mesa 1" pattern="[A-Za-z0-9 ]+" maxlength="20"
                 title="Por favor, ingresa solo letras y numeros (no caracteres especiales)." required> <br>
            personas: <input type="number" name="personas" placeholder="2" min="1" max="50" required> <br> 
            <input type="submit" value="Modificar">
        </form>
        <a href="http://localhost/codes/CRUD-Restaurante/Mod/menu_mod.html">Regresar</a>
    </body>
</html>

<?php
$mysqli->close();
?>