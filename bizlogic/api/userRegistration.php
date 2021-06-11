<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class PostUser
{
    static  function saveUser($data)
    {
        if (!empty($data->userName) && !empty($data->password)) {

            $befor_password = $data->password;
            $password_encrypted = password_hash($befor_password, PASSWORD_BCRYPT);


            $query = "INSERT INTO usrer_tbl (user_name,password) VALUES ('$data->userName','$password_encrypted')";
            $conn = Connection::getConnection();

            if (mysqli_query($conn, $query)) {
                $response["status"] = 201;
                $response["message"] = "New record inserted id : " . mysqli_insert_id($conn);
                $response["data"] = "";
            } else {
                $response["status"] = 500;
                $response["message"] = "Internal Server Error" . $conn->error;
                $response["data"] = "";
            }
        } else {
            $response["status"] = 404;
            $response["message"] = "Unable to create item. Data is incomplete";
            $response["data"] = "";
        }
        echo json_encode($response);
        exit;
    }
}
