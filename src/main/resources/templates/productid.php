<?php
include 'inc/connection.php';
session_start();

if (isset($_SESSION['User'])) {
    header("Location: login.php");
}
if (!isset($_SESSION['Admin'])) {
    header("Location: admin.php");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>NEX INSTRUMENT</title>

    <!-- Favicons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/img/nex1.png" rel="icon">
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

    <div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
</div>

<tbody>
                        <?php
                        $row_num = 1;
                        $query = "SELECT * FROM products ";
                        $result = mysqli_query($sql_connect, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr class="align-middle">
                                <td><?php echo $row_num;
                                    $row_num++;
                                    $querypic = "SELECT pic_name FROM pic_product WHERE product_id = '" . $row['product_id'] . "' ";
                                    $resultpic = mysqli_query($sql_connect, $querypic);
                                    $pic = mysqli_fetch_assoc($resultpic);
                                    ?></td>
                                <td>
                                    <img src="images/<?php echo $pic['pic_name'] ?>" style="object-fit:scale-down;  width: 70px; height:60px">
                                </td>
                                <td><a href="view.php?view_prod=<?php echo $row['product_id'] ?>"><?php echo $row['product_title'] ?> </a></td>
                                <td><?php echo $row['type'] ?></td>
                                <td><?php echo $row['product_category'] ?></td>

                                <td><a href="viewprofile.php?id=<?php echo $row['user_id'] ?>"><?php echo $row['user_id'] ?></a></td>
                                <td>
                                    <button name='delete' class="btn btn-danger" value="<?php echo $row['product_id'] ?>" id="btn-submit">Delete Ads</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
 
    </div>
</body>
</html>
