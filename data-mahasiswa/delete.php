<?php 
session_start();
require '../config/koneksi.php';
if(isset($_GET['delete'])){
    $nim = mysqli_real_escape_string($conn, htmlspecialchars($_GET['delete']));
    $delete = mysqli_query($conn, "DELETE FROM tb_mahasiswa WHERE nim = '$nim'");
    if ($delete) {
        $_SESSION['type'] = 'success';
        $_SESSION['alert'] = 'Hapus data berhasil';
        $_SESSION['icon'] = 'bi bi-check-circle-fill';
        header("Location:../data-mahasiswa/index.php");
        exit();
    }else{
        $_SESSION['type'] = 'danger';
        $_SESSION['alert'] = 'Data gagal terhapus';
        $_SESSION['icon'] = 'bi bi-exclamation-triangle-fill';
        header("Location:../data-mahasiswa/index.php");
        exit();
    }
}
?>