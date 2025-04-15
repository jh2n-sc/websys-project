<?php 
$host = 'localhost';
$pass = '';
$dbname = 'project_db';
$user = 'root';


$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection error!!!");
}
?>
