<?php
session_start();
$GLOBALS['title'] = 'Role';
require '../config/koneksi.php';
require '../template/header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto me-auto mt-5">
            <a class="btn btn-primary mb-3" href="../login.php">Back to Login</a>
            <table class="table table-dark table-striped">
                <thead class="text-center">
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php 
                    $query = mysqli_query($conn, "SELECT * FROM user");
                    foreach($query as $rows) :
                    ?>
                    <tr>
                        <td><?php echo ucwords($rows['username']) ?></td>
                        <td><?php echo ucwords($rows['email']) ?></td>
                        <td>
                            <?php if ($rows['role'] == 'admin'):?>
                            <span class="badge text-white bg-success fs-6 "><?php echo $rows['role'] ?></span>
                            <?php endif ?>
                            <?php if ($rows['role'] == 'user'):?>
                            <span class="badge text-white bg-danger fs-6"><?php echo $rows['role'] ?></span>
                            <?php endif ?>
                        </td>
                        <td class="d-grid">
                            <a class="btn btn-warning btn-sm" href="set_role.php?md_role=<?php echo $rows['username'] ?>">Ubah</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require '../template/footer.php' ?>
