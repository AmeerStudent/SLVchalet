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
    <link href="assets/img/.png" rel="icon">
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

    <div class="container" style="margin-top:150px; min-height:90vh;"></div>
    <li><a href="#profile"><strong>Profile</strong></a></li>
    <li><a href="#contact"><strong>Contact</strong></a></li>
    <a href="#contact"></a><div id="contact"></div>
    <a href="#list"></a><div id="list"></div>
    
</body>

        <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Pic</th>
                            <th scope="col">Username</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">User Type</th>
                            <th scope="col">Address</th>
                            <th scope="col">Delete</th>
                            <th scope="col">Verify</th>
                        </tr>
                    </thead>
                </table>

                    <tbody>
                        <?php
                        $row_num = 1;
                        $query = "SELECT * FROM user WHERE acc_status = 'Unverified' ";
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
                                <td><?php echo $row['gender'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['phone_num'] ?></td>
                                <td><?php echo $row['user_type'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td>
                                  <button name='delete' class="btn btn-danger" value="<?php echo $row['username'] ?>" id="btn-user">Delete User</button>
                                </td>
                                <td>
                                    <button class="btn btn-primary" value="<?php echo $row['username'] ?>" id="btn-verify">Verify User</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Pic</th>
                            <th scope="col">Username</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">User Type</th>
                            <th scope="col">Address</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $row_num = 1;
                        $query = "SELECT * FROM user WHERE acc_status = 'Verified' ";
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
                                <td><?php echo $row['gender'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['phone_num'] ?></td>
                                <td><?php echo $row['user_type'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td>
                                    <button name='delete' class="btn btn-danger" value="<?php echo $row['username'] ?>" id="btn-user">Delete User</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Pic</th>
                            <th scope="col">Product Title</th>
                            <th scope="col">Type of Ads</th>
                            <th scope="col">Category</th>

                            <th scope="col">Posted By</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

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

                </table>
            </div>
            <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Pic</th>
                            <th scope="col">Username</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">        </th>
                            <th scope="col">Address</th>
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
                                <td><?php echo $row['gender'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['phone_num'] ?></td>
                                <td><?php echo $row['user_type'] ?></td>
                                <td><?php echo $row['address'] ?></td>
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
                &copy; Copyright <strong><span>Nex Instruments</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>
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
                'Ads succesfully deleted',
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
