<?php
include 'connection.php';
session_start();
if (isset($_POST['login']) !== "") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = stripcslashes($username);
    $password = stripcslashes($password);

    $username = mysqli_real_escape_string($sql_connect, $username);
    $password = mysqli_real_escape_string($sql_connect, $password);

    $errorUsername = false;
    $errorPassword = false;

    if (empty($username)) {
        $errorUsername = true;
        echo "<span class='form-error'> Fill in username ! </span> <br>";
    }
    if (empty($password)) {
        $errorPassword = true;
        echo "<span class='form-error'> Fill in your password ! </span> <br>";
    }

    if ($errorUsername == false && $errorPassword  == false) {

        $query = "select * from user where username='$username'";
        $result = mysqli_query($sql_connect, $query);
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $loggedinSuccess = true;
            $_SESSION['User'] = $username;
        } else {
            echo "<span class='form-error'> Wrong username or password ! </span> <br>";
        }
    }
}

?>

<script>
    $("#username, #password").removeClass("input-error");

    var errorEmptyUsername = "<?php echo $errorUsername ?>";
    var errorEmptyPassword = "<?php echo $errorPassword ?>";
    var loggedIn = "<?php echo $loggedinSuccess ?>";

    if (loggedIn == true) {
        Swal.fire(
            'Already Registered!',
            'We will now redirect you to Profile.',
            'success'
        ).then(function() {
            window.location = "admindashboard.php";
        });
    }

    if (errorEmptyUsername == true) {
        $("#username").addClass("input-error");
    }
    if (errorEmptyPassword == true) {
        $("#password").addClass("input-error");
    }
</script>