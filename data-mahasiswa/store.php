<?php
session_start();
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = htmlspecialchars($_POST['user_id']);
    $nim = filter_var(htmlspecialchars($_POST['nim']), FILTER_SANITIZE_SPECIAL_CHARS);
    $nama = filter_var(htmlspecialchars($_POST['nama']), FILTER_SANITIZE_SPECIAL_CHARS);
    $jk = filter_var(htmlspecialchars($_POST['jk']), FILTER_SANITIZE_SPECIAL_CHARS);
    $kls = filter_var(htmlspecialchars($_POST['kelas']), FILTER_SANITIZE_SPECIAL_CHARS);
    $jrs = filter_var(htmlspecialchars($_POST['jrs']), FILTER_SANITIZE_SPECIAL_CHARS);
    $nohp = filter_var(htmlspecialchars($_POST['nohp']), FILTER_SANITIZE_SPECIAL_CHARS);

    $save = mysqli_prepare($conn, "INSERT INTO tb_mahasiswa (user_id,nim,nama,jk,kelas,jurusan,no_hp) VALUES (?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($save, 'isssiss',$user_id, $nim, $nama, $jk, $kls, $jrs, $nohp);
    mysqli_stmt_execute($save);
    if ($save) {
        $_SESSION['type'] = 'success';
        $_SESSION['alert'] = 'Simpan data berhasil';
        $_SESSION['icon'] = 'bi bi-check-circle-fill';
        header("Location:../data-mahasiswa/index.php");
        exit();
    }else{
        $_SESSION['type'] = 'danger';
        $_SESSION['alert'] = 'Simpan data gagal';
        $_SESSION['icon'] = 'bi bi-exclamation-triangle-fill';
        header("Location:../data-mahasiswa/add-form.php");
        exit();
    }
}
