<?php
session_start();
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $update = "UPDATE user SET acc_status = 'Verified' WHERE username = '$id' ";
    $sql2 = mysqli_query($sql_connect, $update);
}

$_SESSION['verify'] = "true";
session_write_close();
header("Location: ../admindashboard.php");
