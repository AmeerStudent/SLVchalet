<?php
include 'inc/connection.php';
session_start();

$usernameSESSION = $_SESSION['User'];
$query = "SELECT * FROM user WHERE username = '$usernameSESSION' ";
$result = mysqli_query($sql_connect, $query);
$row = mysqli_fetch_assoc($result);

if (!isset($_SESSION['User'])) {
  header("Location: login.php");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SLV</title>

  <!-- Favicons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="assets/img/slv.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link th:href="@{assets/vendor/bootstrap/css/bootstrap.min.css}" rel="stylesheet">
  <link th:href="@{assets/vendor/bootstrap-icons/bootstrap-icons.css}" rel="stylesheet">
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
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="/index" class="logo d-flex align-items-center">
          
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a style="text-decoration: none;" class="nav-link scrollto" th:href="@{/index}">Home</a></li>
                <li><a class="nav-link scrollto"th:href="@{/product}">Facilities</a></li>

<!--               <li th:if="${#session.containsKey('User')}"> 
                    <a style="text-decoration: none;" class="nav-account">
                        <span class="material-icons">account_circle</span>
                        <span th:text="${#session['User']}"></span> <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul> -->
                        <li><a style="text-decoration: none;" th:href="@{/profile}">Profile</a></li>
                        <li><a style="text-decoration: none;" th:href="@{/inc/logout}">Logout</a></li>
                        <li class="dropdown">
                            <a style="text-decoration: none;" href="#"><span>Setting</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a style="text-decoration: none;" th:href="@{/updateprofile}">Update Profile</a></li>
                                <li><a style="text-decoration: none;" th:href="@{/updatepassword}">Change Password</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
<!--                 <li><a class="nav-account" style="text-decoration: none;" href="/cart"><span
                            class="material-icons">shopping_cart</span></a></li>

                <li th:if="${#session.containsKey('Admin')}">
                    <a style="text-decoration: none;" class="nav-account">
                        <span class="material-icons">account_circle</span>
                        <span th:text="${#session['Admin']}"></span> <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>
                        <li><a style="text-decoration: none;" href="/admindashboard">Dashboard</a></li>
                        <li><a style="text-decoration: none;" href="/productadmin">Update Facilities</a></li>
                        <li><a style="text-decoration: none;" href="/postads">Post new ads</a></li>
                        <li><a style="text-decoration: none;" href="/signupadmin">Register New staff</a></li>
                        <li><a style="text-decoration: none;" href="/inc/logout">Logout</a></li>
                    </ul>
                </li>
                <li th:unless="${#session.containsKey('User') or #session.containsKey('Admin')}"> -->
                    <a style="text-decoration: none;" class="nav-account signup" th:href="@{/login}">Customer Login</a>
                    <li><a style="text-decoration: none;" class="nav-account signup" th:href="@{/admin}">Admin Login</a></li>
                    <li><a style="text-decoration: none;" class="nav-account signup" th:href="@{/loginstaff}">Staff Login</a></li>
                </li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <div class="container" style="margin-top:150px;">
    <div class="row">
      <div class="col-lg-6" style="width: 35%;">
        <div class="profile">
          <h1>Profile</h1>
          <div class="card" style="height: 100%;">
            <div class="card-body" style="display: flex; flex-direction: column;">
              <img src="images/profile/<?php echo $row['profile_pic'] ?>" style="border-radius:50%;  width: 100px;" alt="">
              <div class="container">
                <?php if ($row['acc_status'] == 'Verified') {
                ?>
                  <p class="verified align-middle" style="text-align:center; font-size:20px;">
                    <span class="material-icons align-middle">
                      check_circle
                    </span>
                    Verified User
                  </p>
                <?php } else { ?>
                  <p class="verified align-middle" style="text-align:center; font-size:20px;">
                    <span class="material-icons align-middle">
                      error
                    </span>
                    Unverified User
                  </p>
                <?php } ?>
                <p class="title-profile">Full Name :</p>
                <p><?php echo $row['full_name'] ?></p>
                <p class="title-profile">Username :</p>
                <p><?php echo $row['username'] ?></p>
				<p class="title-profile"> IC Number :</p>
                <p><?php echo $row['matricid'] ?></p>
				<p class="title-profile">Gender :</p>
                <p><?php echo $row['gender'] ?></p>
                <p class="title-profile">Address :</p>
                <p><?php echo $row['address'] ?></p>
                <p class="title-profile">Email :</p>
                <p><?php echo $row['email'] ?></p>
				<p class="title-profile">Phone Number :</p>
                <p><?php echo $row['phone_num'] ?></p>

                <div class="center-btn">
                  <button class="profile-update" onclick="location.href='updateprofile.php'">Update Profile</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6" style="width: 65%;">
        <div class="dashboard">
          <div class="title-dashboard d-flex">
            <h1>Dashboard</h1>
            
          </div>


          <div class="card text-center">
            <div class="card-header">
              <ul class="nav nav-tabs" id="myTab" role="tablist">

                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Purchase</a>
                </li>

              </ul>
              <div class="tab-content">
                <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <?php
                  $query2 = "SELECT * FROM var_receipt WHERE username ='$usernameSESSION' AND status = 'Pending' ";
                  $result2 = mysqli_query($sql_connect, $query2);
                  if (mysqli_num_rows($result2) == 0) {
                    echo '<p>You booking purchase is currently empty. Book with us now !</p>';
                  } else {
                    while ($row2 = mysqli_fetch_assoc($result2)) {

                      $querypic = "SELECT pic_name FROM pic_product WHERE product_id = '" . $row2['product_id'] . "'";
                      $resultpic = mysqli_query($sql_connect, $querypic);
                      $pic = mysqli_fetch_assoc($resultpic);

                      $query3 = "SELECT receipt_date FROM receipt WHERE receipt_id = '" . $row2['receipt_id'] . "'";
                      $result3 = mysqli_query($sql_connect, $query3);
                      $date = mysqli_fetch_assoc($result3);

                      $queryphone = "SELECT phone_num FROM user WHERE username = '" . $row2['var_seller'] . "'";
                      $resultphone = mysqli_query($sql_connect, $queryphone);
                      $phonenum = mysqli_fetch_assoc($resultphone);
                  ?>
                      <div class="card-body">
                        <div class="item d-inline-flex">
                          <div class="image" style="max-height: 192px; ">
                            <img style="height:190px; object-fit:scale-down;" src="images/<?php echo $pic['pic_name'] ?>" alt="">
                          </div>
                          <div class="title">
                            <h5><a href="view.php?view_prod=<?php echo $row2['product_id'] ?>"><?php echo $row2['product_title'] ?></a></h5>
                            <p><strong>Variation : </strong><?php echo $row2['var_product_title']; ?></p>
                            <p><strong>Quantity : </strong><?php echo $row2['var_product_quan']; ?></p>
                            <div style="display:flex">
                              <p><strong>Seller : </strong><a href="viewprofile.php?id=<?php echo $row2['var_seller']; ?>"><?php echo $row2['var_seller']; ?></a></p>
                            </div>
                            <div class="btn-prod">
                              <button type="button" class="btn btn-secondary" target="_blank" onclick="window.open('receipt/receipt.php?id=<?php echo $row2['receipt_id'] ?>');">View Receipt</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                  <?php }
                  } ?>
                </div>
                </div>
              </div>
            </div>
          </div>
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
  </footer>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    $(document).on('click', '#btn-submit', function(e) {
      e.preventDefault();
      var value = $(this).attr('value');
      Swal.fire({
        title: 'Are you sure that you have received the item ?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText: `No`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Saving changes!',
            timer: 1000,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading()
              timerInterval = setInterval(() => {
                const content = Swal.getContent()
                if (content) {
                  const b = content.querySelector('b')
                  if (b) {
                    b.textContent = Swal.getTimerLeft()
                  }
                }
              }, 100)
            },
            willClose: () => {
              clearInterval(timerInterval)
            }
          }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
              window.location.assign("inc/received.php?id=" + value);
            }
          })
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })
    });

    $(document).on('click', '#btn-send', function(e) {
      e.preventDefault();
      var value = $(this).attr('value');
      Swal.fire({
        title: 'Are you sure that you have complete the order ?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText: `No`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Saving changes!',
            timer: 1000,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading()
              timerInterval = setInterval(() => {
                const content = Swal.getContent()
                if (content) {
                  const b = content.querySelector('b')
                  if (b) {
                    b.textContent = Swal.getTimerLeft()
                  }
                }
              }, 100)
            },
            willClose: () => {
              clearInterval(timerInterval)
            }
          }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
              window.location.assign("inc/send.php?id=" + value);
            }
          })
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })
    });

    $(document).on('click', '#btn-del', function(e) {
      e.preventDefault();
      var value = $(this).attr('value');
      Swal.fire({
        title: 'Are you sure that you want to delete this profile ?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText: `No`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Delete profile?',
            timer: 1000,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading()
              timerInterval = setInterval(() => {
                const content = Swal.getContent()
                if (content) {
                  const b = content.querySelector('b')
                  if (b) {
                    b.textContent = Swal.getTimerLeft()
                  }
                }
              }, 100)
            },
            willClose: () => {
              clearInterval(timerInterval)
            }
          }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
              window.location.assign("inc/delete.php?id=" + value);
            }
          })
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })
    });

    function notification() {
      Swal.fire(
        'Thank you for shopping with us !',
        'We appreciate if you leave review for the item that you purchased.',
        'success'
      );
      document.getElementById("home-tab").className = "nav-link";
      document.getElementById("home").className = "tab-pane";

      document.getElementById("messages-tab").className += " active";
      document.getElementById("messages").className += " active";
    }

    function review() {
      Swal.fire(
        'We have received your feedback!',
        'Thank you for shopping with us.',
        'success'
      );
      document.getElementById("home-tab").className = "nav-link";
      document.getElementById("home").className = "tab-pane";

      document.getElementById("messages-tab").className += " active";
      document.getElementById("messages").className += " active";
    }

    function updateProfile() {
      Swal.fire(
        'Success !',
        'You have successfully updated your profile detail !',
        'success'
      );
    }

    function updateAds() {
      Swal.fire(
        'Success !',
        'You have successfully updated your ads !',
        'success'
      );
    }

    function deleteAds() {
      Swal.fire(
        'Success !',
        'You have successfully deleted your ads !',
        'success'
      );
    }

    function send() {
      Swal.fire(
        'Success !',
        'You have successfully complete the order !',
        'success'
      );
      document.getElementById("home-tab").className = "nav-link";
      document.getElementById("home").className = "tab-pane";

      document.getElementById("settings-tab").className += " active";
      document.getElementById("settings").className += " active";
    }
  </script>
  <?php
  if (isset($_SESSION['received'])) {
    echo '<script type="text/javascript">notification();</script>';
    unset($_SESSION['received']);
  }
  if (isset($_SESSION['review'])) {
    echo '<script type="text/javascript">review();</script>';
    unset($_SESSION['review']);
  }
  if (isset($_SESSION['updateprofile'])) {
    echo '<script type="text/javascript">updateProfile();</script>';
    unset($_SESSION['updateprofile']);
  }
  if (isset($_SESSION['updateads'])) {
    echo '<script type="text/javascript">updateAds();</script>';
    unset($_SESSION['updateads']);
  }
  if (isset($_SESSION['deleteads'])) {
    echo '<script type="text/javascript">deleteAds();</script>';
    unset($_SESSION['deleteads']);
  }
  if (isset($_SESSION['send'])) {
    echo '<script type="text/javascript">send();</script>';
    unset($_SESSION['send']);
  }
  ?>
</body>

</html>
