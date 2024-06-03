<!-- Variable para el ingreso a la bd -->
<?php
$mysqli = new mysqli('localhost', 'root', '','restaurante') or die ("Fallo en la conexion");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularios en PHP</title>
</head>
<body>
    <h1>Agregar datos</h1>

<?php
// Variable para determinar qué formulario mostrar
$formulario = 0;

// Verificar si se seleccionó una opción en el formulario de selección
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['opcion'])) {
    $opcion = $_POST['opcion'];
    // Establecer el formulario a mostrar según la opción seleccionada
    if ($opcion == 'form1') {
        $formulario = 1;
    } elseif ($opcion == 'form2') {
        $formulario = 2;
    } elseif ($opcion == 'form3') {
        $formulario = 3;
    } elseif ($opcion == 'form4') {
        $formulario = 4;
    } elseif ($opcion == 'form5') {
        $formulario = 5;
    } elseif ($opcion == 'form6') {
        $formulario = 6;
    }

}

// Si se envió el formulario secundario, procesar los datos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'])) {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    echo "Nombre: " . $nombre . "<br>";
    echo "Email: " . $email . "<br>";
    exit; // Detener la ejecución para no mostrar los formularios nuevamente
}
?>

<!-- Formulario de selección de opción                              ////////////////////////////////////--> 
<form method="post" action="">
    <label for="opcion">Elija una opción:</label>
    <select id="opcion" name="opcion">
        <option value="form1">Agregar Cliente</option>
        <option value="form2">Agregar Personal</option>
        <option value="form3">Agregar orden</option>
        <option value="form4">Agregar Cargo</option>
        <option value="form5">Agregar Ingredientes</option>
        <option value="form6">Agregar Producto</option>
    </select>
    <br>
    <input type="submit" value="Continuar">
</form>

<!-- Mostrar el formulario seleccionado -->
<?php if ($formulario == 1): ?>
    <form action="cliente_recibirdatos_res.php" method="post">
        nombre: <input type="text" name="nombre" placeholder="Juan" pattern="[A-Za-z ]+" maxlength="20"
            title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
        apellido paterno: <input type="text" name="apellido_p" placeholder="Perez" pattern="[A-Za-z ]+" maxlength="20"
            title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
        apellido materno: <input type="text" name="apellido_m" placeholder="Rodriguez" pattern="[A-Za-z ]+" maxlength="20"
            title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
        telefono: <input type="tel" name="celular" maxlength="10" size="10"
                    placeholder="3325659874" pattern="[1-9]{1}[0-9]{9}" 
                    title="Ingrese un numero de telefono valido (ej. 3325789410)" required> <br>
        <br>
        <input type="submit" value="Ingresar datos">
    </form>
<?php elseif ($formulario == 2): ?>
    <form action="personal_recibirdatos_res.php" method="post">
        nombre: <input type="text" name="nombre" placeholder="Juan" pattern="[A-Za-z ]+" maxlength="20"
            title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
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
        username: <input type="text" name="username" placeholder="RR1" pattern="[A-Z]{2}[0-9]{3}" maxlength="5"
                 title="Por favor, sigue el formato establecido AA111." required> <br>
        password: <input type="password" name="password" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[~!@#$%^&*()_-]).{8,}"
                 title="La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una letra minúscula, un número y un carácter especial." 
                 maxlength="40" required> <br>
        <br>
        <input type="submit" value="Ingresar datos">
    </form>
<?php elseif ($formulario == 3): ?>
    <form action="orden_recibirdatos_res.php" method="post">
        nombre de mesa(mesa X - p/llevar X): <input type="text" name="nombre" 
                placeholder="Mesa 1" pattern="[A-Za-z0-9/# ]+" maxlength="20"
                title="Por favor, ingresa solo letras y numeros (no caracteres especiales excepto '#' y '/')."
                required> <br>
        personas: <input type="number" name="personas_total" placeholder="2" min="1" max="50" required> <br>
        cliente: <select name = "cliente">
            <?php
            $query = $mysqli -> query("SELECT * FROM cliente") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['n_cliente'].'">'.$valores['nombre']." ".$valores['apellido_p'].'</option>';
            }
            ?>
        </select><br>
        personal: <select name = "personal_atendiendo" required>
            <?php
            $query = $mysqli -> query("SELECT * FROM personal WHERE cargo = '1' OR cargo = '7'") or die ("no se puede generar el query");
            while($valores = mysqli_fetch_array($query)) {
                echo '<option value="'.$valores['personal_id'].'">'.$valores['nombre']." ".$valores['apellido'].'</option>';
            }
            ?>
        </select><br>
        <br>
        <input type="submit" value="Ingresar datos">
    </form>
<?php elseif ($formulario == 4): ?>
    <form action="cargo_recibirdatos_res.php" method="post">
        Nombre del cargo a agregar: <input type="text" name="cargo" placeholder="Mesero" 
                pattern="[A-Za-z ]+" maxlength="20"
                title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
        <br>
        <input type="submit" value="Ingresar datos">
    </form>
<?php elseif ($formulario == 5): ?>
    <form action="ingredientes_recibirdatos_res.php" method="post">
        Nombre del ingrediente: <input type="text" name="nombre" placeholder="Tortilla" 
                pattern="[A-Za-z ]+" maxlength="20"
                title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
        Cantidad actual del ingrediente: <input type="text" name="ingrediente" placeholder="50" 
                pattern="[0-9]+" maxlength="5"
                title="Por favor, ingresa solo numeros (no letras ni caracteres especiales)." required> <br>
        Ultimo abastecimiento: <input type="datetime-local" name="abastecimiento"> <br>
        <br>
        <input type="submit" value="Ingresar datos">
    </form>
<?php elseif ($formulario == 6): ?>
    <form action="producto_recibirdatos_res.php" method="post">
        nombre producto: <input type="text" name="nombre" placeholder="Huevo con tortilla" 
                pattern="[A-Za-z ]+" maxlength="20"
                title="Por favor, ingresa solo letras (no numeros ni caracteres especiales)." required> <br>
        descripcion de producto: <input type="text" name="descripcion" 
                placeholder="Huevo preparado con tortilla frita" pattern="[A-Za-z0-9 ]+" maxlength="100"
                title="Por favor, ingresa solo letras o numeros." required> <br>
        precio a vender: <input type="text" name="precio" placeholder="50" pattern="[0-9]+" 
                maxlength="5" size="5"
                title="Por favor, ingresa solo numeros (no letras ni caracteres especiales)." required>
        <br> <br>
        <input type="submit" value="Ingresar datos">
    </form>
<?php endif; ?>

<br> <button id="btn_return" onclick="returnto()">Regresar</button>

<script>
    function returnto() {
        window.location.href = "menu_res.php";
    }
</script>

</body>
</html>
