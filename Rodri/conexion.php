<?php

function conectar ($passed) {
    $user = "root";
    $pass = "";
    $server = "localhost";
    $db = $passed;
    $con = mysqli_connect($server, $user, $pass) or die ("Error al conectar a la base de datos");
    mysqli_select_db($con, $db) or die ("Ups! no se pudo acceder a la DB");

    return $con;
}