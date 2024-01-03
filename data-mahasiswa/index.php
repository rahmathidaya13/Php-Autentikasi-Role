<?php
$GLOBALS['title'] = 'Data Mahasiswa';
require '../config/koneksi.php';
require '../dashboard/index.php';
require '../template/header.php';
require '../dashboard/navbar.php';

if (!isset($_SESSION['username'])) {
    header("Location:../login.php");
    exit();
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto me-auto mt-5">

            <!-- Notofikasi -->
            <?php if (isset($_SESSION['alert'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type'] ?> alert-dismissible fade show" role="alert">
                    <span><i class="<?php echo $_SESSION['icon'] ?>"></i> <?php echo $_SESSION['alert'] ?></span>
                    <a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                </div>
            <?php unset($_SESSION['alert']);
            endif; ?>
            <!-- endnotifikasi -->
            <?php if($data['role'] == 'admin') : ?>
            <a class="btn btn-info btn-sm mb-3" href="add-form.php">Tambah</a>
            <?php endif ?>
            <table class="table table-dark table-striped table-responsive">
                <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nim</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis kelamin</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">No hp</th>
                        <?php if ($data['role'] == 'admin') : ?>
                            <th scope="col">Aksi</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $user = $data['user_id'];
                    $no = 1;
                    $query = mysqli_prepare($conn, "SELECT tb_mahasiswa.*, user.role FROM tb_mahasiswa INNER JOIN user ON tb_mahasiswa.user_id 
                    = user.user_id WHERE tb_mahasiswa.user_id = ?");
                    mysqli_stmt_bind_param($query, 'i', $user);
                    mysqli_stmt_execute($query);
                    $all_data = mysqli_stmt_get_result($query);
                    foreach ($all_data as $row) :
                    ?>
                        <tr>
                            <th scope="row"><?php echo $no++ ?></th>
                            <td><?php echo $row['nim'] ?></td>
                            <td><?php echo $row['nama'] ?></td>
                            <td><?php echo $row['jk'] ?></td>
                            <td><?php echo $row['kelas'] ?></td>
                            <td><?php echo $row['jurusan'] ?></td>
                            <td><?php echo $row['no_hp'] ?></td>
                            <!-- jika role bukan admin fitur update dan delete akan dihilangkan -->
                            <?php if ($row['role'] == 'admin') : ?>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="edit-form.php?modify=<?php echo $row['nim'] ?>">Ubah</a>
                                    <a class="btn btn-danger btn-sm" href="delete.php?delete=<?php echo $row['nim'] ?>">Hapus</a>
                                </td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <?php if (empty($row)) : ?>
                    <tr>
                        <td class="text-center" colspan="13">Tidak ada data tersedia</td>
                    </tr>
                <?php endif ?>
            </table>
        </div>
    </div>
</div>
<?php require '../template/footer.php' ?>