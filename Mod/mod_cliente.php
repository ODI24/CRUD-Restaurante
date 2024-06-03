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
            <h4>Cliente a modificar</h4>
            cliente: <select name = "id" required>
            <?php
            $query = $mysqli -> query("SELECT * FROM cliente") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['n_cliente'].'">'.$valores['nombre']." ".$valores['apellido_p'].'</option>';
            }
            ?>
            </select> <br>
            <h4>Ingrese los datos:</h4>
            nombre: <input type="text" name="nombre" placeholder="Juan" pattern="[A-Za-z ]+" maxlength="20"
                 title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
            apellido paterno: <input type="text" name="paterno" placeholder="Perez" pattern="[A-Za-z ]+" maxlength="20"
                 title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
            apellido materno: <input type="text" name="materno" placeholder="Rodriguez" pattern="[A-Za-z ]+" maxlength="20"
                 title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
            telefono: <input type="tel" name="telephone" maxlength="10" size="10"
                    placeholder="3325659874" pattern="[1-9]{1}[0-9]{9}" 
                    title="Ingrese un numero de telefono valido" required><br>
            <input type="submit" value="Modificar">
        </form>

        <a href="http://localhost/codes/CRUD-Restaurante/Mod/menu_mod.html">Regresar</a>
    </body>
</html>

<?php
$mysqli->close();
?>