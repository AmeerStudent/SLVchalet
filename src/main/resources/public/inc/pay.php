<?php
session_start();
include 'connection.php';
$user = $_SESSION['User'];
$query = "SELECT * FROM shopping_cart WHERE username = '$user' ";
$result = mysqli_query($sql_connect, $query);

$primary_key_receipt = md5(time());

$insertreceipt = "INSERT INTO receipt(receipt_id,username) VALUES ('$primary_key_receipt','$user')";
$sql = mysqli_query($sql_connect, $insertreceipt);


while ($cart = mysqli_fetch_assoc($result)) {

    //TABLE VAR_PRODUCT
    $query2 = "SELECT * FROM var_product WHERE var_product_id = '" . $cart['var_product_id'] . "' ";
    $result2 = mysqli_query($sql_connect, $query2);
    $cart2 = mysqli_fetch_assoc($result2);


    //TABLE PRODUCT
    $query4 = "SELECT * FROM products WHERE product_id = '" . $cart['product_id'] . "' ";
    $result4 = mysqli_query($sql_connect, $query4);
    $cart4 = mysqli_fetch_assoc($result4);

    $insertvarreceipt = "INSERT INTO var_receipt(product_title,var_product_title,var_product_price,product_id,var_product_quan,var_seller,status,username,receipt_id,review_status,notifcation) VALUES ('" . $cart4['product_title'] . "' , '" . $cart2['var_product_title'] . "', '" . $cart2['var_product_price'] . "' , '" . $cart['product_id'] . "', '" . $cart['quantity'] . "','" . $cart4['user_id'] . "' , 'Pending' , '$user' , '$primary_key_receipt' , 'NO' ,'Pending')";
    $insertvarrecei = mysqli_query($sql_connect, $insertvarreceipt);

    //CLEAR CART
    $deletesql = "DELETE FROM shopping_cart where username = '$user' ";
    $deletecart = mysqli_query($sql_connect, $deletesql);
}

header("Location: ../receipt/receipt.php?id=".$primary_key_receipt);
