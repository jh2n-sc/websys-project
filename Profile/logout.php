<?php

session_start();

if (isset($_GET['logout'])) {

    if ($_GET['logout'] = 1) {
        session_unset();
        session_destroy();
        header('Location: ../Login_Page/index.php');
        exit;
    }
}
?>