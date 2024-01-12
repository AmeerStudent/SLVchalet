<?php
include 'inc/connection.php';
session_start();
?>

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
  <link href="assets/img/slv.png" rel="icon">
  <link href="assets/img/slv.png" rel="nex1-icon">

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

  <!-- ======= Header ======= -->
  <?php include 'inc/header.php'; ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Relaxing your mind and ease your life with  </h1>
          <h1 style="color:#4154f1" data-aos="fade-up" data-aos-delay="400">Sungai Lopo Reservation </h1>
          <h2 data-aos="fade-up" data-aos-delay="400">The best chalet view, Book now !</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="signup.php" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Sign Up Now!</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 sgview1" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/sgview1.jpeg" class="img-fluid" alt="" width="500" height="500">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <div class="row gx-0">
          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>About Us</h3>
              <p>Sungai Lopo Village is a resort located at Hulu Langat, Selangor. This resort
was established and started operation on 20
th April 2010. The resort is owned by
Shalizam bin Ismail and managed by his family. The resort currently has a number of
6 staff. The resort is usually visited by 20-30 customers on weekdays and 50-100
customers on weekends. The main income for the resort comes from people that
book chalets or walk in for recreation since the chalets are just by the river. Besides
that, this resort is also open for big group activities such as family day, school camps
or team building. Moreover, Sungai Lopo Village also generates some side income
from multiple other ways such as providing catering services and handling extreme
outdoor activities.
</p>
              <div class="text-center text-lg-start">
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-in" data-aos-delay="200">
            <img src="assets/img/about-us.png" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- End About Section -->

    <!-- ======= Values Section ======= -->
    <section id="values" class="values">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h2>Our Mission </h2>
          <p>A platform for Sungai Lopo Reservation </p>
        </header>
        <div class="row">
          <div class="col-lg-4">
            <div class="box" data-aos="fade-up" data-aos-delay="200">
              <img src="assets/img/values-1.png" class="img-fluid" alt="">
              <h3>A homestay reservation </h3>
              <p>A homestay reservation system is a piece of software created to simplify the
                  booking process for guests who choose to stay in private homes over conventional
                  hotels or other types of for-profit accommodations. The system offers a user-friendly
                  interface for visitors to search for available lodging and book bookings online, as well
                  as the ability for property owners to display their houses or flats and manage
                  reservations.
                  </p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="fade-up" data-aos-delay="400">
              <img src="assets/img/values-2.png" class="img-fluid" alt="">
              <h3>Customer</h3>
              <p>Customer satisfied with our services</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="fade-up" data-aos-delay="600">
              <img src="assets/img/values-3.png" class="img-fluid" alt="">
              <h3>Facilities.</h3><p> We provided a lot of facilities which chalet with river view , BBQ , Rock Climbing and many more .</p>
            </div>
          </div>

        </div>

      </div>

    </section><!-- End Values Section -->

    <!-- ======= Services Section ======= 
    <section id="services" class="services">
      <header class="section-header">
        <h2>Facilities</h2>
      </header>
      <div class="container" data-aos="fade-up">
        <form method="GET" action="services.php">
          <div class="search-header">
            <p>Looking for facilities ?</p>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="title" placeholder="Personal Tutor, Cleaner etc." aria-label="Personal Tutor, Cleaner etc." aria-describedby="basic-addon2" required>
              <input name="category" value="1" hidden>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary">
                  <span class="material-icons">
                    search
                  </span>
                </button>
              </div>
            </div>
          </div>
        </form>

        <div class="row gy-4">
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-box green">
              <img src="assets/img/services-1-2.png" width="200px" alt="">
              <h3>Chalet </h3>
              <p>Chalet we have view river and no view river , customer will enjoy both of the view</p>
              <a href="services.php?title=&category=2" class="read-more"><span>Search Now !</span></a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-box red">
              <img src="assets/img/services-4.png" width="200px" alt="">
              <h3>Activities</h3>
              <p>A lot of activities that we provided . For example , Rock Climbing , Rafting , Archery and many more that you will enjoy !  </p>
              <a href="services.php?title=&category=3" class="read-more"><span>Search Now !</span></a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-box purple">
              <img src="assets/img/services-3.png" width="200px" alt="">
              <h3>Equipment </h3>
              <p>This include equipment for BBQ and so on.</p>
              <a href="services.php?title=&category=4" class="read-more"><span>Search Now !</span></a>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Services Section -->

    
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <p>Contact Us</p>
          <div class="social-media" style="display: flex;justify-content: center;">
            <!-- <a style="padding: 20px;font-size: 200px; border-radius: 50%;" href="https://twitter.com/iiumpocketmoney" class="fa fa-twitter "></a> -->
            <a style="padding: 20px;font-size: 100px; border-radius: 50%;" href="https://www.facebook.com/sglopovillage?mibextid=2JQ9oc" class="fa fa-facebook"></a>
            <!-- <a style="padding: 20px;font-size: 200px; border-radius: 50%;" href="https://www.instagram.com/iiumpocketmoney/" class="fa fa-instagram"></a> -->
          </div>



        </header>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>