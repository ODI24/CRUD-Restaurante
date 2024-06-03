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
            <h4>Cargo a modificar</h4>
            <input type="hidden" name="i" value="cargo">
            Cargo: <select name = "id" required>
            <?php
            $query = $mysqli -> query("SELECT * FROM cargo") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['pk_cargo'].'">'.$valores['nombre_cargo'].'</option>';
            }
            ?>
            </select> <br>
            <h4>Ingrese los datos:</h4>
            nombre: <input type="text" name="nombre" placeholder="Mesero" pattern="[A-Za-z ]+" maxlength="20"
                 title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
            <input type="submit" value="Modificar">
        </form>
        
        <br>
        <button id="btn_return" onclick="returntoMenu()">Regresar</button>

        <script>
            function returntoMenu() {
                window.location.href = "menu_mod.html";
            }
        </script>
    </body>
</html>

<?php
$mysqli->close();
?>