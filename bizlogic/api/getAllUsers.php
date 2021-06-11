<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");
class GetAllusers
{
    static function getUsers($headers)
    {
        if (GetAllusers::validateUser($headers['Authorization'])) {

            $conn = Connection::getConnection();
            $query = "SELECT * FROM `usrer_tbl`";
            $result = mysqli_query($conn, $query);

            if ($result->num_rows > 0) {
                $data = array();

                while ($users = mysqli_fetch_assoc($result)) {
                    $data[] = $users;
                }

                if (mysqli_query($conn, $query)) {



                    $response["status"] = 200;
                    $response["message"] = "success";
                    $response["data"] = $data;
                } else {
                    $response["status"] = 500;
                    $response["message"] = $conn->error;
                    $response["data"] = "";
                }
            } else {
                $response["status"] = 500;
                $response["message"] = $conn->error;
                $response["data"] = "";
            }
        }

        echo json_encode($response);
        exit;
    }

    public static function validateUser($header)
    {
        if ($header != "") {

            $conn = Connection::getConnection();
            $query = "SELECT id FROM `usrer_tbl` WHERE token = '$header'";
            $result = mysqli_query($conn, $query);

            if ($result->num_rows > 0) {
                $data = array();

                while ($users = mysqli_fetch_assoc($result)) {
                    $data[] = $users;
                }

                return strval($data[0]['id']);
            } else {

                $response["status"] = 401;
                $response["message"] = "Invalid token";
                $response["data"] = "";

                echo json_encode($response);
                exit;

                return false;
            }
        } else {
            $response["status"] = 401;
            $response["message"] = "Token not found";
            $response["data"] = "";
        }
        echo json_encode($response);
        exit;
    }
}
