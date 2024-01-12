<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'eco';
$connection = mysqli_connect($hostname, $username, $password, $database);
if (!$connection) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}
?>
