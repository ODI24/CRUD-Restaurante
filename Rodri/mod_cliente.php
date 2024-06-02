<html>
    <head>
        <title>Modificar cliente</title>
    </head>
    <body>
        <!-- Empezamos a generar las consultas -->
        <?php
        $id = $_REQUEST['cliente'];
        ?>
        <form action="show.php" method="post">
            <input type="hidden" name="i" value="cliente">
            <?php
            echo '<input type="hidden" name="id" value="'. $id . '">';
            ?>
            nombre: <input type="text" name="nombre"> <br>
            apellido paterno: <input type="text" name="paterno"> <br>
            apellido materno: <input type="text" name="materno"> <br>
            <input type="submit" value="Modificar">
        </form>
    </body>
</html>