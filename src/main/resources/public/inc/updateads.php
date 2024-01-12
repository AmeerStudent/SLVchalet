<?php
include 'connection.php';
session_start();

    if (isset($_POST['submit'] )!== "") {
        $id = $_POST['submit'] ;
        $username = $_SESSION['User'];
        $variation = $_POST['variation'];
        $description = $_POST['description'];

        $description = stripcslashes($description);
        $description = mysqli_real_escape_string($sql_connect, $description);

        $variation = stripcslashes($variation);
        $variation = mysqli_real_escape_string($sql_connect, $variation);


        $success1 = false;
        $success2 = false;
        $success3 = false;

        $update = "UPDATE product SET product_des = '$description' WHERE product_id = '$id' " ;
        $sql2 = mysqli_query($sql_connect, $update);

        $varquan = $_POST['var-quan'] ;
        $varprice = $_POST['var-price'] ; 
        $vartitle = $_POST['var-title'] ;
        $varid = $_POST['var-id'] ;
        
        for ($i=0; $i<$variation; $i++) {  
            $updatevarsql = "UPDATE var_product SET var_product_price = '$varprice[$i]' , var_product_quan = '$varquan[$i]' WHERE var_product_id = '$varid[$i]' " ;
            $updatevar = mysqli_query($sql_connect, $updatevarsql);
        }

        $_SESSION['updateads'] = "true";
        session_write_close();
        header('Location: ../profile.php');

        exit();

    }
