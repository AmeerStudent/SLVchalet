<?php       
    session_start();
    include 'connection.php';
    
    if (isset($_POST['submit'] )!== "") {
        $username = $_SESSION['User'];
        $varid = @$_POST['variation'];
        $prodid =  $_POST['prodid'];
        $quantity = $_POST['quantity'];

        
        $varid = stripcslashes($varid);
        $varid = mysqli_real_escape_string($sql_connect, $varid);

        if(empty($varid)){
            echo "<span class='form-error'> Please select variation!</span> <br>";
        }else{
            $sql = "SELECT * FROM `var_product` WHERE var_product_id = '$varid'";
            $result = mysqli_query($sql_connect, $sql);                    
            $variation = mysqli_fetch_assoc($result);

            if ($quantity > $variation['var_product_quan']){
                echo "<span class='form-error'> Please insert valid quantity !</span> <br>";
            }else{
                $checkcartquery = "SELECT * FROM `shopping_cart` WHERE var_product_id = '$varid' AND username = '$username'";
                $checkcartresult = mysqli_query($sql_connect,$checkcartquery);
                $checkcart = mysqli_fetch_assoc($checkcartresult);

                if(mysqli_num_rows($checkcartresult)== 0){
                    $query = "INSERT INTO shopping_cart(product_id,var_product_id,quantity,username) VALUES ('$prodid','$varid','$quantity','$username')";
                    $sql2 = mysqli_query($sql_connect, $query);

                    if ($sql2) {
                        $update = "UPDATE var_product SET var_product_quan = (var_product_quan - '$quantity') WHERE var_product_id = '$varid' " ;
                        $sql3 = mysqli_query($sql_connect, $update);
                        $addtocart = true;
                    }
                }else{
                    $updatecartquery = "UPDATE shopping_cart SET quantity = (quantity + '$quantity') WHERE cart_id = '".$checkcart['cart_id']."' " ;
                    $updatecartresult = mysqli_query($sql_connect, $updatecartquery);

                    if ($updatecartquery) {
                        $update = "UPDATE var_product SET var_product_quan = (var_product_quan - '$quantity') WHERE var_product_id = '$varid' " ;
                        $sql3 = mysqli_query($sql_connect, $update);
                        $addtocart = true;
                    }
                }
            }
        }
    }
       
?>

<script>
    var success = "<?php echo $addtocart?>" ;

    if(success == true ){
        Swal.fire(
        'Thank you !',
        'Item succesfully added to your cart ',
        'success'
        ).then(function() {
            window.location.reload();
        });
    }
</script>