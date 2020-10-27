<?php
$servername="localhost";
$user="root";
$password="";
$dbname="questions";

$conn=new mysqli($servername, $user, $password, $dbname);
if ($conn->connect_error) {
    die("error". $conn->connect_error);
}
?>