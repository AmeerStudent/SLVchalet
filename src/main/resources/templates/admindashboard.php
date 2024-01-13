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

    <title>SLV</title>

    <!-- Favicons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/img/slv.png" rel="icon">
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
    <!-- ======= Header ======= -->
    <?php include 'inc/header.php'; ?>

    <!-- ======= Hero Section ======= -->
    <div class="container" style="margin-top:150px; min-height:90vh;">
        <h1>Admin Dashboard</h1>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sales Report</a>
            </li>
            
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"></a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <table class="table">
                    <thead class="thead-dark">
                       <head>
  <title>Monthly Sales Report</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      text-align: left;
      padding: 8px;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #A3E4DB;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    function searchByMonth() {
      var input, filter, table, tr, td, i;
      input = document.getElementById("searchInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("salesTable");
      tr = table.getElementsByTagName("tr");
      
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2]; // Index 2 represents the Date column
        if (td) {
          var date = new Date(td.textContent);
          var month = date.toLocaleString('default', { month: 'long' }).toUpperCase();
          if (month.indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
    
    function generateReport() {
      // Code to generate the sales report goes here
      // Example: Redirecting to a new page with a graph
      var salesData = [1000, 2000, 1500, 3000, 2500, 1800]; // Sample sales data
      
      // Store the sales data in session storage
      sessionStorage.setItem("salesData", JSON.stringify(salesData));
      
      // Redirect to the sales report page
      window.location.href = "sales-report.html";
    }
  </script>
</head>
<body>
  <h1>Monthly Sales Report</h1>
  <input type="month" id="searchInput" placeholder="Select a month">
  <button onclick="searchByMonth()">Search</button>
  <br><br>
  <table id="salesTable">
    <thead>
      <tr>
        <th>Facility Type</th>
        <th>Number of Reservations</th>
        <th>Date</th>
        <th>Price</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Room</td>
        <td>10</td>
        <td>2023-07-01</td>
        <td>$100.00</td>
        <td>$1000.00</td>
      </tr>
      <tr>
        <td>Conference Hall</td>
        <td>5</td>
        <td>2023-07-05</td>
        <td>$200.00</td>
        <td>$1000.00</td>
      </tr>
      <!-- Add more rows for each facility type and sales entry -->
    </tbody>
    <tfoot>
      <tr>
        <th colspan="4">Total Sales:</th>
        <th>$2000.00</th>
      </tr>
    </tfoot>
  </table>
  <br>
  <button onclick="generateReport()">Generate Monthly Sales Report</button>
  <script>
        function generateReport() {
            window.location.replace("generatereport.php");
        }
    </script>
</body>
                    </thead>

                   
            </div>
            
            </div>
            <div class="tab-pane fade " id="list" role="tabpanel" aria-labelledby="list-tab">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Pic</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">        </th>
                            <th scope="col">Backup</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $row_num = 1;
                        $query = "SELECT * FROM admin ";
                        $result = mysqli_query($sql_connect, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr class="align-middle">
                                <td><?php echo $row_num;
                                    $row_num++ ?></td>
                                <td>
                                    <img src="images/profile/<?php echo $row['profile_pic'] ?>" style="border-radius:50%;object-fit:scale-down;  width: 70px;">
                                </td>
                                <td><a href="viewprofile.php?id=<?php echo $row['username'] ?>"><?php echo $row['username'] ?></a></td>
                                <td><?php echo $row['full_name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['phone_num'] ?></td>
                                <td><?php echo $row['user_type'] ?></td>
                                <td><?php echo rand(10000,90000)?> </td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
                title: 'Are you sure that you want to delete this flower?',
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
                            window.location.assign("inc/deleteads.php?id=" + value);
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        });

        $(document).on('click', '#btn-verify', function(e) {
            e.preventDefault();
            var value = $(this).attr('value');
            Swal.fire({
                title: 'Are you sure that you want to verify this user ?',
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
                            window.location.assign("inc/verify.php?id=" + value);
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        });

        $(document).on('click', '#btn-user', function(e) {
            e.preventDefault();
            var value = $(this).attr('value');
            Swal.fire({
                title: 'Are you sure that you want to delete this user ?',
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
                            window.location.assign("inc/deleteprofile.php?id=" + value);
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        });


        function deleteAds() {
            Swal.fire(
                'Success',
                'Ads succesfully deleted',
                'success'
            );
            document.getElementById("home-tab").className = "nav-link";
            document.getElementById("home").className = "tab-pane";

            document.getElementById("contact-tab").className += " active show";
            document.getElementById("contact").className += " active show";
        }

        function verify() {
            Swal.fire(
                'Success',
                'Ads succesfully verify',
                'success'
            );
            document.getElementById("home-tab").className = "nav-link";
            document.getElementById("home").className = "tab-pane";

            document.getElementById("profile-tab").className += " active show";
            document.getElementById("profile").className += " active show";
        }

        function deleteuser() {
            Swal.fire(
                'Success',
                'User succesfully deleted',
                'success'
            );
        }
    </script>
    <?php
    if (isset($_SESSION['delete'])) {
        echo '<script type="text/javascript">deleteAds();</script>';
        unset($_SESSION['delete']);
    }
    if (isset($_SESSION['verify'])) {
        echo '<script type="text/javascript">verify();</script>';
        unset($_SESSION['verify']);
    }
    if (isset($_SESSION['deleteuser'])) {
        echo '<script type="text/javascript">deleteuser();</script>';
        unset($_SESSION['deleteuser']);
    }
    ?>
</body>

</html>
