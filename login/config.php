<?php

error_reporting(E_ALL);

$host = "localhost";
$db = "care_db_innovadors";
$user = "root";
$pass = "1111";
 
$conn=mysqli_connect("$host","$user","$pass","$db");
if (!$conn){
echo "error in connection ".mysqli_error($conn);
}
