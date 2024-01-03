<?php
$active = basename($_SERVER['PHP_SELF'], '.php');
?>
<style>
    #photo_cg {
        display: none;
    }
    .pic{
        max-width: 35px;
        max-height: 35px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">App-Web</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($active == 'home') ? 'active' : '' ?>" aria-current="page" href="../dashboard/home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($active == 'index') ? 'active' : '' ?>" href="../data-mahasiswa/index.php">Data Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($active == 'about') ? 'active' : '' ?>" href="../dashboard/about.php">About</a>
                </li>
            </ul>

            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <!-- picture navbar -->
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="rounded-circle pic" src="<?php echo $data['photo'] ? '../profile/'.$data['photo'] : '../profile/noimage.jpg' ?>" alt="">
                        <span class="text-white"><?php echo ucwords($data['username']) ?></span>
                    </a>
                    
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" href="?modify=<?php echo str_replace(' ', '+', $data['username']) ?>">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" onclick="return confirm('Apakah kamu yakin mau keluar ?')" href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h3 class="modal-title" id="exampleModalLabel">PROFILE</h3>
            </div>
            <div class="modal-body">
                <div class="card  border-0">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <?php if($data['photo']): ?>
                            <img id="preview" src="<?php echo '../profile/'.$data['photo'] ?>" class="card-img rounded-start" alt="<?php echo $data['photo'] ?> ?>">
                            <?php else: ?>
                            <img id="preview" src="../profile/noimage.jpg" class="card-img rounded-start" alt="nopic">
                            <?php endif ?>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                            <form action="../data-mahasiswa/update-profile.php?modify=<?php echo $data['username'] ?>" method="post" enctype="multipart/form-data">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item fw-bold fs-4"><i class="bi bi-person-fill"></i> <?php echo ucwords($data['username']) ?></li>
                                    <li class="list-group-item fs-5"><i class="bi bi-gear-fill"></i>
                                    <?php if ($data['role'] == 'admin') : ?>
                                                <span class="badge text-bg-success"><?php echo $data['role'] ?></span>
                                                <?php else : ?>
                                                    <span class="badge text-bg-primary"><?php echo $data['role'] ?></span>
                                                    <?php endif ?>
                                                </li>
                                        <li class="list-group-item">
                                            <label class="btn btn-sm btn-info text-white" for="photo_cg">Change Your Picture</label>
                                            <input type="file" name="photo" id="photo_cg" accept="image/*" >
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="modal_save" disabled class="btn btn-dark">Save changes</button>
                </div>
            </form> 
        </div>
    </div>
</div>

<script>
    let input =document.getElementById('photo_cg');
    let button =document.getElementById('modal_save');
    let preview = document.getElementById('preview');

    input.addEventListener('change', (evt)=>{
        button.disabled = !input.files.length > 0;
        button.classList.remove('btn-dark');
        button.classList.add('btn-primary');
        // display image preview
        let view =evt.target.files[0];
        preview.src = URL.createObjectURL(view);
    });
</script>