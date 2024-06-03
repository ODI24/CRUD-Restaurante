<!-- Variable para el ingreso a la bd -->
<?php
$mysqli = new mysqli('localhost', 'root', '','restaurante') or die ("Fallo en la conexion");
?>

<html>
    <head>
        <title>Modificar producto</title>
    </head>
    <body>
        <h1>Modificar Personal</h1>
        <?php
        //Solo se va a ejecutar este codigo si ya se ha hecho un POST y el dato i ya se declaro
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['i'])) {
                echo '<h3>Datos Modificados :</h3>';
                include ('show_mod.php');
                echo '<br>';
            }
        ?>
        <form action="" method="post">
            <input type="hidden" name="i" value="personal">
            <h4>Personal a modificar</h4><br>
            <select name = "id" required>
            <?php
            $query = $mysqli -> query("SELECT * FROM personal") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['personal_id'].'">'.$valores['nombre']. " " . 
                $valores['apellido'] .'</option>';
            }
            ?>
            </select> <br><br>
            <h4>Ingrese los datos:</h4>
            nombre: <input id="nom_in" type="text" name="nombre" placeholder="Juan" pattern="[A-Za-z ]+" maxlength="20"
                 title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required><br>
            apellido: <input type="text" name="apellido" placeholder="Perez" pattern="[A-Za-z ]+" maxlength="20"
                 title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
            cargo: <select name = "cargo" required>
            <?php
            $query = $mysqli -> query("SELECT * FROM cargo") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['pk_cargo'].'">'.$valores['nombre_cargo'].'</option>';
            }
            ?>
            </select> <br>
            username: <input type="text" name="usr" placeholder="RR1" pattern="[A-Z]{2}[0-9]{3}" maxlength="5"
                 title="Por favor, sigue el formato establecido AA111." required><br>
            password: <input type="password" name="psw" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[~!@#$%^&*()_-]).{8,}"
                 title="La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una letra minúscula, un número y un carácter especial." 
                 maxlength="40" required><br>
            <input type="submit" value="Modificar">
        </form>

        <a href="http://localhost/codes/CRUD-Restaurante/Mod/menu_mod.html">Regresar</a>
    </body>
</html>

<?php
$mysqli->close();
?>