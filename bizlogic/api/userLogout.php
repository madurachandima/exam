<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers:Authorization, auth-token,Accept");


class LogOut
{
    static function userLogout($headers)
    {
        $user_id = "";
        $user_id = GetAllusers::validateUser($headers['Authorization']);

        if (!empty($user_id) && $user_id != "") {

            $conn = Connection::getConnection();
            // $query = "DELETE token FROM usrer_tbl WHERE id = '$user_id'";
            $query = "UPDATE `usrer_tbl` SET token='' WHERE id = '$user_id'";

            if ($conn->query($query) === TRUE) {
                $response["status"] = 200;
                $response["message"] = "sucess..";
                $response["data"] = true;
            } else {
                $response["status"] = 500;
                $response["message"] = $conn->error;
                $response["data"] = "";
            }
            echo json_encode($response);
            exit;
        }
    }
}
