<?php 
session_start();
include 'connection.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $deleteprodsql = "DELETE FROM product WHERE product_id = '$id' " ;
    $deleteprod = mysqli_query($sql_connect, $deleteprodsql);

    $callvarsql = "SELECT * FROM var_product WHERE product_id = '$id' ";
    $var = mysqli_query($sql_connect, $callvarsql);

    while($row = mysqli_fetch_assoc($var)){
        $deletevarsql = "DELETE FROM var_product WHERE product_id = '$id' " ;
        $deletevar = mysqli_query($sql_connect, $deletevarsql); 
    }

    $callreviewsql = "SELECT * FROM review WHERE product_id = '$id' ";
    $review = mysqli_query($sql_connect, $callreviewsql);

    while($row = mysqli_fetch_assoc($review)){
        $deletereviewsql = "DELETE FROM review WHERE product_id = '$id' " ;
        $deletereview = mysqli_query($sql_connect, $deletereviewsql); 
    }

    $callshoppingcart = "SELECT * FROM shopping_cart WHERE product_id = '$id' ";
    $cart = mysqli_query($sql_connect, $callshoppingcart);

    while($row = mysqli_fetch_assoc($cart)){
        $deletecartsql = "DELETE FROM shopping_cart WHERE product_id = '$id' " ;
        $deletecart = mysqli_query($sql_connect, $deletecartsql); 
    }

}

$_SESSION['deleteads'] = "true";
session_write_close();
header("Location: ../profile.php");    

