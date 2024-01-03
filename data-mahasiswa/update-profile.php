<?php
session_start();
require '../config/koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = mysqli_real_escape_string($conn, htmlspecialchars($_GET['modify']));

    $tipe_berkas = array('jpg', 'png', 'jpeg', 'webp', 'gif');
    $nama_file = $_FILES['photo']['name'];
    $explode = explode('.', $nama_file);
    $extensi = end($explode);
    $file_size = $_FILES['photo']['size'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $path = '../profile/' . $nama_file;

    $query = mysqli_query($conn, "SELECT photo FROM user WHERE username = '$user'");
    $get_data = mysqli_fetch_assoc($query);
    $path_file = '../profile/' . $get_data['photo'];
    if(file_exists($path_file) && unlink($path_file));

    if (in_array($extensi, $tipe_berkas)) {
        if ($file_size < 2044070) {
            move_uploaded_file($tmp_name, $path);
            $update_photo = mysqli_prepare($conn, "UPDATE user SET photo = ? WHERE username = ?");
            mysqli_stmt_bind_param($update_photo, 'ss', $nama_file, $user);
            mysqli_stmt_execute($update_photo);
            if ($update_photo) {
                $_SESSION['type'] = 'success';
                $_SESSION['alert'] = 'Photo profile berhasil diubah';
                $_SESSION['icon'] = 'bi bi-check-circle-fill';
                header("Location:index.php");
                exit();
            } else {
                $_SESSION['type'] = 'danger';
                $_SESSION['alert'] = 'Photo profile gagal diubah';
                $_SESSION['icon'] = 'bi bi-exclamation-triangle-fill';
                header("Location:index.php");
                exit();
            }
        } else {
            $_SESSION['type'] = 'warning';
            $_SESSION['alert'] = 'Ukuran photo profile terlalu besar';
            $_SESSION['icon'] = 'bi bi-exclamation-triangle-fill';
            header("Location:index.php");
            exit();
        }
    } else {
        $_SESSION['type'] = 'warning';
        $_SESSION['alert'] = 'ekstensi gambar tidak sesuai';
        $_SESSION['icon'] = 'bi bi-exclamation-triangle-fill';
        header("Location:index.php");
        exit();
    }
}
