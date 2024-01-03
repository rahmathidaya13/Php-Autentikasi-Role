<?php 
$GLOBALS['title'] = 'Form mahasiwa';
require '../dashboard/index.php';
require '../template/header.php';
require '../dashboard/navbar.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-5 me-auto mx-auto py-5">
            <!-- Notofikasi -->
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
                    <h3 class="card-title text-start mb-3">Form tambah</h3>
                    <form action="store.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $data['user_id'] ?>" >
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nim</label>
                            <div class="input-group flex-nowrap">
                                <input type="number" class="form-control <?php echo $_SESSION['is-invalid1'] ?? ''; unset($_SESSION['is-invalid1']); ?>" name="nim" id="nim" autofocus autocomplete="off">
                            </div>
                            <?php if (isset($_SESSION['nim-alert'])) : ?>
                                <div class="text-danger mt-2">
                                    <?php echo $_SESSION['nim-alert'] ?>
                                </div>
                            <?php unset($_SESSION['nim-alert']);
                            endif ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control <?php echo $_SESSION['is-invalid2'] ?? ''; unset($_SESSION['is-invalid2']); ?>" name="nama" id="nama" >
                            </div>
                            <?php if (isset($_SESSION['nama-alert'])) : ?>
                                <div class="text-danger mt-2">
                                    <?php echo $_SESSION['nama-alert'] ?>
                                </div>
                            <?php unset($_SESSION['nama-alert']);
                            endif ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <div class="input-group flex-nowrap">
                                <select class="form-select <?php echo $_SESSION['is-invalid3'] ?? ''; unset($_SESSION['is-invalid3']); ?>" name="jk" id="jk">
                                    <option value="0">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <?php if (isset($_SESSION['jk-alert'])) : ?>
                                <div class="text-danger mt-2">
                                    <?php echo $_SESSION['jk-alert'] ?>
                                </div>
                            <?php unset($_SESSION['jk-alert']);
                            endif ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kelas</label>
                            <div class="input-group flex-nowrap">
                                <input type="number" class="form-control <?php echo $_SESSION['is-invalid4'] ?? ''; unset($_SESSION['is-invalid4']); ?>" name="kelas" id="kelas">
                            </div>
                            <?php if (isset($_SESSION['kls-alert'])) : ?>
                                <div class="text-danger mt-2">
                                    <?php echo $_SESSION['kls-alert'] ?>
                                </div>
                            <?php unset($_SESSION['kls-alert']);
                            endif ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">jurusan</label>
                            <div class="input-group flex-nowrap">
                                <select class="form-select <?php echo $_SESSION['is-invalid5'] ?? ''; unset($_SESSION['is-invalid5']); ?>" name="jrs" id="jrs">
                                    <option value="0">Pilih Jurusan</option>
                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                    <option value="Bisnis Digital">Bisnis Digital</option>
                                </select>
                            </div>
                            <?php if (isset($_SESSION['jrs-alert'])) : ?>
                                <div class="text-danger mt-2">
                                    <?php echo $_SESSION['jrs-alert'] ?>
                                </div>
                            <?php unset($_SESSION['jrs-alert']);
                            endif ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">No Handphone</label>
                            <div class="input-group flex-nowrap">
                                <input type="number" class="form-control <?php echo $_SESSION['is-invalid6'] ?? ''; unset($_SESSION['is-invalid6']); ?>" name="nohp" id="nohp">
                            </div>
                            <?php if (isset($_SESSION['nohp-alert'])) : ?>
                                <div class="text-danger mt-2">
                                    <?php echo $_SESSION['nohp-alert'] ?>
                                </div>
                            <?php unset($_SESSION['nohp-alert']);
                            endif ?>
                        </div>
                        <div class="mb-2 d-grid gap-2">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require '../template/footer.php' ?>