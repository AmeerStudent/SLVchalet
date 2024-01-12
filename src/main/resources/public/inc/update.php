<?php 
include 'connection.php';
session_start();

    $username = $_SESSION['User'];
    $phonenum = $_POST['phonenum'];
    $address =  $_POST['address'];
    $fullname = $_POST['fullname'];
    
    $username = stripcslashes($username);
    $username = mysqli_real_escape_string($sql_connect, $username);

    $fullname = stripcslashes($fullname);
    $fullname = mysqli_real_escape_string($sql_connect, $fullname);

    $phonenum = stripcslashes($phonenum);
    $phonenum = mysqli_real_escape_string($sql_connect, $phonenum);

    $address = stripcslashes($address);
    $address = mysqli_real_escape_string($sql_connect, $address);

    $update = "UPDATE user SET phone_num = '$phonenum' , address ='$address' , full_name = '$fullname' WHERE username = '$username' " ;
	$sql2 = mysqli_query($sql_connect, $update);

    $_SESSION['updateprofile'] = "true";
    session_write_close();
    header("Location: ../profile.php");
