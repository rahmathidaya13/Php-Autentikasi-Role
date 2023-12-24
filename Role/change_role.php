<?php
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $role = htmlspecialchars($_POST['role']);

    $update_role = mysqli_prepare($conn, "UPDATE user SET role = ? WHERE username = ? ");
    mysqli_stmt_bind_param($update_role, 'ss', $role, $username);
    mysqli_stmt_execute($update_role);
    if ($update_role) {
        $_SESSION['type'] = 'success';
        $_SESSION['alert'] = 'Berhasil ubah role';
        $_SESSION['icon'] = 'bi bi-check-circle-fill';
        header('Location:index.php');
        exit();
    } else {
        $_SESSION['type'] = 'danger';
        $_SESSION['alert'] = 'Gagal ubah role';
        $_SESSION['icon'] = 'bi bi-exclamation-triangle-fill';
        header('Location:set_role.php');
        exit();
    }
}
