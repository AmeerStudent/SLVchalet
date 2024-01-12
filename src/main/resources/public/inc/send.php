<?php 
session_start();
include 'connection.php';


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $update = "UPDATE var_receipt SET notifcation = 'Success' WHERE var_receipt_id = '$id' " ;
    $sql2 = mysqli_query($sql_connect, $update);
}

$_SESSION['send'] = "true";
session_write_close();
header("Location: ../profile.php");    

