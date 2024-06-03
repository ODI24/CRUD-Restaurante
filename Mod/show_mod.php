<?php
// include ("conexion.php");
// $db = "restaurante";
// $con = conectar($db);

//conexion con la base de datos restaurante (ya no es necesaria la conexion se crea desde el mod)
//$mysqli = new mysqli('localhost', 'root', '','restaurante') or die ("Fallo en la conexion");

//conseguimos el valor i que representa desde que mod se esta llamando este archivo
$i = $_REQUEST['i'];

//funcion para modificar la fila de la tabla cliente con los datos ingresados en mod_cliente
function mod_cliente() {
    global $mysqli;

    $id = $_REQUEST['id'];
    $nombre = $_REQUEST['nombre'];
    $ape_p = $_REQUEST['paterno'];
    $ape_m = $_REQUEST['materno'];
    $tel = $_REQUEST['telephone'];
    

    $ins = "UPDATE cliente SET nombre = '$nombre', apellido_p = '$ape_p', apellido_m = '$ape_m',
    telefono = '$tel' WHERE n_cliente = '$id'";

    $mysqli->query($ins) or die ('No se pudo modificar');

    $show = "SELECT * FROM cliente WHERE n_cliente = $id";

    $res = $mysqli->query($show) or die('No se pudo mostrar');

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>n_cliente</th>";
    echo "<th>nombre</th>";
    echo "<th>apellido paterno</th>";
    echo "<th>apellido materno</th>";
    echo "<th>telefono</th>";

    while($columna = mysqli_fetch_array($res)) {
        echo "<tr>";
        echo "<td>" . $columna['n_cliente'] . "</td><td>" . $columna['nombre'] .
        "</td><td>" . $columna['apellido_p'] . "</td><td>" . $columna['apellido_m'] .
        "</td><td>" . $columna['telefono'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

//funcion para modificar el producto
function mod_producto() {
    global $mysqli;

    $id = $_REQUEST['id'];
    $nombre = $_REQUEST['nombre'];
    $desc = $_REQUEST['desc'];
    $precio = $_REQUEST['precio'];
    

    $ins = "UPDATE producto SET nombre_producto = '$nombre', desc_producto = '$desc', precio_producto = '$precio'
    WHERE id_producto = '$id'";

    $mysqli->query($ins) or die ('No se pudo modificar');

    $show = "SELECT * FROM producto WHERE id_producto = $id";
    
    $res = $mysqli->query($show) or die ('No se pudo mostrar');

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>nombre</th>";
    echo "<th>descripcion</th>";
    echo "<th>precio</th>";

    while($columna = mysqli_fetch_array($res)) {
        echo "<tr>";
        echo "<td>" . $columna['id_producto'] . "</td><td>" . $columna['nombre_producto'] .
        "</td><td>" . $columna['desc_producto'] . "</td><td>" . $columna['precio_producto'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}


//funcion para modificar el personal
function mod_personal() {
    global $mysqli;

    $id = $_REQUEST['id'];
    $nombre = $_REQUEST['nombre'];
    $apellido = $_REQUEST['apellido'];
    $cargo = $_REQUEST['cargo'];
    $username = $_REQUEST['usr'];
    $password = $_REQUEST['psw'];
    
    
    $ins = "UPDATE personal SET nombre = '$nombre', apellido = '$apellido', cargo = '$cargo',
    username = '$username', password = SHA2('$password',256) WHERE personal_id = '$id'";
    $mysqli->query($ins) or die ('No se pudo modificar');

    $show = "SELECT p.*, c.nombre_cargo FROM personal as p JOIN cargo as c ON p.cargo = c.pk_cargo WHERE personal_id = $id";
    $res = $mysqli->query($show) or die ('No se puede mostrar');

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>nombre</th>";
    echo "<th>apellido</th>";
    echo "<th>cargo</th>";
    echo "<th>username</th>";
    echo "<th>password</th>";

    while($columna = mysqli_fetch_array($res)) {
        echo "<tr>";
        echo "<td>" . $columna['personal_id'] . "</td><td>" . $columna['nombre'] .
        "</td><td>" . $columna['apellido'] . "</td><td>" . $columna['nombre_cargo'] .
        "</td><td>" . $columna['username'] . "</td><td>" . $columna['password'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}


function mod_ing() {
    global $mysqli;

    $id = $_REQUEST['id'];
    $nombre = $_REQUEST['nombre'];
    $cant = $_REQUEST['cant'];
    $abast = $_REQUEST['abast'];
    
    
    $ins = "UPDATE ingredientes SET nombre_ing = '$nombre', cantidad_ing = '$cant', ultimo_abastecimiento = '$abast'
    WHERE id_ing = '$id'";
    $mysqli->query($ins) or die ('No se pudo modificar');

    $show = "SELECT * FROM ingredientes WHERE id_ing = $id";
    $res = $mysqli->query($show) or die ('No se puede mostrar');

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>nombre</th>";
    echo "<th>cantidad</th>";
    echo "<th>ultimo abastecimiento</th>";

    while($columna = mysqli_fetch_array($res)) {
        echo "<tr>";
        echo "<td>" . $columna['id_ing'] . "</td><td>" . $columna['nombre_ing'] .
        "</td><td>" . $columna['cantidad_ing'] . "</td><td>" . $columna['ultimo_abastecimiento'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

function mod_orden() {
    global $mysqli;

    $id = $_REQUEST['id'];
    $nombre = $_REQUEST['nombre'];
    $cant = $_REQUEST['personas'];
    
    
    $ins = "UPDATE ordenar SET nombre = '$nombre', personas = '$cant' WHERE id = '$id'";
    $mysqli->query($ins) or die ('No se pudo modificar');

    $show = "SELECT * FROM ordenar WHERE id = $id";
    $res = $mysqli->query($show) or die ('No se puede mostrar');

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>nombre</th>";
    echo "<th># de personas</th>";

    while($columna = mysqli_fetch_array($res)) {
        echo "<tr>";
        echo "<td>" . $columna['id'] . "</td><td>" . $columna['nombre'] .
        "</td><td>" . $columna['personas'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

function mod_cargo() {
    global $mysqli;

    $id = $_REQUEST['id'];
    $nombre = $_REQUEST['nombre'];
    
    $ins = "UPDATE cargo SET nombre_cargo = '$nombre' WHERE pk_cargo = '$id'";
    $mysqli->query($ins) or die ('No se pudo modificar');

    $show = "SELECT * FROM cargo WHERE pk_cargo = $id";
    $res = $mysqli->query($show) or die ('No se puede mostrar');

    echo "<table border = '2'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>nombre del cargo</th>";

    while($columna = mysqli_fetch_array($res)) {
        echo "<tr>";
        echo   "<td>" . $columna['pk_cargo'] . "</td>
                <td>" . $columna['nombre_cargo'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

//switch para determinar cual función realizar
switch($i) {
    case 'cliente': 
        mod_cliente();
    break;
    case 'producto': 
        mod_producto();
    break;
    case 'personal': 
        mod_personal();
    break;
    case 'ingrediente':
        mod_ing();
    break;
    case 'orden':
        mod_orden();
    break;
    case 'cargo':
        mod_cargo();
    break;
}

?>