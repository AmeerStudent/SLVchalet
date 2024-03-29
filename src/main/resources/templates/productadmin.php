<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SLV</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
 <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SLV</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link th:href="@{assets/img/slv.png}" rel="icon">
  <link th:href="@{assets/img/slv.png}" rel="nex1-icon">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link th:href="@{assets/vendor/bootstrap/css/bootstrap.min.css}" rel="stylesheet">
  <link th:href="@{assets/vendor/bootstrap-icons/bootstrap-icons.css}" rel="stylesheet">
 <link href="/vendor/aos/aos.css" rel="stylesheet">
<link href="/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- Template Main CSS File -->
  <link th:href="@{assets/css/style.css}" rel="stylesheet" type="text/css"/>
</head>
  
<body>
<body>
  <!-- ======= Header ======= -->
  <?php include 'inc/header.php' ?>
  <!-- ======= Hero Section ======= -->
  <div class="container" style="margin-top:150px; min-height:90vh">
    <h3>Search facilities</h3>
    <form method="GET">
      <div class="card">
        <div class="card-body">
          <div class="input-group">
            <input type="text" class="form-control" name="title" aria-label="Text input with dropdown button" style="margin-right:20px">
            <select class="custom-select" name="category" id="inputGroupSelect01" style="margin-right:20px">
              <option value="1">All</option>
              <option value="2">Facilities</option>
              <option value="3">Activities</option>
              <option value="4">Chalet</option>
              <option value="5">Others</option>
            </select>
            <div class="input-group-prepend">
              <button class="btn btn-primary">Search</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <h1>Facilities Listing</h1>
     <?php 
    if (isset($_GET['title'])) {
      if (!empty($_GET['title'])) {
        $title = $_GET['title'];

        if ($_GET['category'] == '1') {
          $query = "SELECT * FROM products WHERE type = 'Product' AND product_title LIKE '%$title%' ";
          $result = mysqli_query($sql_connect, $query);
        } else if ($_GET['category'] == '2') {
          $query = "SELECT * FROM products WHERE type = 'Product' AND product_category = 'Food And Beverages' AND product_title LIKE '%$title%' ";
          $result = mysqli_query($sql_connect, $query);
        } else if ($_GET['category'] == '3') {
          $query = "SELECT * FROM products WHERE type = 'Product' AND product_category = 'Fashion' AND product_title LIKE '%$title%' ";
          $result = mysqli_query($sql_connect, $query);
        } else if ($_GET['category'] == '4') {
          $query = "SELECT * FROM products WHERE type = 'Product' AND product_category = 'Electronics' AND product_title LIKE '%$title%' ";
          $result = mysqli_query($sql_connect, $query);
        } else if ($_GET['category'] == '5') {
          $query = "SELECT * FROM products WHERE type = 'Product' AND product_category = 'Others' AND product_title LIKE '%$title%' ";
          $result = mysqli_query($sql_connect, $query);
        }
      } else if (empty($_GET['title'])) {
        if ($_GET['category'] == '1') {
          $query = "SELECT * FROM products WHERE type = 'Product' ORDER BY product_date DESC";
          $result = mysqli_query($sql_connect, $query);
        } else if ($_GET['category'] == '2') {
          $query = "SELECT * FROM products WHERE type = 'Product' AND product_category = 'Food And Beverages'";
          $result = mysqli_query($sql_connect, $query);
        } else if ($_GET['category'] == '3') {
          $query = "SELECT * FROM products WHERE type = 'Product' AND product_category = 'Fashion'";
          $result = mysqli_query($sql_connect, $query);
        } else if ($_GET['category'] == '4') {
          $query = "SELECT * FROM products WHERE type = 'Product' AND product_category = 'Electronics'";
          $result = mysqli_query($sql_connect, $query);
        } else if ($_GET['category'] == '5') {
          $query = "SELECT * FROM products WHERE type = 'Product' AND product_category = 'Others'";
          $result = mysqli_query($sql_connect, $query);
        }
      }
    } else {
      $query = "SELECT * FROM products WHERE type = 'Product' ORDER BY product_date DESC";
      $result = mysqli_query($sql_connect, $query);
    }

    if (mysqli_num_rows($result) == 0) {
      echo '<div class="card">
              <div class="card-body">
                No ads found.
              </div>
            </div>';
    } else {
      while ($prod = mysqli_fetch_assoc($result)) {
     ?> 
        <div class="card">
          <div class="card-body">
            <div class="image" style="max-height:192px; ">
              <?php
              $id = $prod['product_id'];
              $query2 = "SELECT pic_name FROM pic_product WHERE product_id = '$id'";
              $result2 = mysqli_query($sql_connect, $query2);
              $pic = mysqli_fetch_assoc($result2);
              ?>
              <img style="max-height:190px; object-fit:scale-down;" src="images/<?php echo $pic['pic_name'] ?>" alt="">
            </div>
            <div class="title">
              <h4 style="font-weight:1000;"><?php echo $prod['product_title'] ?></h4>
              <p style="width: 650px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                <?php echo $prod['product_des'] ?>
              </p>

              <?php
              $query_min_price = "SELECT MIN(`var_product_price`) AS lowest , MAX(`var_product_price`) AS highest FROM  `var_product` WHERE product_id = '$id'";
              $result_price = mysqli_query($sql_connect, $query_min_price);
              if ($row = mysqli_fetch_array($result_price)) {
                if ($row['highest'] == $row['lowest'])
                  $price = 'RM' . $row['highest'];

                else
                  $price = 'RM' . $row['lowest'] . ' - RM ' . $row['highest'];
              }
              ?>
              <script>
    window.onload = function(){
        document.getElementById('delete-button').addEventListener('click', function() {
            if (!confirm('Are you sure you want to delete this product?')) {
                return;
            } else {
                event.preventDefault();
                // delete this product
            }
        });
    }
</script>
              <h4 class="price-tag">Price : <?php echo $price ?></h4>
			<div id="delete-button">
				<button class="go-to-btn delete" name="view_prod" type="submit" value="<?php echo $prod['product_id']; ?>">Delete </button>
			</div>
                  <br> <div class="btn-prod" style="margin-top: 30px;">
                  <form action="updatefacility.php" method="get">
                  <button class="go-to-btn" name="view_prod" type="submit" value="<?php echo $prod['product_id']; ?>">Update </button>
                </form>
              </div>
              </div>
            </div>

          </div>
        </div>
    <?php  }
    } ?>
  </div>
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Sungai Lopo Village</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script th:src="@{assets/vendor/bootstrap/js/bootstrap.bundle.js}"></script>
  <script th:src="@{assets/vendor/aos/aos.js}"></script>
  <script th:src="@{assets/vendor/php-email-form/validate.js}"></script>
  <script th:src="@{assets/vendor/swiper/swiper-bundle.min.js}"></script>
  <script th:src="@{assets/vendor/purecounter/purecounter.js}"></script>
  <script th:src="@{assets/vendor/isotope-layout/isotope.pkgd.min.js}"></script>
  <script th:src="@{assets/vendor/glightbox/js/glightbox.min.js}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Template Main JS File -->
  <script th:src="@{assets/js/main.js}"></script>
</body>

</html>
