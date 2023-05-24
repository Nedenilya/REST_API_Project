<?php
require_once('db-connect.php');
   
$tokens = [];

while(true){
    $key = mt_rand(111, mt_getrandmax());
    $token = md5($key);
    if(!in_array($token, $tokens)){
        $tokens[] = addslashes($conn->real_escape_string($token));
        break;
    }
}


/**
 *   inserting Tokens to database
 */

$insert_sql = "INSERT INTO `token_list` (`token`) VALUES";
$insert_sql .= "('". (implode("'), ('", $tokens)) ."')"; 
$insert = $conn->query($insert_sql);
if($insert_sql){
    print("Tokens has been generated.<br>");
    echo "<pre>";
    print_r($tokens, JSON_PRETTY_PRINT);
    echo "</pre>";
}else{
    print("Inserting Tokens Failed. Error:". $conn->error);
}
$conn->close();