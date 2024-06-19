<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "dbkasir";

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Koneksi database gagal: " . $connection->connect_error);
}

return $connection;
?>
