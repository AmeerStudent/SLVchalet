<?php 
session_start();
include 'connection.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $callprodsql = "SELECT * FROM product WHERE user_id = '$id' ";
    $prod = mysqli_query($sql_connect, $callprodsql);

    while($row = mysqli_fetch_assoc($prod)){

        $deletevarsql = "DELETE FROM var_product WHERE product_id = '" . $row['product_id'] . "'" ;
        $deletevar = mysqli_query($sql_connect, $deletevarsql); 

        $deletereviewsql =  "DELETE FROM review WHERE product_id = '" . $row['product_id'] . "'" ;
        $deletereview = mysqli_query($sql_connect, $deletereviewsql); 

        $deletecartsql = "DELETE FROM shopping_cart WHERE product_id = '$id' " ;
        $deletecart = mysqli_query($sql_connect, $deletecartsql); 
    }

    $deleteprodsql = "DELETE FROM product WHERE user_id = '$id'" ;
    $deleteprod = mysqli_query($sql_connect, $deleteprodsql); 

    $deleteusersql = "DELETE FROM admin WHERE username = '$id'" ;
    $deleteprodsql = mysqli_query($sql_connect, $deleteusersql); 

}

$_SESSION['deleteadmin'] = "true";
session_write_close();
header("Location: ../admindashboard.php");    