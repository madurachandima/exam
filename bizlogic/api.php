<?php
include('connection/connection.php');
include('httpMethods/httpMethod.php');
include('api/userLogin.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {
    case httpMethod::POST:
        $user = json_decode(file_get_contents("php://input"));
        Login::loginUser($user);
        break;
}

?>