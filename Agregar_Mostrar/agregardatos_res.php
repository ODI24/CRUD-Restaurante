<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularios en PHP</title>
</head>
<body>

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
    <form action="http://localhost/restaurante/cliente_recibirdatos_res.php" method="post">
        nombre: <input type="text" name="nombre"> <br>
        apellido paterno: <input type="text" name="apellido_p"> <br>
        apellido materno: <input type="text" name="apellido_m"> <br>
        telefono: <input type="text" name="celular"> <br>
        <br>
        <input type="submit" value="Ingresar datos">
    </form>
<?php elseif ($formulario == 2): ?>
    <form action="http://localhost/restaurante/personal_recibirdatos_res.php" method="post">
        nombre: <input type="text" name="nombre"> <br>
        apellido: <input type="text" name="apellido"> <br>
        cargo(1-10): <input type="text" name="cargo"> <br>
        username: <input type="text" name="username"> <br>
        password: <input type="text" name="password"> <br>
        <br>
        <input type="submit" value="Ingresar datos">
    </form>
<?php elseif ($formulario == 3): ?>
    <form action="http://localhost/restaurante/orden_recibirdatos_res.php" method="post">
        nombre de mesa(mesa X - p/llevar X): <input type="text" name="nombre"> <br>
        Personas en total (1-X): <input type="text" name="personas_total"> <br>
        total de cuenta: <input type="text" name="total"> <br>
        fecha: <input type="text" name="fecha"> <br>  
        hora: <input type="text" name="hora"> <br>
        Numero de cliente(1-10): <input type="text" name="cliente"> <br>
        Personal atendiendo: <input type="text" name="personal_atendiendo"> <br>
        <br>
        <input type="submit" value="Ingresar datos">
    </form>
<?php elseif ($formulario == 4): ?>
    <form action="http://localhost/restaurante/cargo_recibirdatos_res.php" method="post">
        Nombre del cargo a agregar: <input type="text" name="cargo"> <br>
        <br>
        <input type="submit" value="Ingresar datos">
    </form>
<?php elseif ($formulario == 5): ?>
    <form action="http://localhost/restaurante/ingredientes_recibirdatos_res.php" method="post">
        Nombre del ingrediente: <input type="text" name="nombre"> <br>
        Cantidad actual del ingrediente: <input type="text" name="ingrediente"> <br>
        Ultimo abastecimiento: <input type="text" name="abastecimiento"> <br>
        <br>
        <input type="submit" value="Ingresar datos">
    </form>
<?php elseif ($formulario == 6): ?>
    <form action="http://localhost/restaurante/producto_recibirdatos_res.php" method="post">
        nombre producto: <input type="text" name="nombre"> <br>
        descripcion de producto: <input type="text" name="descripcion"> <br>
        precio a vender: <input type="text" name="precio"> <br>
        <br>
        <input type="submit" value="Ingresar datos">
    </form>
<?php endif; ?>

</body>
</html>
