<?php
include 'inc/connection.php';
session_start();
if (isset($_POST['submit'] )!== "") {
$id = $_POST['id'];
$query = "SELECT * FROM product WHERE product_id = '$id' ";
$result = mysqli_query($sql_connect, $query);
$fetchrow = mysqli_fetch_assoc($result);

$found = true;
if (mysqli_num_rows($result) == 0) {
    $found = false;
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Nex Instruments</title>

    <!-- Favicons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/img/ipm-logo-01.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>
<style>
    .quantity {
        display: inline-block;
    }

    .quantity .input-text.qty {
        width: 35px;
        height: 39px;
        padding: 0 5px;
        text-align: center;
        background-color: transparent;
        border: 1px solid #efefef;
    }

    .quantity.buttons_added {
        text-align: left;
        position: relative;
        white-space: nowrap;
        vertical-align: top;
    }

    .quantity.buttons_added input {
        display: inline-block;
        margin: 0;
        vertical-align: top;
        box-shadow: none;
    }

    .quantity.buttons_added .minus,
    .quantity.buttons_added .plus {
        padding: 7px 10px 8px;
        height: 41px;
        background-color: #ffffff;
        border: 1px solid #efefef;
        cursor: pointer;
    }

    .quantity.buttons_added .minus {
        border-right: 0;
    }

    .quantity.buttons_added .plus {
        border-left: 0;
    }

    .quantity.buttons_added .minus:hover,
    .quantity.buttons_added .plus:hover {
        background: #eeeeee;
    }

    .quantity input::-webkit-outer-spin-button,
    .quantity input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        margin: 0;
    }

    .quantity.buttons_added .minus:focus,
    .quantity.buttons_added .plus:focus {
        outline: none;
    }

    .addtocart {
        background-color: black;
        color: white;
        border: none;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
    }

    .ads-detail {
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 20px;
        margin-top: 30px;
    }

    .carousel-container {
        width: 100%;
        height: 400px;
        position: relative;
        overflow: hidden;
    }

    .carousel {
        padding: 0;
        margin: 0;
        list-style: none;
        transition: 300ms transform ease-in;
    }

    .slide {
        padding: 0;
        margin: 0;
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .slide img {
        width: 100%;
        height: 400px;
        object-fit: contain;
    }

    .btn:focus {
        outline: none;
    }


    .btn {
        color: grey;
        z-index: 1;
        font-size: 30px;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        cursor: pointer;
    }

    .left-btn {
        left: -5px;
    }

    .right-btn {
        right: -5px;
    }

    .nav {
        width: 100%;
        height: 30px;
        position: absolute;
        top: 400px;
        display: flex;
        justify-content: center;
    }

    .nav .dot {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

        background: rgb(200, 200, 200);
        color: blue;
        border: none;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin: 8px 10px;
        cursor: pointer;
    }

    .dot.active {
        background: white;
    }

    .hide {
        display: none;
    }

    .container-slider {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2), 0 6px 5px 0 rgba(0, 0, 0, 0.19);
        width: 100%;
        height: 400px;
        margin: 0 auto;
        position: relative;
    }

    .submit {
        padding: 10px 20px 10px 20px;
        font-weight: 1000;
        font-size: 20px;
        width: 250px;
        background: #5770ff !important;
        border: none;
        color: rgb(255, 255, 255);
        border-radius: 100px;
    }
</style>



<body>
    <!-- ======= Header ======= -->
    <?php include 'inc/header.php' ?>
    <!-- ======= Hero Section ======= -->

    <div class="container" style="margin-top:10%; border:1px; width:700px;min-height:90vh; ">
        <h1>Update Ads</h1>
        <div class="card" style="height: 100%; padding:20px">
            <div class="container-slider">
                <button class="btn left-btn hide">
                    <i class="fa fa-chevron-circle-left"></i>
                </button>

                <div class="carousel-container">
                    <ul class="carousel">
                        <?php
                        $query_pic = "SELECT * FROM pic_product WHERE product_id = '$id'";
                        $result_pic = mysqli_query($sql_connect, $query_pic);
                        $i = 0;

                        while ($pic = mysqli_fetch_assoc($result_pic)) {
                            $i++;
                            if ($i == 1) {
                        ?>
                                <li class="slide active">
                                    <img src="images/<?php echo $pic['pic_name']; ?>" alt="">
                                </li>
                            <?php } else { ?>

                                <li class="slide">
                                    <img src="images/<?php echo $pic['pic_name']; ?>" alt="">
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
                <?php
                if ($i == 1) {
                    echo '';
                } else {
                    echo
                    '<button class="btn right-btn">
                <i class="fa fa-chevron-circle-right"></i>
              </button>';
                }
                ?>
                <div class="nav">
                    <?php
                    for ($x = 0; $x < $i; $x++) {
                        if ($i == 1) {
                            echo '';
                        } else if ($x == 0) {
                            echo '<div class="dot active"></div>';
                        } else {
                            echo '<div class="dot"></div>';
                        }
                    } ?>
                </div>
            </div>
            <form action="inc/updateads.php" method="POST">
                <div class="container" style="margin-top:40px">
                    <div class="form-group">
                        <p class="input-title">Title</p>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Title" value="<?php echo $row['product_title'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <p class="input-title">Date of Ads</p>
                        <input type="text" id="date" name="date" class="form-control" placeholder="Date" value="<?php echo date(" F j, Y - g:i a", strtotime($row["product_date"])) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <p class="input-title">Description</p>
                        <textarea name="description" class="form-control" rows="10" placeholder="Write anything about this product..." required><?php echo $row['product_des'] ?></textarea>
                    </div>
                    <?php
                        $varsql = "SELECT * FROM var_product WHERE product_id = '$id' ";
                        $resvar = mysqli_query($sql_connect, $varsql);
                        $i = 1;
                        while ($rowvar = mysqli_fetch_assoc($resvar)) {
                    ?>
                        <p class="input-title">Variation <?php echo $i++; ?> </p>
                        <div class="container" id="var-container" style="text-align: center; margin-bottom:20px;">
                            <div class="variation" style="display:inline-flex" ;>
                                <div class="form-group">
                                    <p class="input-title">Title Variation<input name="var-title[]" class="form-control" placeholder="Variation" value="<?php echo $rowvar['var_product_title'] ?>" readonly>
                                    <input name="var-id[]" class="form-control" value="<?php echo $rowvar['var_product_id'] ?>" hidden>
                                </div>
                                <div class="form-group">
                                    <p class="input-title">Quantity Variation</p><input min="1" type="number" id="var-quan[]" name="var-quan[]" class="form-control" placeholder="Quantity" value="<?php echo $rowvar['var_product_quan'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <p class="input-title">[RM]</p><input min="0" type="number" step="any" id="var-price[]" name="var-price[]" class="form-control" placeholder="RM" value="<?php echo $rowvar['var_product_price'] ?>" required>
                                </div>
                                <input name="variation" value=<?php echo $i ?> hidden>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="container" style="text-align:center; margin-top:40px">
                    <button type="submit" name="submit" value="<?php echo $row['product_id'] ?>" class="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>IIUM Pocket Money 2021</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/cart.js"></script>
    <script src="assets/js/ajax.js"></script>

    <script src="carousel.js"></script>


</body>

</html>