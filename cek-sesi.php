<?php
session_start();
if (isset($_SESSION['username'])) {
    print_r($_SESSION);
}
