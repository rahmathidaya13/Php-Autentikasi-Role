<?php
session_start();
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // untuk memvalidasi bahwa ada data dalam form yang mau dikirim ke database
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = filter_var(htmlspecialchars($_POST['username']), FILTER_SANITIZE_SPECIAL_CHARS);
        $password = htmlspecialchars($_POST['password']);

        // buat log-old ketika salah satu inputan salah atau error 
        $_SESSION['log-old-username'] = htmlspecialchars($_POST['username']);
        $_SESSION['log-old-password'] = htmlspecialchars($_POST['password']);

        $query = mysqli_prepare($conn, "SELECT username,password,role FROM user WHERE username = ?");
        mysqli_stmt_bind_param($query, 's', $username);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
        $data = mysqli_fetch_assoc($result);
        mysqli_stmt_close($query);
        if ($data && password_verify($password, $data['password'])) {
            session_regenerate_id();
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];
            $_SESSION['start-time'] = time();
            unset($_SESSION['log-old-username']);
            unset($_SESSION['log-old-password']);
            header("Location:../dashboard/home.php");
            exit();
        } else {
            $_SESSION['type'] = 'danger';
            $_SESSION['alert'] = 'Username dan Password salah';
            $_SESSION['icon'] = 'bi bi-exclamation-triangle-fill';
            header("Location:../login.php");
        }
    } elseif (empty($_POST['username']) && empty($_POST['password'])) {
        $_SESSION['old-user'] = 'Username wajib diisi';
        $_SESSION['old-password'] = 'Password wajib di isi';

        $_SESSION['is-invalid1'] = 'is-invalid';
        $_SESSION['is-invalid2'] = 'is-invalid';

        header("Location:../login.php");
        exit();
    } elseif (empty($_POST['username'])) {
        $_SESSION['old-user'] = 'Username wajib di isi';
        $_SESSION['is-invalid1'] = 'is-valid';
        header("Location:../login.php");
        exit();
    } elseif (empty($_POST['password'])) {
        $_SESSION['old-password'] = 'Password wajib diisi';
        $_SESSION['is-invalid2'] = 'is-invalid';

        header("Location:../login.php");
        exit();
    }
}
mysqli_close($conn);
