<html>
    <head>
        <title>Nuevo cliente</title>
    </head>
    <body>
        <?php
        include("conexion.php");
        $db = "restaurante";
        $conexion = conectar($db);

        $nombre = $_REQUEST("nombre");
        $apellido_p = $_REQUEST("apellido_p");
        $apellido_m = $_REQUEST("apellido_m");
        $telefono = $_REQUEST("telefono");

        $ingresar = "CALL add_cliente('$nombre', '$apellido_p', '$apellido_m', '$telefono')";

        $registro = mysqli_query($conexion, $ingresar) or die ("No se pudo ingresar los datos");
        ?>
    </body>
</html>