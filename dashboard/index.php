<?php
// ambil semua data dari tabel user berdasarkan username yang masuk dari session
session_start();
require '../config/koneksi.php';
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'] ?? '';
    $all_query = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ? ");
    mysqli_stmt_bind_param($all_query, "s", $username);
    mysqli_stmt_execute($all_query);
    $result = mysqli_stmt_get_result($all_query);
    $data = mysqli_fetch_assoc($result);
    json_encode($data);
    mysqli_stmt_close($all_query);
} else {
    header("Location:../login.php");
    exit();
}
// jika pengguna tidak menggunakan aplikasi atau tidak berada didalam aplikasi selama 1 jam maka sessi akan berakhir
$minutes = 60;
$seconds = 60;
$timeout = $minutes * $seconds;
if(isset($_SESSION['start-time'])){
    $elapsed_time = time() - $_SESSION['start-time'];
    if($elapsed_time >= $timeout){
        echo "<script>alert('Sesi telah berakhir login kembali'); 
        window.location = '../logout.php'</script>";
        exit();
    }
    $_SESSION['start-time'] = time();
}

?>