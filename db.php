<?php
function conexion()
{
    $host = "localhost";
    $user = "root";
    $pass = "";

    $db = "tareas_db";

    $connect = mysqli_connect($host, $user, $pass);

    mysqli_select_db($connect, $db);

    return $connect;
};

