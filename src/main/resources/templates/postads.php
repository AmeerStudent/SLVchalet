<!-- <?php
session_start();
if (!isset($_SESSION['Admin'])) {
    header("Location:login.php");
}


?> -->

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

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link th:href="@{assets/vendor/bootstrap/css/bootstrap.min.css}" rel="stylesheet">
    <link th:href="@{assets/vendor/bootstrap-icons/bootstrap-icons.css}" rel="stylesheet">
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link th:href="@{assets/css/style.css}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="dist/assets/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="dist/assets/jquery-file-upload/js/jquery.iframe-transport.js"></script>
    <script src="dist/assets/jquery-file-upload/js/jquery.fileupload.js"></script>

</head>

<body>
    <!-- ======= Header ======= -->
    <!-- <?php include 'inc/header.php' ?> -->
    <!-- ======= Hero Section ======= -->

    <div class="container" style="margin-top:150px;">
        <div class="container">
            <h2>Create new facilities</h2>
            <hr>
            <div class="row">
                <div class="col-md-8 " style=" margin: auto;width: 50%;border: 3px solid #4154f1;padding: 10px;">
                    <div class="container">
                        <div>
                            
                            <form method="post" th:action="@{/postads}" modelAttribute="postads" th:object="(${postads})">
                                <h4>Please fill in the form</h4>
                        
                                <!-- Facility Id (User input) -->
                                <div class="form-group">
                                    <p class="input-title">Facility ID</p>
                                    <input type="text" id="facilityId" name="facilityId" class="form-control" placeholder="Enter Facility ID" required>
                                </div>
                        
                                <!-- Facility Status -->
                                <div class="form-group">
                                    <p class="input-title">Facility Status</p>
                                    <select id="facilityStatus" name="facilityStatus" class="form-control" required>
                                        <option value="available">Available</option>
                                        <option value="notAvailable">Not Available</option>
                                    </select>
                                </div>
                        
                                <!-- Facility Price -->
                                <div class="form-group">
                                    <p class="input-title">Facility Price</p>
                                    <input type="text" id="facilityPrice" name="facilityPrice" class="form-control" placeholder="Facility Price"
                                        required>
                                </div>
                        
                                <!-- Facility Name -->
                                <div class="form-group">
                                    <p class="input-title">Facility Name</p>
                                    <input type="text" id="facilityName" name="facilityName" class="form-control" placeholder="Facility Name"
                                        required>
                                </div>
                        
                                <!-- Facility Quantity -->
                                <div class="form-group">
                                    <p class="input-title">Facility Quantity</p>
                                    <input type="text" id="facilityQtty" name="facilityQtty" class="form-control"
                                        placeholder="Facility Quantity" required>
                                </div>
                        
                                <!-- Facility Description -->
                                <div class="form-group">
                                    <p class="input-title">Facility Description</p>
                                    <textarea name="facilityDescription" class="form-control" rows="10"
                                        placeholder="Write anything about this facility..." required></textarea>
                                </div>
                        
                                <!-- Facility Type -->
                                <div class="form-group">
                                    <p class="input-title">Facility Type</p>
                                    <select id="facilityType" name="facilityType" class="form-control" required>
                                        <option value="room">Room</option>
                                        <option value="equipment">Equipment</option>
                                    </select>
                                </div>
                        
                                <!-- Room Category (if facility type is room) -->
                                <div class="form-group" id="roomCategoryContainer" style="display: none;">
                                    <p class="input-title">Room Category</p>
                                    <select id="roomCategory" name="roomCategory" class="form-control">
                                        <option value="riverView">River View</option>
                                        <option value="nonRiverView">Non River View</option>
                                    </select>
                                </div>
                        
                                <!-- Equipment Type (if facility type is equipment) -->
                                <div class="form-group" id="equipmentTypeContainer" style="display: none;">
                                    <p class="input-title">Equipment Type</p>
                                    <select id="equipmentType" name="equipmentType" class="form-control">
                                        <option value="recreation">Recreation</option>
                                        <option value="hospitality">Hospitality</option>
                                    </select>
                                </div>
                        
                                <!-- Facility Picture -->
                                <div class="form-group">
                                    <p class="input-title">Facility Picture</p>
                                    <input type="file" id="facilityPic" name="facilityPic" onchange="preview_image();" required />
                                </div>
                        
                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button type="submit" value="Submit" class="btn btn-primary">Add Facility</button>
                                </div>
                        
                            </form>
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
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    </body>

