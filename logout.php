<?php
    /// delete the session variable
    /// forward to sign in page

    session_start();

    unset($_SESSION['username']);
    unset($_SESSION['role']);
    session_destroy();

    echo "<script>window.location.assign('login.php');</script>";
?>