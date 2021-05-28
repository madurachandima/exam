<?php
class Connection{
   public static function getConnection()
    {
        $dbhost = "localhost:3306";
        $dbuser = "root";
        $dbpass = "root";
        $db = "exam";
        
        $con = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die($con);
        return $con;
    }
}

