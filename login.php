<?php
session_start();
$GLOBALS['title'] = 'Login';
require 'config/koneksi.php';
require 'template/header.php';
if (isset($_SESSION['username'])) {
    header("Location:dashboard/home.php");
    exit();
}
mysqli_close($conn);
?>

<div class="container">
    <div class="row">
        <div class="col-md-4 me-auto mx-auto mt-5">
            <!-- Notofikasi -->
            <?php if (isset($_SESSION['alert'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['type'] ?> alert-dismissible fade show" role="alert">
                    <span><i class="<?php echo $_SESSION['icon'] ?>"></i> <?php echo $_SESSION['alert'] ?></span>
                    <a href="#" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                </div>
            <?php unset($_SESSION['alert']);
            endif; ?>
            <!-- endnotifikasi -->

            <div class="card bg-dark-subtle">
                <div class="card-body">
                    <h3 class="card-title text-center mb-3">Sign in</h3>
                    <form action="console/login-proses.php" method="post">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-fill"></i></span>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-file-lock-fill"></i></span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                <span class="input-group-text" id="addon-wrapping"><i id="show" class="bi bi-eye-fill"></i></span>
                            </div>
                        </div>
                        <div class="mb-3 d-grid gap-2">
                            <button class="btn btn-primary">Login</button>
                        </div>
                        <div class="mb-3 d-flex justify-content-center">
                            <span>Belum punya akun ? <a class="text-decoration-none" href="register.php">Daftar</a> </span>
                        </div>
                    </form>
                    <div class="mb-3 d-flex justify-content-center">
                             <a class="text-decoration-none" href="Role/index.php">Role cek</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'template/footer.php' ?>