<?php
include 'inc/connection.php';
session_start();
if (!isset($_SESSION['User'])) {
    header("Location:login.php");
}

$id = $_POST['review'];
$query = "SELECT * FROM var_receipt WHERE var_receipt_id = '$id' ";
$result = mysqli_query($sql_connect, $query);
$row = mysqli_fetch_assoc($result);

$querypic = "SELECT pic_name FROM pic_product WHERE product_id = '" . $row['product_id'] . "'";
$resultpic = mysqli_query($sql_connect, $querypic);
$pic = mysqli_fetch_assoc($resultpic);

if (mysqli_num_rows($result) == 0) {
    header("Location: ../profile.php");
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>IIUM : : Pocket Money</title>
    <meta content="" name="description">

    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/img/ipm-logo-01.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="dist/assets/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="dist/assets/jquery-file-upload/js/jquery.iframe-transport.js"></script>
    <script src="dist/assets/jquery-file-upload/js/jquery.fileupload.js"></script>

</head>

<body>
    <!-- ======= Header ======= -->
    <?php include 'inc/header.php' ?>
    <!-- ======= Hero Section ======= -->

    <div class="container" style="margin-top:150px;">
        <div class="container">

            <h2>Review</h2>

            <hr>

            <div class="row">
                <div class="col-md-8 " style="  margin: auto;width: 50%;border: 3px solid #4154f1;padding: 10px;">
                    <div class="container">
                        <div>
                            <form method="POST" action="inc/review.php">
                                <h4>Please fill in your review</h4>
                                <hr>
                                <div class="image" style="text-align: center;">
                                    <img src="images/<?php echo $pic['pic_name'] ?>" width="200px" alt="">
                                </div>
                                <div class="form-group">
                                    <p class="input-title">Product </p>
                                    <p><?php echo $row['product_title'] ?></p>
                                </div>
                                <div class="form-group">
                                    <p class="input-title">Variation </p>
                                    <p><?php echo $row['var_product_title'] ?></p>
                                </div>
                                <div class="form-group">
                                    <p class="input-title">Seller </p>
                                    <p><?php echo $row['var_seller'] ?></p>
                                </div>
                                <div class="form-group">
                                    <p class="input-title">Review</p>
                                    <textarea name="review_content" class="form-control" rows="10" placeholder="Write your experience about this product/seller..." required></textarea>
                                </div>
                                <input name="product_id" type="text" value="<?php echo $row['product_id'] ?>" hidden>
                                <input name="receipt_id" type="text" value="<?php echo $row['var_receipt_id'] ?>" hidden>
                                <div id="wrapper">
                                    <button style="width:100%;margin-top:20px" class="btn btn-success">Submit review</button>
                                </div>
                        </div>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>
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
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>



</body>

</html>