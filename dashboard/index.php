<?php
session_start();
require '../config/koneksi.php';
require '../template/header.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'] ?? '';
    $all_query = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ? ");
    mysqli_stmt_bind_param($all_query, "s", $username);
    mysqli_stmt_execute($all_query);
    $result = mysqli_stmt_get_result($all_query);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($all_query);
} else {
    header("Location:../login.php");
    exit();
}


// isi php

mysqli_close($conn);
?>
<?php require 'navbar.php'; ?>



<?php require '../template/footer.php'; ?>