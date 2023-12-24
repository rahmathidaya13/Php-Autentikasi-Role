<?php
session_start();
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = htmlspecialchars($_POST['id']);
    $nim = filter_var(htmlspecialchars($_POST['nim']), FILTER_SANITIZE_SPECIAL_CHARS);
    $nama = filter_var(htmlspecialchars($_POST['nama']), FILTER_SANITIZE_SPECIAL_CHARS);
    $jk = filter_var(htmlspecialchars($_POST['jk']), FILTER_SANITIZE_SPECIAL_CHARS);
    $kls = filter_var(htmlspecialchars($_POST['kelas']), FILTER_SANITIZE_SPECIAL_CHARS);
    $jrs = filter_var(htmlspecialchars($_POST['jrs']), FILTER_SANITIZE_SPECIAL_CHARS);
    $nohp = filter_var(htmlspecialchars($_POST['nohp']), FILTER_SANITIZE_SPECIAL_CHARS);

    $update = mysqli_prepare($conn, "UPDATE tb_mahasiswa SET nim = ?,
    nama = ?,
    jk = ?,
    kelas = ?,
    jurusan = ?,
    no_hp = ? WHERE id_mahasiswa = ?");
    mysqli_stmt_bind_param($update, 'sssissi', $nim, $nama, $jk, $kls, $jrs, $nohp,$id);
    mysqli_stmt_execute($update);
    if ($update) {
        $_SESSION['type'] = 'success';
        $_SESSION['alert'] = 'Ubah data berhasil';
        $_SESSION['icon'] = 'bi bi-check-circle-fill';
        header("Location:../data-mahasiswa/index.php");
        exit();
    }else{
        $_SESSION['type'] = 'danger';
        $_SESSION['alert'] = 'Ubah data gagal';
        $_SESSION['icon'] = 'bi bi-exclamation-triangle-fill';
        header("Location:../data-mahasiswa/add-form.php");
        exit();
    }
}
