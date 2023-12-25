<?php
session_start();
$GLOBALS['title'] = 'Register';
require 'config/koneksi.php';
require 'template/header.php';
// isi php
?>
<!-- isi kontent -->
<div class="container">
    <div class="row">
        <div class="col-md-4 me-auto mx-auto py-5">
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
                    <h3 class="card-title text-center mb-3">Sign up</h3>
                    <form action="console/register-proses.php" method="post">
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Username</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-fill"></i></span>
                                <input type="text" value="<?php echo $_SESSION['log-old-username'] ?? '' ?>" class="form-control <?php echo $_SESSION['is-invalid1'] ?? ''; unset($_SESSION['is-invalid1']); ?>" name="username" id="username" placeholder="Username" autofocus autocomplete="off">
                            </div>
                            <?php if (isset($_SESSION['old-user'])) : ?>
                                <div class="text-danger mt-2">
                                    <?php echo $_SESSION['old-user'] ?>
                                </div>
                            <?php unset($_SESSION['old-user']); 
                            endif ?>
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Email</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-envelope-at-fill"></i></span>
                                <input type="email" value="<?php echo $_SESSION['log-old-email'] ?? '' ?>" class="form-control <?php echo $_SESSION['is-invalid2'] ?? ''; unset($_SESSION['is-invalid2']); ?>" name="email" id="email" placeholder="Email" autofocus autocomplete="off">
                            </div>
                            <?php if (isset($_SESSION['old-email'])) : ?>
                                <div class="text-danger mt-2">
                                    <?php echo $_SESSION['old-email'] ?>
                                </div>
                            <?php unset($_SESSION['old-email']);
                            endif ?>
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-file-lock-fill"></i></span>
                                <input type="password" value="<?php echo $_SESSION['log-old-password'] ?? '' ?>" class="form-control <?php echo $_SESSION['is-invalid3'] ?? ''; unset($_SESSION['is-invalid3']); ?>" name="password" id="password" placeholder="Password">
                                <span class="input-group-text" id="addon-wrapping"><i id="show" class="bi bi-eye-fill"></i></span>
                            </div>
                            <?php if (isset($_SESSION['old-password'])) : ?>
                                <div class="text-danger mt-2">
                                    <?php echo $_SESSION['old-password'] ?>
                                </div>
                            <?php unset($_SESSION['old-password']);
                            endif ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-file-lock-fill"></i></span>
                                <input type="password" value="<?php echo $_SESSION['log-old-cpassword'] ?? '' ?>" class="form-control <?php echo $_SESSION['is-invalid4'] ?? ''; unset($_SESSION['is-invalid4']); ?>" name="cpassword" id="cpassword" placeholder="Confirm Password">
                                <span class="input-group-text" id="addon-wrapping"><i id="cp_show" class="bi bi-eye-fill"></i></span>
                            </div>
                            <?php if (isset($_SESSION['old-cpassword'])) : ?>
                                <div class="text-danger mt-2">
                                    <?php echo $_SESSION['old-cpassword'] ?>
                                </div>
                            <?php unset($_SESSION['old-cpassword']);
                            endif ?>
                        </div>
                        <div class="mb-3 d-grid gap-2">
                            <button class="btn btn-primary">Register</button>
                        </div>
                        <div class="mb-3 d-flex justify-content-center">
                            <span>Sudah punya akun ? <a class="text-decoration-none" href="login.php">Masuk</a> </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'template/footer.php' ?>