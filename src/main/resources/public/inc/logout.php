<?php
session_start();

if (isset($_SESSION['User'])) {
    session_unset();
    session_destroy();
    header("location:../login.php");
}else if (isset($_SESSION['Admin'])) {
    session_unset();
    session_destroy();
    header("location:../admin.php");
}
