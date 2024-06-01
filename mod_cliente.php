<html>
    <head>
        <title>Modificar cliente</title>
    </head>
    <body>
        <!-- Empezamos a generar las consultas -->
        <?php
        include("conexion.php");
        $db = "restaurante";
        $conexion = conectar($db);

        $id = $_REQUEST("n_cliente");

        $registro = mysqli_query($conexion, $ingresar) or die ("No se pudo ingresar los datos");
        ?>
        <form>

        </form>
    </body>
</html>