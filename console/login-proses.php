<?php
session_start();
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_var(htmlspecialchars($_POST['username']), FILTER_SANITIZE_SPECIAL_CHARS);
    $password = hash('sha256', htmlspecialchars($_POST['password']));

    $query = mysqli_prepare($conn, "SELECT username,password,role FROM user WHERE username = ? AND password = ? ");
    mysqli_stmt_bind_param($query, 'ss', $username, $password);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    mysqli_stmt_close($query);
    if (mysqli_num_rows($result)) {
        session_regenerate_id();
        $data = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        header("Location:../dashboard/home.php");
        exit();
    } else {
        $_SESSION['type'] = 'danger';
        $_SESSION['alert'] = 'Username dan Password salah';
        $_SESSION['icon'] = 'bi bi-exclamation-triangle-fill';
        header("Location: ../login.php");
    }
}
mysqli_close($conn);