</html>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/validator.js"></script>
    <script src="dist/assets/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="dist/assets/jquery-file-upload/js/jquery.iframe-transport.js"></script>
    <script src="dist/assets/jquery-file-upload/js/jquery.fileupload.js"></script>

<!-- JavaScript for showing/hiding additional fields based on selected facility type -->
<script>
    document.getElementById('facilityType').addEventListener('change', function () {
        var roomCategoryContainer = document.getElementById('roomCategoryContainer');
        var equipmentTypeContainer = document.getElementById('equipmentTypeContainer');

        if (this.value === 'room') {
            roomCategoryContainer.style.display = 'block';
            equipmentTypeContainer.style.display = 'none';
        } else if (this.value === 'equipment') {
            roomCategoryContainer.style.display = 'none';
            equipmentTypeContainer.style.display = 'block';
        } else {
            roomCategoryContainer.style.display = 'none';
            equipmentTypeContainer.style.display = 'none';
        }
    });
</script>

    <!-- <script>
        // For Variation // 
        $(document).ready(function() {
            $("#variation").on("change", function() {
                var numInputs = $(this).val();
                $('#var-container').html('');
                for (var i = 1; i <= numInputs; i++) {
                    var j = i * 1;
                    var $section = $('<div class="variation" style="display:inline-flex"; ><div class="form-group" ><p class="input-title" >Title Variation ' + j + '<input type="" id="var-title[]" name="var-title[]" class="form-control" placeholder="Title Variation ' + j + '" required></div><div class="form-group"><p class="input-title" >Quantity Variation ' + j + '</p><input min="1" type="number" id="var-quan[]" name="var-quan[]" class="form-control" placeholder="Quantity Variation ' + j + '"></div><div class="form-group"><p class="input-title" >[RM]</p><input min="0" type="number" step="any" id="var-price[]" name="var-price[]" class="form-control" placeholder="Price for Variation  ' + j + '" required></div></div>');
                    $('#var-container').append($section);
                }
            });

            $("#reset").click(function() {
                $('#image_preview').html("");
            })

            $("#type").change(function() {
                var selectedType = $(this).children("option:selected").val();
                if (selectedType == 1) {
                    $("#type1").text("Food And Beverages");
                    $("#type2").text("Fashion");
                    $("#type3").text("Electronics");
                    $("#type4").text("Others");
                } else if (selectedType == 2) {
                    $("#type1").text("Delivery Service");
                    $("#type2").text("Educational Service");
                    $("#type3").text("Cleaning Service");
                    $("#type4").text("Others");
                }
            });


        });

        function preview_image() {
            var total_file = document.getElementById("upload_file").files.length;
            if (total_file > 3) {
                alert("You can only upload 3 images per ads.");
                const file = document.getElementById('upload_file');
                file.value = '';
            } else {
                for (var i = 0; i < total_file; i++) {
                    $('#image_preview').append("<img height=100px; src='" + URL.createObjectURL(event.target.files[i]) + "'><br>");
                }
            }
        }

        function notification() {
            Swal.fire(
                'You have succesfully post your ads!',
                'We will now redirect you to profile page.',
                'success'
            ).then(function() {
                window.location = "profile.php";
            });
        }
    </script> -->


    <!-- <?php
    if (isset($_SESSION['success'])) {
        echo '<script type="text/javascript">notification();</script>';
        unset($_SESSION['success']);
    }
    ?> -->
