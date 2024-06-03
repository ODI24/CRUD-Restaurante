<html>
    <body>
        <?php
        $Nombre = $_REQUEST['nombre'];
        $Personas =  $_REQUEST['personas_total'];
        $Total =  $_REQUEST['total'];
        $Fecha = $_REQUEST['fecha'];
        $Hora =  $_REQUEST['hora'];
        $Cliente =  $_REQUEST['cliente'];
        $Personal = $_REQUEST['personal_atendiendo'];
        

        $conexion = mysqli_connect("localhost", "root", "") or die ("1-No se ha 
        podido conectar al servidor de Base de Datos"); 
        $db = mysqli_select_db($conexion, "restaurante2") or die ("2- Upps! No se pudo realizar la conexion");

        $consulta = "SELECT * FROM ordenar";
        $imprimir = mysqli_query($conexion, $consulta) or die ("3- Algo ha ido mal en la consulta a la base de datos");

        $consultainsertar = "INSERT INTO ordenar (nombre,personas,total, fecha,hora,cliente,personal) VALUES ('$Nombre', '$Personas', '$Total', '$Fecha', '$Hora', '$Cliente', '$Personal')";
        
        if (mysqli_query($conexion, $consultainsertar)) {
            echo "Datos insertados correctamente.<br>";
        } else {
            die("Error al insertar los datos: " . mysqli_error($conexion));
        }

        mysqli_close($conexion);

        ?>
    </body>
</html>