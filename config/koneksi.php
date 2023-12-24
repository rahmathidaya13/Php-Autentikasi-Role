<?php 
$localhost = 'localhost';
$username = 'root';
$password = '';
$database = 'db_autentikasi';
$conn = mysqli_connect($localhost, $username, $password, $database);

if(!$conn){
    die("Koneksi gagal: ".mysqli_connect_error());
}

?>