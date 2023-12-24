<?php 
$GLOBALS['title'] = 'Set-Role';
require '../config/koneksi.php';
require '../template/header.php';
if(isset($_GET['md_role'])){
    $username = htmlspecialchars($_GET['md_role']);
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $result = mysqli_fetch_assoc($query);
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-4 me-auto mx-auto mt-5">

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
                    <h3 class="card-title text-center mb-3">Ubah Role</h3>
                    <form action="change_role.php" method="post">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control" value="<?php echo $result['username'] ?>" readonly name="username" id="username" autofocus autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <div class="input-group flex-nowrap">
                                <input type="email" class="form-control" value="<?php echo $result['email'] ?>" readonly name="email" id="email" >
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Role</label>
                            <div class="input-group flex-nowrap">
                                <select class="form-select" name="role" id="role">
                                    <option class="fw-bold" value="<?php echo $result['role']; ?>"><?php echo ucwords($result['role']) ?></option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 d-grid gap-2">
                            <button class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require '../template/footer.php' ?>
