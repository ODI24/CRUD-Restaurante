<html>
    <body>
        <?php
        $Nombre = $_REQUEST['nombre'];
        $Ingrediente =  $_REQUEST['ingrediente'];
        $Abastecimiento =  $_REQUEST['abastecimiento'];
        

        $conexion = mysqli_connect("localhost", "root", "") or die ("1-No se ha 
        podido conectar al servidor de Base de Datos"); 
        $db = mysqli_select_db($conexion, "restaurante2") or die ("2- Upps! No se pudo realizar la conexion");

        $consulta = "SELECT * FROM ingredientes";
        $imprimir = mysqli_query($conexion, $consulta) or die ("3- Algo ha ido mal en la consulta a la base de datos");

        $consultainsertar = "INSERT INTO ingredientes (nombre_ing,cantidad_ing,ultimo_abastecimiento) VALUES ('$Nombre', '$Ingrediente', '$Abastecimiento')";
        
        if (mysqli_query($conexion, $consultainsertar)) {
            echo "Datos insertados correctamente.<br>";
        } else {
            die("Error al insertar los datos: " . mysqli_error($conexion));
        }

        mysqli_close($conexion);

        ?>
    </body>
</html>