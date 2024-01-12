<?php
include 'inc/connection.php';
session_start();

    if (isset($_POST['submit_image'] )!== "") {
        $username = $_SESSION['Admin'];
        $title = $_POST['title'];
        $variation = $_POST['variation'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $type = $_POST['type'];

        $description = stripcslashes($description);
        $description = mysqli_real_escape_string($sql_connect, $description);

        $title = stripcslashes($title);
        $title = mysqli_real_escape_string($sql_connect, $title);

        $variation = stripcslashes($variation);
        $variation = mysqli_real_escape_string($sql_connect, $variation);

        $category = stripcslashes($category);
        $category = mysqli_real_escape_string($sql_connect, $category);

        $type = stripcslashes($type);
        $type = mysqli_real_escape_string($sql_connect, $type);


        if($type == 1){
            $type = "Product";

            if($category == 0){
                $category = "None" ;
            }else if($category == 1){
                $category = "Food And Beverages" ;
            }else if($category == 2){
                $category = "Fashion";
            }else if($category == 3){
                $category = "Electronics";
            }else if($category == 4){
                $category = "Others";
            }
        }else if($type == 2){
            $type = "Services";

            if($category == 0){
                $category = "None" ;
            }else if($category == 1){
                $category = "Delivery Service" ;
            }else if($category == 2){
                $category = "Educational Service";
            }else if($category == 3){
                $category = "Cleaning Service";
            }else if($category == 4){
                $category = "Others";
            }
        }

        //Set primary key for item
        $primary_key_item = md5(time());

        //Make sure that data sent to DB
        $success = false;
        $success1 = false;
        $success2 = false;

        //Retrieving values of Array (variations)

        $query = "INSERT INTO products (product_id,type,product_category,product_title,product_des,user_id) VALUES ('$primary_key_item','$type','$category','$title','$description','$username')";
        $sql = mysqli_query($sql_connect, $query);

        if($sql){
            $success = true;
        }


        $varquan = $_POST['var-quan'] ;
        $varprice = $_POST['var-price'] ; 
        $vartitle = $_POST['var-title'] ;
        
        for ($i=0; $i<$variation; $i++) {
            $query1 = "INSERT INTO var_product(var_product_title,var_product_price,var_product_quan,product_id) VALUES ('$vartitle[$i]','$varprice[$i]','$varquan[$i]','$primary_key_item')";
            $sql1 = mysqli_query($sql_connect, $query1);

            if($sql1){
                $success1 = true;
            }
        }

        for($i=0;$i<count($_FILES["upload_file"]["name"]);$i++)
        {
            //Insert picture to DB
            $filename=$_FILES["upload_file"]["name"][$i];
            $file_ext = substr($filename, strripos($filename, '.')); // get file name
            $newfilename = time().$i. $file_ext;
                
            //Query 2 - Insert Pic
            $query2 = "INSERT INTO pic_product(pic_name,product_id) VALUES ('$newfilename','$primary_key_item')";
            $sql2 = mysqli_query($sql_connect, $query2);

            if($sql2){
                $success2 = true;
            }
            $folder="images/";
            move_uploaded_file($_FILES["upload_file"]["tmp_name"][$i], "$folder".$newfilename);
        }

        if($success = true && $success1 = true && $success2 = true){
            $_SESSION['success'] = "true";
            session_write_close();
            header('Location: postads.php');
        }
        exit();

    }
