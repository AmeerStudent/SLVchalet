<?php
include 'connection.php';
session_start();
if (isset($_POST['submit']) !== "") {

    $username = $_SESSION['User'];

    $currentpassword = $_POST['currentpassword'];
    $newpassword = $_POST['newpassword'];
    $confirmnewpassword = $_POST['confirmnewpassword'];

    $currentpassword = stripcslashes($currentpassword);
    $newpassword = stripcslashes($newpassword);
    $confirmnewpassword = stripcslashes($confirmnewpassword);

    $currentpassword = mysqli_real_escape_string($sql_connect, $currentpassword);
    $newpassword = mysqli_real_escape_string($sql_connect, $newpassword);
    $confirmnewpassword = mysqli_real_escape_string($sql_connect, $confirmnewpassword);

    $errorCurrentPassword = false;
    $errorNewPassword = false;
    $errorConfirmNewPassword = false;
    $errorWeakPassword = true;

    $success = false;

    if (empty($currentpassword)) {
        $errorCurrentPassword = true;
        echo "<span class='form-error'> Fill in current password </span> <br>";
    }
    if (empty($newpassword)) {
        $errorNewPassword = true;
        echo "<span class='form-error'> Fill in your new password ! </span> <br>";
    }
    if (empty($confirmnewpassword)) {
        $errorConfirmNewPassword = true;
        echo "<span class='form-error'> Fill in your confirmation for new password ! </span> <br>";
    }
    if ($newpassword == $confirmnewpassword) {
        if (strlen($newpassword) < 8) {
            echo "<span class='form-error'> Password must contain at least 8 character </span> <br>";
        } else {
            $query = "select * from user where username='$username'";
            $result = mysqli_query($sql_connect, $query);
            $row = mysqli_fetch_assoc($result);

            if (password_verify($currentpassword, $row['password'])) {
                $hashed = password_hash($newpassword, PASSWORD_DEFAULT);
                $query_update = "UPDATE user SET password='$hashed' WHERE username='$username'";
                $result_update = mysqli_query($sql_connect, $query_update);

                if ($result_update === TRUE) {
                    $success = true;
                } else
                    echo "<span class='form-error'> Your current password is wrong </span> <br>";
            } else {
                echo "<span class='form-error'> Your current password is wrong </span> <br>";
            }
        }
    }
}

?>

<script>
    var success = "<?php echo $success ?>";
    if (success == true) {
        Swal.fire(
            'Success !',
            'You have succesfully update your password.',
            'success'
        ).then(function() {
            window.location = "updatepassword.php";
        });
    }
</script>