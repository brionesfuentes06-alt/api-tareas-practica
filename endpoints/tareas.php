<?php
include "db.php";
$con = conexion();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {


    $id = $_GET['id'];

    if ($id != null) {
        $sql = "SELECT * FROM tareas WHERE id='$id'";
    } else {
        $sql = "SELECT * FROM tareas";
    }

    $query = mysqli_query($con, $sql);

    $data = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    echo json_encode($data);
} elseif ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $id = null;
    $titulo = $input['titulo'];
    $descripcion = $input['descripcion'];
    $estado = $input['estado'];
    $fecha_creacion = $input['fecha_creacion'];
    $fecha_vencimiento = $input['fecha_vencimiento'];

    $sql  = "INSERT INTO tareas (titulo, descripcion, estado, fecha_creacion, fecha_vencimiento) 
        VALUES ('$titulo', '$descripcion', '$estado', '$fecha_creacion', '$fecha_vencimiento')";

    $query = mysqli_query($con, $sql);

    if ($query) {
        http_response_code(201);
        echo json_encode(["Mensaje" => "Tarea creada correctamente", "Tarea" => $input]);
    } else {
        http_response_code(500);
        echo json_encode(["Error" => "Error al crear Tarea"]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = json_decode(file_get_contents('php://input'), true);

    $id = $_GET['id'];


    $titulo = $input['titulo'];
    $descripcion = $input['descripcion'];
    $estado = $input['estado'];
    $fecha_creacion = $input['fecha_creacion'];
    $fecha_vencimiento = $input['fecha_vencimiento'];

    $sql = "UPDATE tareas SET 
    titulo='$titulo', 
    descripcion='$descripcion', 
    estado='$estado', 
    fecha_creacion='$fecha_creacion', 
    fecha_vencimiento='$fecha_vencimiento' 
    WHERE id='$id'";

    $query = mysqli_query($con, $sql);

    if ($query) {
        http_response_code(200);
        echo json_encode(["Mensaje" => "Tarea actualizada correctamente", "Tarea" => $input]);
    } else {
        http_response_code(500);
        echo json_encode(["Error" => "Error al actualizar Tarea"]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET["id"];

    $sql = "DELETE FROM tareas WHERE id='$id' ";

    $query = mysqli_query($con, $sql);

    if ($query) {
        http_response_code(200);
        echo json_encode(["Mensaje" => "Tarea eliminada correctamente"]);
    } else {
        http_response_code(500);
        echo json_encode(["Error" => "Error al eliminar Tarea"]);
    }
}
