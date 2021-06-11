<?php
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
            $query = "SELECT * FROM `usrer_tbl` WHERE user_name = '$user->username'";
            $result = mysqli_query($conn, $query);

            if ($result->num_rows > 0) {
                $data = array();

                while ($users = mysqli_fetch_assoc($result)) {
                    $data[] = $users;
                }

                if (password_verify($user->password, $data[0]['password'])) {

                    $id = $data[0]['id'];
                    $token = "fnjd7ad3rr8fm4iouvn489rwrnyv54rf4tf4tsa" . strval($id); //replace with JWT 

                    $query = "UPDATE usrer_tbl  SET token = '$token' WHERE id='$id'";

                    if (mysqli_query($conn, $query)) {

                        $response["status"] = 200;
                        $response["message"] = "success";
                        $response["data"] = $token;
                    } else {
                        $response["status"] = 200;
                        $response["message"] = $conn->error;
                        $response["data"] = "";
                    }
                } else {
                    $response["status"] = 404;
                    $response["message"] = "invalid user name or password";
                    $response["data"] = [];
                }
                // $token = strval($data[0]['id'])  . $data[0]['user_name'];


            } else {

                $response["status"] = 404;
                $response["message"] = "No user found";
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
