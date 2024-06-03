<html>
    <body>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="tabla">Selecciona una tabla:</label>
            <select name="tabla">
                <option value="cliente">Cliente</option>
                <option value="producto">Producto</option>
                <option value="personal">Personal</option>
                <option value="pedido_mesa">Pedido por mesa</option>
                <option value="cargo">Cargos existentes</option>
                <option value="ingredientes">Ingredientes disponibles</option>
                <option value="ordenar">Ordenes disponibles</option>
                
            </select>
            <input type="submit" value="Consultar">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tabla = $_POST['tabla'];
            $conexion = mysqli_connect("localhost", "root", "") or die ("1-No se ha podido conectar al servidor de Base de Datos");
            $db = mysqli_select_db($conexion, "restaurante") or die ("2- Upps! No se pudo realizar la conexion");

            if ($tabla == "pedido_mesa") {
                $consulta_pedidos = "SELECT producto.nombre_producto AS Producto_pedido, ordenar.nombre AS Mesa 
                                     FROM pedir
                                     INNER JOIN producto ON producto.id_producto = pedir.producto
                                     INNER JOIN ordenar ON ordenar.id = pedir.orden;";
                echo "Consulta SQL: " . $consulta_pedidos; // Depuración
                $imprimir_pedidos = mysqli_query($conexion, $consulta_pedidos) or die ("3- Algo ha ido mal en la consulta a la base de datos: " . mysqli_error($conexion));
            } else {
                $consulta = "SELECT * FROM $tabla";
                echo "Consulta SQL: " . $consulta; // Depuración
                $imprimir = mysqli_query($conexion, $consulta) or die ("3- Algo ha ido mal en la consulta a la base de datos: " . mysqli_error($conexion));
            }

            if ($tabla == "cliente")
            {
                

                echo "<table border='2'>";
                echo "<tr>";
                echo "<th>Nombre</th>";
                echo "<th>Apellido Paterno</th>";
                echo "<th>Apellido Materno</th>";
                echo "<th>Telefono</th>";
                echo "</tr>";
    
                while ($columna = mysqli_fetch_array($imprimir)) {
                   echo "<tr>";
                   echo "<td>" . $columna['nombre'] . "</td>
                   <td>" . $columna['apellido_p'] . "</td>
                   <td>" . $columna['apellido_m'] . "</td>
                   <td>" . $columna['telefono'] . "</td>";
                   echo "</tr>";
                }
                echo "</table>";
            }
            if ($tabla == "producto")
            {
                echo "<table border='2'>";
                echo "<tr>";
                echo "<th>Nombre producto</th>";
                echo "<th>Descripcion</th>";
                echo "<th>Precio</th>";
                echo "</tr>";
    
                while ($columna = mysqli_fetch_array($imprimir)) {
                   echo "<tr>";
                   echo "<td>" . $columna['nombre_producto'] . "</td>
                        <td>" . $columna['desc_producto'] . "</td>
                        <td>" . $columna['precio_producto'] . "</td>";
                   echo "</tr>";
                }
                echo "</table>";
            }
            if ($tabla == "personal")
            {
                echo "<table border='2'>";
                echo "<tr>";
                echo "<th>Nombre</th>";
                echo "<th>Apellido </th>";
                echo "<th>Username</th>";
                echo "<th>Password</th>";
                
                echo "</tr>";
    
                while ($columna = mysqli_fetch_array($imprimir)) {
                   echo "<tr>";
                   echo "<td>" . $columna['nombre'] . "</td>
                        <td>" . $columna['apellido'] . "</td>
                        <td>" . $columna['username'] . "</td>
                        <td>" . $columna['password'] . "</td>";
                   echo "</tr>";
                }
                echo "</table>";
            }
            if ($tabla == "pedido_mesa") {
                echo "<table border='2'>";
                echo "<tr>";
                echo "<th>Producto Pedido</th>";
                echo "<th>Mesa</th>";
                echo "</tr>";

                while ($columna = mysqli_fetch_array($imprimir_pedidos)) {
                    echo "<tr>";
                    echo "<td>" . $columna['Producto_pedido'] . "</td>";
                    echo "<td>" . $columna['Mesa'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            if ($tabla == "cargo")
            {
                echo "<table border='2'>";
                echo "<tr>";
                echo "<th> Cargos existentes </th>";
                echo "</tr>";
    
                while ($columna = mysqli_fetch_array($imprimir)) {
                   echo "<tr>";
                   echo "<td>" . $columna['nombre_cargo'] ."</td>";
                   echo "</tr>";
                }
                echo "</table>";
            }
            if ($tabla == "ingredientes")
            {
                echo "<table border='2'>";
                echo "<tr>";
                echo "<th> Ingrediente </th>";
                echo "<th> Cantidad disponible </th>" ;
                echo "</tr>";
    
                while ($columna = mysqli_fetch_array($imprimir)) {
                   echo "<tr>";
                   echo "<td>" . $columna['nombre_ing'] ."</td>";
                   echo "<td>" . $columna['cantidad_ing'] ."</td>";
                   echo "</tr>";
                }
                echo "</table>";
            }
            if ($tabla == "ordenar")
            {
                echo "<table border='2'>";
                echo "<tr>";
                echo "<th> Num Mesa </th>";
                echo "<th> Personas </th>";
                echo "<th> Total Cuenta </th>";
                echo "<th> Fecha </th>";
                echo "<th> Cliente </th>";
                echo "<th> Num de Personal atendiendo </th>" ;
                echo "</tr>";
    
                while ($columna = mysqli_fetch_array($imprimir)) {
                   echo "<tr>";
                   echo "<td>" . $columna['nombre'] ."</td>";
                   echo "<td>" . $columna['personas'] ."</td>";
                   echo "<td>" . $columna['total'] ."</td>";
                   echo "<td>" . $columna['fecha'] ."</td>";
                   echo "<td>" . $columna['hora'] ."</td>";
                   echo "<td>" . $columna['cliente'] ."</td>";
                   echo "<td>" . $columna['personal'] ."</td>";
                   echo "</tr>";
                }
                echo "</table>";
            }
        }
        ?>

        <br> <button id="btn_return" onclick="returnto()">Regresar</button>

        <script>
            function returnto() {
                window.location.href = "menu_res.php";
            }
        </script>
    </body>
</html>
