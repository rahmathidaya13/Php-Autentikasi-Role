<?php
session_start();
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_var(htmlspecialchars($_POST['username']), FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var(htmlspecialchars($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = hash('sha256', htmlspecialchars($_POST['password']));
    $cpassword = hash('sha256', htmlspecialchars($_POST['cpassword']));

    if ($password == $cpassword) {
        // cek username dan email di database
        $email_check = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
        if (!mysqli_num_rows($email_check)) {
            $query = mysqli_prepare($conn, "INSERT INTO user (username,email,password) VALUES (?,?,?)");
            mysqli_stmt_bind_param($query, 'sss', $username, $email, $password);
            mysqli_stmt_execute($query);
            if ($query) {
                $_SESSION['type'] = 'success';
                $_SESSION['alert'] = 'Pendaftaran Berhasil';
                $_SESSION['icon'] = 'bi bi-check-circle-fill';
                header('Location:../login.php');
                exit();
            } else {
                $_SESSION['type'] = 'danger';
                $_SESSION['alert'] = 'Pendaftaran Gagal';
                $_SESSION['icon'] = 'bi bi-exclamation-triangle-fill';
                header('Location:../register.php');
                exit();
            }
        } else {
            $_SESSION['type'] = 'danger';
            $_SESSION['alert'] = 'Email telah terdaftar';
            $_SESSION['icon'] = 'bi bi-exclamation-triangle-fill';
            header('Location:../register.php');
            exit();
        }
    } else {
        $_SESSION['type'] = 'danger';
        $_SESSION['alert'] = 'Password tidak sesuai';
        $_SESSION['icon'] = 'bi bi-exclamation-triangle-fill';
        header('Location:../register.php');
        exit();
    }
}
