<?php

// $host = "localhost";
// $name = "root";
// $pass = "";
// $bd = "laboratoriobd";

// $con =  mysqli_connect($host,$name,$pass,$bd);

$host = "localhost";
$name = "root";
$pass = "";
$bd = "laboratoriobd";

$con = mysqli_connect($host, $name, $pass, $bd, null, '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>