<?php 
  session_start();
  if (!isset($_SESSION['User'])) {
    header("Location: login.php");
  }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SLV</title>
    <!-- Favicons -->
    <link href="assets/img/slv.png" rel="icon">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</head>

<body>
    <?php include 'inc/header.php'; ?>

    <div class="container" style="margin-top:100px;">
        <div class="row">

            <div class="col-md-8" style=" margin: auto;width: 50%;padding: 10px;">
                <div class="profile">
                    <h1>Update Profile</h1>
                    <div class="card" style="height: 100%;">
                        <div class="card-body" style="display: flex; flex-direction: column;">
                            <form method="post" action="inc/changepassword.php">
                                <div class="container" style="min-height:70vh">
                                    <p><strong>Current Password</strong></p>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="currentpassword" name="currentpassword" placeholder="Enter current password" aria-label="currentpassword" aria-describedby="basic-addon2" >
                                    </div>
                                    <p><strong>New Password</strong></p>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter new password" aria-label="newpassword" aria-describedby="basic-addon2" >
                                    </div>
                                    <p><strong>Confirm New Password</strong></p>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="confirmnewpassword" name="confirmnewpassword" placeholder="Confirm new password" aria-label="confirmnewpassword" aria-describedby="basic-addon2" >
                                    </div>
                                    <p class="form-message"></p>                      

                                    <div class="center-btn">
                                        <button class="profile-update" id="btn-submit" name="submit" style="font-weight:500">Update Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer" class="footer">
        <div class="container">
            <div class="copyright">
                &copy;  <strong><span>Sungai Lopo Chalet Reservation</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

</html>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
     $(document).ready(function(){
        $("form").submit(function(event) {
            event.preventDefault();
            var currentpassword = $("#currentpassword").val();
            var newpassword = $("#newpassword").val();
            var confirmnewpassword = $("#confirmnewpassword").val();

          $(".form-message").load("inc/changepassword.php", {
            currentpassword: currentpassword,
            newpassword: newpassword,
            confirmnewpassword: confirmnewpassword
            });
          });
      });
  </script>
