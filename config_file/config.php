<?php

error_reporting(E_ALL);
ini_set("session.gc_maxlifetime","3600"); 

function web_encryptIt($q) {
    $cryptKey = '@#preetish_webs22';
    $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
    return( $qEncoded );
}
// mcrypt_encrypt(MCRYPT_RIJNDAEL_128, md5($key, true), $string, MCRYPT_MODE_CBC, $iv)
function web_decryptIt($q) {
    $cryptKey = '@#preetish_webs22';
    $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
    return( $qDecoded );
}

date_default_timezone_set("Asia/Calcutta");
$host = "localhost";
$db = "care_db_innovadors";
$user = "root";
$pass = "1111";
 
$conn=mysqli_connect("$host","$user","$pass","$db");
if (!$conn){
echo "error in connection ".mysqli_error($conn);
}
