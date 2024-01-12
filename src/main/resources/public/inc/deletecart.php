<?php       
    session_start();
    include 'connection.php';
    
    if (isset($_POST['submit'] )!== "") {

        $prodid =  $_POST['submit'];
        $userid = $_SESSION['User'];

        //Fetch quantity in cart
        $query = "SELECT quantity FROM shopping_cart WHERE var_product_id = '$prodid' AND username = '$userid'";
        $result = mysqli_query($sql_connect, $query); 
        $quantity = mysqli_fetch_assoc($result);

        //Update value after delete from cart
        $update = "UPDATE var_product SET var_product_quan = (var_product_quan + '".$quantity['quantity']."') WHERE var_product_id = '$prodid' " ;
        $sql2 = mysqli_query($sql_connect, $update);

        //Delete from cart
        $sql = "DELETE FROM shopping_cart WHERE var_product_id = '$prodid' AND username = '$userid' ";
        $delete = mysqli_query($sql_connect, $sql);

        header("Location: ../cart.php");    
    }
    ?>
