<?php
$host = "localhost";
$username = "root";
$pw = "root";
$db_name = "Test";

$conn = new mysqli($host, $username, $pw, $db_name);

if(!$conn){
    die("Database Connection Failed");
}