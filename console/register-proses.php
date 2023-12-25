<?php
session_start();
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ambil log bekas inputan yang gagal
    $_SESSION['log-old-username'] = htmlspecialchars($_POST['username']);
    $_SESSION['log-old-email'] = htmlspecialchars($_POST['email']);
    $_SESSION['log-old-password'] = htmlspecialchars($_POST['password']);
    $_SESSION['log-old-cpassword'] = htmlspecialchars($_POST['cpassword']);

    // jika ada data yang diinput dari form jalankan code yang ada dibawah ini
    if (
        !empty($_POST['username']) &&
        !empty($_POST['email']) &&
        !empty($_POST['password']) &&
        !empty($_POST['cpassword'])
    ) {

        $username = filter_var(htmlspecialchars($_POST['username']), FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var(htmlspecialchars($_POST['email']), FILTER_VALIDATE_EMAIL);
        $password = hash('sha256', htmlspecialchars($_POST['password']));
        $cpassword = hash('sha256', htmlspecialchars($_POST['cpassword']));

        if ($password == $cpassword) {
            // cek username dan email di database, jika ternyata ada email yang dimasukan sama maka data tidak
            // tersimpan dan akan menampilkan pemberitahuannya
            $email_check = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
            if (!mysqli_num_rows($email_check)) {
                $query = mysqli_prepare($conn, "INSERT INTO user (username,email,password) VALUES (?,?,?)");
                mysqli_stmt_bind_param($query, 'sss', $username, $email, $password);
                mysqli_stmt_execute($query);
                if ($query) {
                    // ini buat alert
                    $_SESSION['type'] = 'success';
                    $_SESSION['alert'] = 'Pendaftaran Berhasil';
                    $_SESSION['icon'] = 'bi bi-check-circle-fill';

                    // ini buat hapus log bekas gagal input data, ketika berhasil daftar
                    unset($_SESSION['log-old-username']);
                    unset($_SESSION['log-old-email']);
                    unset($_SESSION['log-old-password']);
                    unset($_SESSION['log-old-cpassword']);

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
        // ini adalah fitur validasi
        // tetapi jika form yang dinput kosong maka akan tampilkan notifikasi
    } elseif (
        empty($_POST['username']) &&
        empty($_POST['email']) &&
        empty($_POST['password']) &&
        empty($_POST['cpassword'])
    ) {

        $_SESSION['old-user'] = 'Username wajib diisi';
        $_SESSION['old-email'] = 'Email wajib di isi';
        $_SESSION['old-password'] = 'Password wajib di isi';
        $_SESSION['old-cpassword'] = 'Confirm password wajib di isi';

        // validasi
        $_SESSION['is-invalid1'] = 'is-invalid';
        $_SESSION['is-invalid2'] = 'is-invalid';
        $_SESSION['is-invalid3'] = 'is-invalid';
        $_SESSION['is-invalid4'] = 'is-invalid';
        header('Location:../register.php');
        exit();
    } elseif (empty($_POST['username'])) {
        $_SESSION['old-user'] = 'Username wajib diisi';
        $_SESSION['is-invalid1'] = 'is-invalid';
        header('Location:../register.php');
        exit();
    } elseif (empty($_POST['email'])) {
        $_SESSION['old-email'] = 'Email wajib di isi';
        $_SESSION['is-invalid2'] = 'is-invalid';
        header('Location:../register.php');
        exit();
    } elseif (empty($_POST['password'])) {
        $_SESSION['old-password'] = 'Password wajib di isi';
        $_SESSION['is-invalid3'] = 'is-invalid';
        header('Location:../register.php');
        exit();
    } elseif (empty($_POST['cpassword'])) {
        $_SESSION['old-cpassword'] = 'Confirm password wajib di isi';
        $_SESSION['is-invalid4'] = 'is-invalid';
        header('Location:../register.php');
        exit();
    }
}
