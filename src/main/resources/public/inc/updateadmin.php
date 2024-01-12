<?php 
include 'connection.php';
session_start();

    $username = $_SESSION['Admin'];
    $phonenum = $_POST['phonenum'];
    $address =  $_POST['address'];
    $backupid = $_POST['backupid'];
    
    $username = stripcslashes($username);
    $username = mysqli_real_escape_string($sql_connect, $username);

    $backupid = stripcslashes($backupid);
    $backupid = mysqli_real_escape_string($sql_connect, $backupid);

    $phonenum = stripcslashes($phonenum);
    $phonenum = mysqli_real_escape_string($sql_connect, $phonenum);

    $address = stripcslashes($address);
    $address = mysqli_real_escape_string($sql_connect, $address);

    $update = "UPDATE admin SET phone_num = '$phonenum' , address ='$address' , backup_id = '$backupid' WHERE username = '$username' " ;
	$sql2 = mysqli_query($sql_connect, $update);

    $_SESSION['updateprofile'] = "true";
    session_write_close();
    header("Location: ../profile.php");
