<?php
// session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");
class Login
{
    public static function loginUser($user)
    {
        if (!empty($user->username) && !empty($user->password)) {
            $message = "";

            $conn = Connection::getConnection();
            $query = "SELECT * FROM `user` WHERE username = '$user->username' AND password = '$user->password'";
            $result = mysqli_query( $conn, $query);

            if ($result->num_rows > 0) {
                $data = array();

                while ($users = mysqli_fetch_assoc($result)) {
                    $data[] = $users;
                }

                // $_SESSION["id"] = $data["id"];
                // $_SESSION["name"] = $data["username"];

                $message = "success";

                $response["status"] = 200;
                $response["message"] = $message;
                $response["data"] = $data;
            } else {
                $message = "";
                $response["status"] = 404;
                $response["message"] =  $conn->error;
                $response["data"] = [];
            }
        } else {
            $response["status"] = 404;
            $response["message"] = "User name or password empty";
            $response["data"] = [];
        }

        echo json_encode($response);
        exit;
    }
}
