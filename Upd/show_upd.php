<?php
$i = $_REQUEST['i'];

function upd_abast() {
    global $mysqli;

    $id = $_REQUEST['id'];
    $cant = $_REQUEST['cant'];
    $abast = $_REQUEST['abast'];
    

    $ins = "UPDATE ingredientes SET cantidad_ing = '$cant', ultimo_abastecimiento = '$abast' WHERE id_ing = '$id'";

    $mysqli->query($ins) or die ('No se pudo actualizar');

    $show = "SELECT * FROM ingredientes WHERE id_ing = $id";

    $res = $mysqli->query($show) or die('No se pudo mostrar');

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>nombre</th>";
    echo "<th>cantidad</th>";
    echo "<th>ultimo abastecimiento</th>";

    while($columna = mysqli_fetch_array($res)) {
        echo "<tr>";
        echo "<td>" . $columna['id_ing'] . "</td><td>" . $columna['nombre_ing'] .
        "</td><td>" . $columna['cantidad_ing'] . "</td><td>" . $columna['ultimo_abastecimiento']. "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

function upd_orden() {
    global $mysqli;

    $id = $_REQUEST["id"];
    $id_ps = $_REQUEST["id_p"];

    foreach ($id_ps as $id_p) {
        $ins = "CALL add_producto_orden ('$id', '$id_p')";

        $mysqli->query($ins) or die ("No se pudo anadir");
    }

    $show = "SELECT o.nombre, pr.nombre_producto FROM pedir p JOIN ordenar o ON o.id = p.orden 
    JOIN producto pr ON pr.id_producto = p.producto WHERE p.orden = '$id'";

    $res = $mysqli->query($show) or die ("No se pudo mostrar");

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>orden</th>";
    echo "<th>producto</th>";

    while($columna = mysqli_fetch_array($res)) {
        echo "<tr>";
        echo "<td>" . $columna['nombre'] . "</td><td>" . $columna['nombre_producto'] ."</td>";
        echo "</tr>";
    }

    echo "</table>";
}

function upd_producto() {
    global $mysqli;

    $id = $_REQUEST["id"];
    $id_is = $_REQUEST["id_i"];

    foreach ($id_is as $id_i) {
        $ins = "CALL add_ing_preparacion ('$id', '$id_i')";

        $mysqli->query($ins) or die ("No se pudo anadir");
    }

    $show = "SELECT p.nombre_producto, i.nombre_ing FROM preparar_receta pr JOIN producto p 
    ON pr.id_producto = p.id_producto JOIN ingredientes i ON pr.id_ing = i.id_ing WHERE pr.id_producto = '$id'";

    $res = $mysqli->query($show) or die ("No se pudo mostrar");

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>producto</th>";
    echo "<th>ingrediente</th>";

    while($columna = mysqli_fetch_array($res)) {
        echo "<tr>";
        echo "<td>" . $columna['nombre_producto'] . "</td><td>" . $columna['nombre_ing'] ."</td>";
        echo "</tr>";
    }

    echo "</table>";
}

//switch para determinar cual función realizar
switch($i) {
    case 'abast': 
        upd_abast();
    break;
    case 'orden': 
        upd_orden();
    break;
    case 'producto': 
        upd_producto();
    break;
}

?>