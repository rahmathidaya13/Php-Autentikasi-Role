<?php
date_default_timezone_set('Asia/jakarta');
$GLOBALS['title'] = 'Home';
require 'index.php';
// include kan header dan navbar
require '../template/header.php';
require 'navbar.php'; 
?>
<!-- isi konten -->
<div class="container">
    <div class="row">
        <div class="col">
            <div class="p-3 mt-5 rounded-3">
                <div class="container-fluid py-5 text-center">
                    <h1 class="display-5 fw-bold text-primary">Welcome Back <?php echo ucwords(str_replace('-', ' ', $_SESSION['username'])) ?></h1>
                    <p class="fs-2 text-muted">Semoga Harimu menyenangkan</p>
                    <p class="fs-3"><?php echo date('l d F H:i A'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require '../template/footer.php'; ?>