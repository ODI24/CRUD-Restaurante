<?php
$i = $_REQUEST['i'];

//funcion para eliminar las filas de la tabla cliente seleccionados en del_cliente.php
function del_cliente() {
    global $mysqli;

    $ids = $_REQUEST['id'];

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>n_cliente</th>";
    echo "<th>nombre</th>";
    echo "<th>apellido paterno</th>";
    echo "<th>apellido materno</th>";
    echo "<th>telefono</th>";

    foreach ($ids as $id) {

        $show = "SELECT * FROM cliente WHERE n_cliente = '$id'";

        $res = $mysqli->query($show) or die('No se pudo mostrar');

        while($columna = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>" . $columna['n_cliente'] . "</td><td>" . $columna['nombre'] .
            "</td><td>" . $columna['apellido_p'] . "</td><td>" . $columna['apellido_m'] .
            "</td><td>" . $columna['telefono'] . "</td>";
            echo "</tr>";
        }

        $ins = "DELETE FROM cliente WHERE n_cliente = '$id'";

        $mysqli->query($ins) or die ('No se pudo eliminar');

    }
    echo "</table>";
}

//funcion para eliminar el producto
function del_producto() {
    global $mysqli;

    $ids = $_REQUEST['id'];

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>nombre</th>";
    echo "<th>desc</th>";
    echo "<th>precio</th>";

    foreach ($ids as $id) {

        $show = "SELECT * FROM producto WHERE id_producto = '$id'";

        $res = $mysqli->query($show) or die('No se pudo mostrar');

        while($columna = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>" . $columna['id_producto'] . "</td><td>" . $columna['nombre_producto'] .
            "</td><td>" . $columna['desc_producto'] . "</td><td>" . $columna['precio_producto'] . "</td>";
            echo "</tr>";
        }

        $ins = "CALL delete_producto('$id')";

        $mysqli->query($ins) or die ('No se pudo eliminar');

    }
    echo "</table>";
}


//funcion para modificar el personal
function del_personal() {
    global $mysqli;

    $ids = $_REQUEST['id'];

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>nombre</th>";
    echo "<th>apellido</th>";
    echo "<th>cargo</th>";
    echo "<th>username</th>";
    echo "<th>password</th>";

    foreach ($ids as $id) {

        $show = "SELECT p.*, c.nombre_cargo FROM personal p JOIN cargo c  ON p.cargo = c.pk_cargo
        WHERE personal_id = '$id'";

        $res = $mysqli->query($show) or die('No se pudo mostrar');

        while($columna = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>" . $columna['personal_id'] . "</td><td>" . $columna['nombre'] .
            "</td><td>" . $columna['apellido'] . "</td><td>" . $columna['nombre_cargo'] .
            "</td><td>" . $columna['username'] . "</td><td>" . $columna['password'] . "</td>";
            echo "</tr>";
        }

        $ins = "DELETE FROM personal WHERE personal_id = '$id'";

        $mysqli->query($ins) or die ('No se pudo eliminar');
    }
    echo "</table>";
}


function del_ing() {
    global $mysqli;

    $ids = $_REQUEST['id'];

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>nombre</th>";
    echo "<th>cantidad</th>";
    echo "<th>ultimo abastecimiento</th>";

    foreach ($ids as $id) {

        $show = "SELECT * FROM ingredientes WHERE id_ing = '$id'";

        $res = $mysqli->query($show) or die('No se pudo mostrar');

        while($columna = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>" . $columna['id_ing'] . "</td><td>" . $columna['nombre_ing'] .
            "</td><td>" . $columna['cantidad_ing'] . "</td><td>" . $columna['ultimo_abastecimiento'] ."</td>";
            echo "</tr>";
        }

        $ins = "DELETE FROM ingredientes WHERE id_ing = '$id'";

        $mysqli->query($ins) or die ('No se pudo eliminar');

    }
    echo "</table>";
}

function del_orden() {
    global $mysqli;

    $ids = $_REQUEST['id'];

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>nombre</th>";
    echo "<th># de personas</th>";

    foreach ($ids as $id) {

        $show = "SELECT * FROM ordenar WHERE id = '$id'";

        $res = $mysqli->query($show) or die('No se pudo mostrar');

        while($columna = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>" . $columna['id'] . "</td><td>" . $columna['nombre'] .
            "</td><td>" . $columna['personas'] . "</td>";
            echo "</tr>";
        }

        $ins = "DELETE FROM ordenar WHERE id = '$id'";

        $mysqli->query($ins) or die ('No se pudo eliminar');

    }
    echo "</table>";
}

function del_po() {
    global $mysqli;

    $id = $_REQUEST["id"];
    $id_ps = $_REQUEST["id_p"];

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>orden</th>";
    echo "<th>producto</th>";

    foreach ($id_ps as $id_p) {
        $ins = "CALL delete_po ('$id', '$id_p')";

        $show = "SELECT o.nombre, pr.nombre_producto FROM pedir p JOIN ordenar o ON o.id = p.orden 
        JOIN producto pr ON pr.id_producto = p.producto WHERE p.orden = '$id'";

        $res = $mysqli->query($show) or die ("No se pudo mostrar");

        while($columna = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>" . $columna['nombre'] . "</td><td>" . $columna['nombre_producto'] ."</td>";
            echo "</tr>";
        }

        $mysqli->query($ins) or die ("No se pudo eliminar");
    }

    echo "</table>";
}


//ip -> ingrediente producto// del_ip() es la funcion para eliminar un ingrediente de un producto
function del_ip() {
    global $mysqli;

    $id = $_REQUEST["id"];
    $id_is = $_REQUEST["id_i"];

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>producto</th>";
    echo "<th>ingrediente</th>";

    foreach ($id_is as $id_i) {
        $ins = "CALL delete_ip ('$id', '$id_i')";

        $mysqli->query($ins) or die ("No se pudo eliminar");
    }

    $show = "SELECT p.nombre_producto, i.nombre_ing FROM preparar_receta pr JOIN producto p 
    ON pr.id_producto = p.id_producto JOIN ingredientes i ON pr.id_ing = i.id_ing WHERE pr.id_producto = '$id'";

    $res = $mysqli->query($show) or die ("No se pudo mostrar");

    while($columna = mysqli_fetch_array($res)) {
        echo "<tr>";
        echo "<td>" . $columna['nombre_producto'] . "</td><td>" . $columna['nombre_ing'] ."</td>";
        echo "</tr>";
    }

    echo "</table>";
}

//switch para determinar cual función realizar
switch($i) {
    case 'cliente': 
        del_cliente();
    break;
    case 'producto': 
        del_producto();
    break;
    case 'personal': 
        del_personal();
    break;
    case 'ingrediente':
        del_ing();
    break;
    case 'orden':
        del_orden();
    break;
    case 'po':
        del_po();
    break;
    case 'ip':
        del_ip();
    break;
}

?>