<html>
    <body>
        <?php
        $NombreProducto = $_REQUEST['nombre'];
        $DescripcionProducto =  $_REQUEST['descripcion'];
        $Precio =  $_REQUEST['precio'];
        

        $conexion = mysqli_connect("localhost", "root", "") or die ("1-No se ha 
        podido conectar al servidor de Base de Datos"); 
        $db = mysqli_select_db($conexion, "restaurante2") or die ("2- Upps! No se pudo realizar la conexion");

        $consulta = "SELECT * FROM producto";
        $imprimir = mysqli_query($conexion, $consulta) or die ("3- Algo ha ido mal en la consulta a la base de datos");

        $consultainsertar = "INSERT INTO producto (nombre_producto,desc_producto,precio_producto) VALUES ('$NombreProducto', '$DescripcionProducto', '$Precio')";
        
        if (mysqli_query($conexion, $consultainsertar)) {
            echo "Datos insertados correctamente.<br>";
        } else {
            die("Error al insertar los datos: " . mysqli_error($conexion));
        }

        mysqli_close($conexion);

        ?>
    </body>
</html>