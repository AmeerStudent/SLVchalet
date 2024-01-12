<?php
session_start();
include 'connection.php';

$review_content = $_POST['review_content'];
$prodid = $_POST['product_id'];
$userid = $_SESSION['User'];
$receiptid = $_POST['receipt_id'];

$review_content = stripcslashes($review_content);
$review_content = mysqli_real_escape_string($sql_connect, $review_content);

$receiptid = stripcslashes($receiptid);
$receiptid = mysqli_real_escape_string($sql_connect, $receiptid);

$prodid = stripcslashes($prodid);
$prodid = mysqli_real_escape_string($sql_connect, $prodid);

$query = "INSERT INTO review(review_username,review_content,product_id,receipt_id) VALUES ('$userid','$review_content','$prodid','$receiptid')";
$sql2 = mysqli_query($sql_connect, $query);

if($sql2){
    $updatereviewstatus = "UPDATE var_receipt SET review_status = 'YES'  WHERE var_receipt_id = '$receiptid' " ;
    $updatereviewstatuscall = mysqli_query($sql_connect, $updatereviewstatus);
}


$_SESSION['review'] = "true";
session_write_close();
header("Location: ../profile.php");
