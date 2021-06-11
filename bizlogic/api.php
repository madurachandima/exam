<?php
include('connection/connection.php');
include('httpMethods/httpMethod.php');
include('api/urlEndpoint/urlEndpoint.php');
include('api/userLogin.php');
include('api/userLogout.php');
include('api/userRegistration.php');
include('api/getAllUsers.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];
$request_url = $_SERVER['REQUEST_URI'];

// $headers = getallheaders();
// $message = $headers['User-Agent'];
// print($message);

switch ($requestMethod) {
        case httpMethod::POST:
                switch ($request_url) {
                        case urlEndpoint::LOGIN:
                                $user = json_decode(file_get_contents("php://input"));
                                Login::loginUser($user);
                                break;
                        case urlEndpoint::REGISTER:
                                $user = json_decode(file_get_contents("php://input"));
                                PostUser::saveUser($user);
                                break;
                        case urlEndpoint::GET_ALL:
                                GetAllusers::getUsers(getallheaders());
                                break;
                        case urlEndpoint::LOG_OUT:
                                LogOut::userLogout(getallheaders());
                                break;
                }
                break;
}
