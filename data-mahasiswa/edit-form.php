<?php 
$GLOBALS['title'] = 'Form Edit mahasiwa';
require '../config/koneksi.php';
require '../dashboard/index.php';
require '../template/header.php';
require '../dashboard/navbar.php';
if(isset($_GET['modify'])){
    $nim = mysqli_real_escape_string($conn, htmlspecialchars($_GET['modify']));
    $query = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");
    $data = mysqli_fetch_assoc($query);
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-5 me-auto mx-auto mt-2">
            <!-- Notifikasi -->
            <?php if (isset($_SESSION['alert'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type'] ?> alert-dismissible fade show" role="alert">
                    <span><i class="<?php echo $_SESSION['icon'] ?>"></i> <?php echo $_SESSION['alert'] ?></span>
                    <a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                </div>
            <?php unset($_SESSION['alert']);
            endif; ?>
            <!-- endnotifikasi -->

            <div class="card bg-primary-subtle">
                <div class="card-body">
                    <h3 class="card-title text-start mb-3">Form edit</h3>
                    <form action="update.php" method="post">
                        <input type="hidden" name="id" id="id" value="<?php echo $data['id_mahasiswa'] ?>" >
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nim</label>
                            <div class="input-group flex-nowrap">
                                <input type="number" class="form-control" readonly value="<?php echo $data['nim'] ?>" name="nim" id="nim" autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control" value="<?php echo $data['nama'] ?>" name="nama" id="nama" >
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <div class="input-group flex-nowrap">
                                <select class="form-select" name="jk" id="jk">
                                    <option class="fw-bold" value="<?php echo $data['jk'] ?>"><?php echo $data['jk'] ?></option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kelas</label>
                            <div class="input-group flex-nowrap">
                                <input type="number" value="<?php echo $data['kelas'] ?>" class="form-control" name="kelas" id="kelas">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">jurusan</label>
                            <div class="input-group flex-nowrap">
                            <select class="form-select" name="jrs" id="jrs">
                                    <option class="fw-bold" value="<?php echo $data['jurusan'] ?>"><?php echo $data['jurusan'] ?></option>
                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                    <option value="Bisnis Digital">Bisnis Digital</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">No Handphone</label>
                            <div class="input-group flex-nowrap">
                                <input type="number" value="<?php echo $data['no_hp'] ?>" class="form-control" name="nohp" id="nohp">
                            </div>
                        </div>
                        <div class="mb-2 d-grid gap-2">
                            <button class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require '../template/footer.php' ?>
