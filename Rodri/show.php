<?
include ("conexion.php");
$db = "restaurante";
$con = conectar($db);


$i = $_REQUEST['i'];


switch($i) {
    case 'cliente': 
        mod_cliente();
    break;
}


function mod_cliente() {
    global $con;

    $id = $_REQUEST['id'];
    $nombre = $_REQUEST['nombre'];
    $ape_p = $_REQUEST['paterno'];
    $ape_m = $_REQUEST['materno'];
    

    $ins = "UPDATE cliente SET nombre = $nombre, apellido_p = $ape_p, apellido_m = $ape_m WHERE
            n_cliente = $id";
    $mod = mysqli_query($con, $ins) or die ('No se pudo modificar');

    $show = "SELECT * FROM cliente WHERE n_cliente = $id";
    $res = mysqli_query($con, $show) or die ('No se puede mostrar');

    echo "<table borde = '2'>";
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


    mysqli_close($con);
}

?>