// <?php 
//   session_start();

// ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SLV</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
  <link href="assets/img/slv.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link th:href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link th:href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link th:href="@{assets/css/style.css}" rel="stylesheet" type = "text/css"/> <!-- tukar thref -->

</head>

<body>
  <!-- ======= Header ======= -->
  <?php include 'inc/header.php'; ?>

  
  <!-- ======= Hero Section ======= -->
    <div class="container">
      <div class="row">
        <div class="col-lg-6 hero-img " style="margin-top:15%;" data-aos="zoom-out" data-aos-delay="50">
            <img src="assets/img/signstaff.png" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="zoom-out" data-aos-delay="50">
          <div class="signup-form">    
            <form action="inc/signupadmin.php" method="POST">
            <h1>Register New Staff </h1>
			<!-- Full Name -->               
                <div class="form-group">
                    <p class="input-title" >Full Name</p>
                    <input type="text" id="staffName" name="staffName" class="form-control" placeholder="Full Name" >
                </div>
                 <!-- Id Number -->
                <div class="form-group">
                    <p class="input-title" id="id-title">ID Number</p>
                    <input type="text" id="staffId" name="staffId" class="form-control" placeholder="Insert your ID" >
                </div>    
                 <!-- Email -->
                 <div class="form-group">
                    <p class="input-title" >Email</p>
                    <input type="text" id="staffEmail" name="staffEmail" class="form-control" placeholder="Email">
                </div>
                 <!-- Phone Number -->
                <div class="form-group">
                    <p class="input-title" >Phone Number</p>
                    <input type="text" id="staffPhoneNo" name="staffPhoneNo" class="form-control" placeholder="Example : 60123456789" >
                </div>
                 <!-- Password -->
                <div class="form-group">
                    <p class="input-title" >Password</p>
                    <input type="password" id="staffPass" name="staffPass" class="form-control" placeholder="Password">
                </div>
		    
                <input type="submit" name="signup" value="Submit" class="btn btn-primary btn-block btn-lg " >    
                <p class="form-message"></p>          
            </form>			
            <div class="text-center small">Cancel Registration? <a href="admindashboard.php">Back</a></div>
        </div>
        </div>
      </div>
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
  <script src="assets/js/validator.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
      $(document).ready(function(){

          $("form").submit(function(event) {
            event.preventDefault();
            var staffName = $("#staffName").val();
            var staffEmail = $("#staffEmail").val();
            var staffId = $("#staffId").val();
            var staffPhoneNo = $("#staffPhoneNo").val();
            var staffPass = $("#staffPass").val();
            
            $(".form-message").load("inc/signupadmin.php", {
              staffName: staffName,
              staffEmail: staffEmail,
              staffId: staffId,
              staffPhoneNo: staffPhoneNo,
              staffPass: staffPass
            });
          });
      });

  </script>
</body>

</html>
