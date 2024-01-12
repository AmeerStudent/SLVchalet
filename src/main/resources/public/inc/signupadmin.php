<?php
include 'connection.php';

if (isset($_POST['signup']) !== "") {
    $gender =  $_POST['gender'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $icnumber = $_POST['icnumber'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $homeaddress = $_POST['homeaddress'];

    $errorEmpty = false;
    $errorEmail = false;
    $errorPassword = false;
    $errorWeakPassword = false;
    $errorEmptyUsername = false;
    $errorEmptyFullname = false;
    $errorEmptyEmail = false;
    $errorEmptyicnumberid = false;
    $errorEmptyPhonenumber = false;
    $errorEmptyPassword = false;
    $errorEmptyConfirmpassword = false;
    $errorEmptyGender = false;
    $errorEmptyRealaddress = false;
    $errorFullName = false;
    

    if ($gender == 1) {
        $gender = "Male";
    } else if ($gender == 2) {
        $gender = "Female";
    }
    if (!preg_match('/^[\p{L} ]+$/u', $fullname)) {
        echo "<span class='form-error'> Full name only allows alphabet and space only! </span> <br>";
        $errorFullName = true;
    }

    if (empty($username)) {
        echo "<span class='form-error'> Fill in username ! </span> <br>";
        $errorEmptyUsername = true;
    } else {
        $errorEmptyUsername = false;
    }

    if (empty($fullname)) {
        echo "<span class='form-error'> Fill in full name ! </span> <br> ";
        $errorEmptyFullname = true;
    } else {
        $errorEmptyFullname = false;
    }

    if (empty($email)) {
        echo "<span class='form-error'> Fill in email ! </span> <br>";
        $errorEmptyEmail = true;
    } else {
        $errorEmptyEmail = false;
    }

    if (empty($icnumber)) {
        echo "<span class='form-error'> Fill in your ID ! </span> <br>";
        $errorEmptyicnumber = true;
    } else {
        $errorEmptyicnumber = false;
    }

    if (empty($phonenumber)) {
        echo "<span class='form-error'> Fill in your phone number ! </span> <br>";
        $errorEmptyPhonenumber = true;
    } else {
        $errorEmptyPhonenumber = false;
    }

    if (empty($password)) {
        echo "<span class='form-error'> Fill in your password ! </span> <br>";
        $errorEmptyPassword = true;
    } else {
        $errorEmptyPassword = false;
    }

    if (empty($confirmpassword)) {
        echo "<span class='form-error'> Fill in confirm password ! </span> <br>";
        $errorEmptyConfirmpassword = true;
    } else {
        $errorEmptyConfirmpassword = false;
    }

    if (empty($gender)) {
        echo "<span class='form-error'> Select gender ! </span> <br>";
        $errorEmptyGender = true;
    } else {
        $errorEmptyGender = false;
    }

    if ((empty($homeaddress))) {
        echo "<span class='form-error'> Fill in your address ! </span> <br>";
        $errorEmptyRealaddress = true;
    } else {
        $errorEmptyRealaddress = false;
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<span class='form-error'> Write a valid e-mail address ! </span> <br>";
        $errorEmail = true;
    } else if ($confirmpassword != $password) {
        echo "<span class='form-error'> Password doesn't match ! </span> <br>";
        $errorPassword = true;
    } else if (strlen($password) < 8) {
        echo "<span class='form-error'> Password must contain at least 8 character </span> <br>";
        $errorWeakPassword = true;
    } else if ($errorEmptyUsername == false && $errorEmptyFullname == false && $errorEmptyEmail == false && $errorEmptyicnumber == false && $errorEmptyPhonenumber == false && $errorEmptyPassword == false && $errorEmptyConfirmpassword == false &&  $errorEmptyGender == false && $errorEmptyRealaddress == false && $errorFullName == false) {


        //Check if email is already registered 
        $queryCheckEmail = "SELECT * FROM `admin` WHERE email = '$email' ";
        $sqlCheckEmail = mysqli_query($sql_connect, $queryCheckEmail);
        $rowEmail = mysqli_fetch_assoc($sqlCheckEmail);
        if ($rowEmail > 0) {
            $checkEmail = false;
            echo "<span class='form-success'>Email is already used!</span> <br>";
        } else {
            $checkEmail = true;
        }

        //Check if ID is already registered 
        $queryCheckID = "SELECT * FROM `admin` WHERE icnumber = '$icnumber' ";
        $sqlCheckID = mysqli_query($sql_connect, $queryCheckID);
        $rowID = mysqli_fetch_assoc($sqlCheckID);
        if ($rowID > 0) {
            $checkID = false;
            echo "<span class='form-success'>ID is already registered!</span> <br>";
        } else {
            $checkID = true;
        }

        //Check if username is already registered 
        $queryCheckUsername = "SELECT * FROM `admin` WHERE username = '$username' ";
        $sqlCheckUsername = mysqli_query($sql_connect, $queryCheckUsername);
        $rowUsername = mysqli_fetch_assoc($sqlCheckUsername);
        if ($rowUsername > 0) {
            $checkUsername = false;
            echo "<span class='form-success'>Username is already taken!</span> <br>";
        } else {
            $checkUsername = true;
        }

        //Insert New admin Into DB
        if ($checkID == true && $checkEmail  == true && $checkUsername == true) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO admin (icnumber,password,username,full_name,gender,email,phone_num,address,profile_pic) VALUES ('$icnumber','$hash','$username','$fullname','$gender','$email','$phonenumber','$homeaddress','profile.png')";
            $sql = mysqli_query($sql_connect, $query);

            if ($sql) {
                echo "<span class='form-success'>Successfully Sign Up !</span>";
                $signupSuccess = true;
            } else {
                echo "Error detected, Please try again later";
            }
        }
    }
} else {
    echo "Error detected Try again.";
}
?>

<script>
    $("#username, #fullname, #email, #icnumber, #phonenumber, #homeaddress, #password, #confirmpassword, #gender").removeClass("input-error");

    var errorPassword = "<?php echo $errorPassword ?>";
    var errorEmpty = "<?php echo $errorEmpty ?>";
    var errorEmail = "<?php echo $errorEmail ?>";
    var errorWeakPassword = "<?php echo $errorWeakPassword ?>";
    var errorEmptyRealaddress = "<?php echo $errorEmptyRealaddress ?>";
    var errorEmptyUsername = "<?php echo $errorEmptyUsername ?>";
    var errorEmptyFullname = "<?php echo $errorEmptyFullname ?>";
    var errorEmptyEmail = "<?php echo $errorEmptyEmail ?>";
    var errorEmptyicnumber = "<?php echo $errorEmptyicnumber ?>";
    var errorEmptyPhonenumber = "<?php echo $errorEmptyPhonenumber ?>";
    var errorEmptyPassword = "<?php echo $errorEmptyPassword ?>";
    var errorEmptyConfirmpassword = "<?php echo $errorEmptyConfirmpassword ?>";
    var errorEmptyGender = "<?php echo $errorEmptyGender ?>";
    var errorFullName = "<?php echo $errorFullName ?>";
    var success = "<?php echo $signupSuccess ?>";

    if (success == true) {
        Swal.fire(
            'You have succesfully successfully registered new Staff!',
            'We will now redirect you to main page.',
            'success'
        ).then(function() {
            window.location = "admindashboard.php";
        });
    }
    if (errorEmptyRealaddress == true) {
        $("#realaddress").addClass("input-error");
    }
    if (errorFullName == true) {
        $("#fullname").addClass("input-error");
    }
    if (errorEmptyUsername == true) {
        $("#username").addClass("input-error");
    }
    if (errorEmptyFullname == true) {
        $("#fullname").addClass("input-error");
    }
    if (errorEmptyEmail == true) {
        $("#email").addClass("input-error");
    }
    if (errorEmptyicnumber == true) {
        $("#icnumber").addClass("input-error");
    }
    if (errorEmptyPhonenumber == true) {
        $("#phonenumber").addClass("input-error");
    }
    if (errorEmptyPassword == true) {
        $("#password").addClass("input-error");
    }
    if (errorEmptyConfirmpassword == true) {
        $("#confirmpassword").addClass("input-error");
    }

    if (errorEmptyGender == true) {
        $("#gender").addClass("input-error");
    }

    if (errorEmpty == true) {
        $("#username, #fullname, #email, #icnumber, #phonenumber, #realaddress, #password, #confirmpassword, #gender").addClass("input-error");
    }
    if (errorEmail == true) {
        $("#email").addClass("input-error");
    }
    if (errorPassword == true) {
        $("#confirmpassword, #password").addClass("input-error");
    }

    if (errorWeakPassword == true) {
        $("#confirmpassword, #password").addClass("input-error");
    }
</script>