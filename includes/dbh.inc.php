<?php
//opens the databse connection

$servername = "127.0.0.1";
$dbusername = "root";
$dbpassword = "root";
$dbname = "mcologin";

$conn = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);


if(!$conn){
    die("Connection failed");
}