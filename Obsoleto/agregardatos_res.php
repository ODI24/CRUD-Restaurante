<?php
$mysqli = new mysqli('localhost', 'root', '', 'restaurante2') or die("Fallo en la Conexion");
?>
<html>
<head>
<?php
$titulo = "Registro de Clientes";
print "<h1>$titulo</h1>"; //nivel de encabez
?>

<meta charset= "utf-8" />
</head>
<body>
    <form action="http://localhost/A_recibirdatos_res.php" method = "post">
            nombre: <input type="text" name="nombre"> <br>
            apellido paterno: <input type="text" name="apellido_p"> <br>
            apellido materno: <input type="text" name="apellido_m"> <br>
            telefono: <input type="text" name="celular"> <br>

                <br>
        <input type="submit" value="Ingresar datos">
        </form>


    </body>
</html>
