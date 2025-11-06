<?php 

    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Method: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    $requestUri = $_SERVER['REQUEST_URI'];
    $scriptName = dirname($_SERVER['SCRIPT_NAME']);

    $path = str_replace($scriptName,'',parse_url($requestUri, PHP_URL_PATH));
    $uri = explode('/', trim($path, "/"));

    $endpoint = $uri[0];
    $id = $uri[1] ?? null;

    switch($endpoint){
        case 'tareas':
            $_GET['id'] = $id;
            require __DIR__ . '/endpoints/tareas.php';
            break;
    }

?>