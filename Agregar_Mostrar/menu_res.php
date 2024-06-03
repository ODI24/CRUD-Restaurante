<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verificar si se ha seleccionado una opción
    if (isset($_GET['option']) && !empty($_GET['option'])) {
        $selectedOption = $_GET['option'];
        // Redirigir a la opción seleccionada
        header("Location: $selectedOption");
        exit();
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $titulo = "CRUD";
    print "<h1>$titulo</h1>"; //nivel de encabez
    ?>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
        <label for="options">Escoge una opción:</label>
        <select id="options" name="option">
            <option value="">--Selecciona una opción--</option>
            <option value="agregardatos_res.php"> Insertar Cliente</option>
            <option value="archivo2.php"> Eliminar Cliente</option>
            <option value="archivo33333.php"> Modificar datos</option>
            <option value="mostrardatos_res.php"> Mostrar datos</option>
        </select>
        <button type="submit">Ir</button>
    </form>
</body>
</html>