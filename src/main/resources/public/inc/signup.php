<?php
include 'connection.php';

if (isset($_POST['signup']) !== "") {
    $usertype = $_POST['usertype'];
    $gender =  $_POST['gender'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $matricid = $_POST['matricid'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $realaddress = $_POST['realaddress'];


    $errorEmpty = false;
    $errorEmail = false;
    $errorPassword = false;
    $errorWeakPassword = false;
    $errorEmptyUsername = false;
    $errorEmptyFullname = false;
    $errorEmptyEmail = false;
    $errorEmptyMatricid = false;
    $errorEmptyPhonenumber = false;
    $errorEmptyPassword = false;
    $errorEmptyConfirmpassword = false;
    $errorEmptyUsertype = false;
    $errorEmptyGender = false;
    $errorEmptyRealaddress = false;
    $errorFullName = false;
    

    if ($usertype == 1) {
        $usertype = "Staff";
    } else if ($usertype == 2) {
        $usertype = "Student";
    }

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

    if (empty($matricid)) {
        echo "<span class='form-error'> Fill in your ID ! </span> <br>";
        $errorEmptyMatricid = true;
    } else {
        $errorEmptyMatricid = false;
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

    if (empty($usertype)) {
        echo "<span class='form-error'> Please select user type ! </span> <br>";
        $errorEmptyUsertype = true;
    } else {
        $errorEmptyUsertype = false;
    }

    if (empty($gender)) {
        echo "<span class='form-error'> Select gender ! </span> <br>";
        $errorEmptyGender = true;
    } else {
        $errorEmptyGender = false;
    }

    if (empty($realaddress)) {
        echo "<span class='form-error'> Fill in your address ! </span> <br>" . $realaddress . $homeaddress ;
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
    } else if ($errorEmptyUsername == false && $errorEmptyFullname == false && $errorEmptyEmail == false && $errorEmptyMatricid == false && $errorEmptyPhonenumber == false && $errorEmptyPassword == false && $errorEmptyConfirmpassword == false && $errorEmptyUsertype == false && $errorEmptyGender == false && $errorEmptyRealaddress == false && $errorFullName == false) {


        //Check if email is already registered 
        $queryCheckEmail = "SELECT * FROM `user` WHERE email = '$email' ";
        $sqlCheckEmail = mysqli_query($sql_connect, $queryCheckEmail);
        $rowEmail = mysqli_fetch_assoc($sqlCheckEmail);
        if ($rowEmail > 0) {
            $checkEmail = false;
            echo "<span class='form-success'>Email is already used!</span> <br>";
        } else {
            $checkEmail = true;
        }

        //Check if ID is already registered 
        $queryCheckID = "SELECT * FROM `user` WHERE matricid = '$matricid' ";
        $sqlCheckID = mysqli_query($sql_connect, $queryCheckID);
        $rowID = mysqli_fetch_assoc($sqlCheckID);
        if ($rowID > 0) {
            $checkID = false;
            echo "<span class='form-success'>ID is already registered!</span> <br>";
        } else {
            $checkID = true;
        }

        //Check if username is already registered 
        $queryCheckUsername = "SELECT * FROM `user` WHERE username = '$username' ";
        $sqlCheckUsername = mysqli_query($sql_connect, $queryCheckUsername);
        $rowUsername = mysqli_fetch_assoc($sqlCheckUsername);
        if ($rowUsername > 0) {
            $checkUsername = false;
            echo "<span class='form-success'>Username is already taken!</span> <br>";
        } else {
            $checkUsername = true;
        }

        //Insert New User Into DB
        if ($checkID == true && $checkEmail  == true && $checkUsername == true) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO user(matricid,password,username,full_name,gender,email,phone_num,user_type,address,profile_pic,acc_status) VALUES ('$matricid','$hash','$username','$fullname','$gender','$email','$phonenumber','$usertype','$realaddress','profile.png','Unverified')";
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
    $("#username, #fullname, #email, #matricid, #phonenumber, #realaddress, #password, #confirmpassword, #gender, #usertype").removeClass("input-error");

    var errorPassword = "<?php echo $errorPassword ?>";
    var errorEmpty = "<?php echo $errorEmpty ?>";
    var errorEmail = "<?php echo $errorEmail ?>";
    var errorWeakPassword = "<?php echo $errorWeakPassword ?>";
    var errorEmptyRealaddress = "<?php echo $errorEmptyRealaddress ?>";
    var errorEmptyUsername = "<?php echo $errorEmptyUsername ?>";
    var errorEmptyFullname = "<?php echo $errorEmptyFullname ?>";
    var errorEmptyEmail = "<?php echo $errorEmptyEmail ?>";
    var errorEmptyMatricid = "<?php echo $errorEmptyMatricid ?>";
    var errorEmptyPhonenumber = "<?php echo $errorEmptyPhonenumber ?>";
    var errorEmptyPassword = "<?php echo $errorEmptyPassword ?>";
    var errorEmptyConfirmpassword = "<?php echo $errorEmptyConfirmpassword ?>";
    var errorEmptyUsertype = "<?php echo $errorEmptyUsertype ?>";
    var errorEmptyGender = "<?php echo $errorEmptyGender ?>";
    var errorFullName = "<?php echo $errorFullName ?>";
    var success = "<?php echo $signupSuccess ?>";

    if (success == true) {
        Swal.fire(
            'You have succesfully sign up!',
            'We will now redirect you to login page.',
            'success'
        ).then(function() {
            window.location = "login.php";
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
    if (errorEmptyMatricid == true) {
        $("#matricid").addClass("input-error");
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
    if (errorEmptyUsertype == true) {
        $("#usertype").addClass("input-error");
    }
    if (errorEmptyGender == true) {
        $("#gender").addClass("input-error");
    }

    if (errorEmpty == true) {
        $("#username, #fullname, #email, #matricid, #phonenumber, #realaddress, #password, #confirmpassword, #gender, #usertype").addClass("input-error");
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