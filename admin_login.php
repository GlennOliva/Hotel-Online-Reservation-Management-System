<?php 

include('connection/dbcon.php');
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/adminlogin.css">
   
</head>
<body>
<div class="box-container">
    <div class="box-image">
        <img src="images/logo.jpg" style='width: 50%; height: auto; margin: 0 auto; radius: 50%;' alt="">
    </div>
    <div class="box-login">
        <h1>Admin login</h1>
        <form method="POST">
            <div class="input-container">
                <i class="material-icons-sharp">person</i>
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="input-container">
    <i class="material-icons-sharp">lock</i>
    <input type="password" name="password" id="password" placeholder="Password">
    <span class="toggle-password" onclick="togglePasswordVisibility()">
        <i class="material-icons-sharp" id="password-icon">visibility</i>
    </span>
</div>
<div id="password-error" style="color: red; display: none; margin-bottom: 3%;">Password must be between 4 and 8 characters</div>

            <input type="submit" name="login-submit" value="Login" class="submit-button">
        </form>
    </div>
</div>




<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var toggleSpan = document.querySelector(".toggle-password");
        var passwordIcon = document.getElementById("password-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordIcon.textContent = "visibility_off";
        } else {
            passwordInput.type = "password";
            passwordIcon.textContent = "visibility";
        }
    }

    function validatePassword() {
    var passwordInput = document.getElementById("password");
    var passwordError = document.getElementById("password-error");

    if (passwordInput.value.length < 4 || passwordInput.value.length > 25) {
        if (passwordInput.value.length < 8) {
            passwordError.textContent = "Password must be at least 4 characters to 8 characters";
        } 
        passwordError.style.display = "block";
        return false; // Password length is invalid
    } else {
        passwordError.style.display = "none";
        return true; // Password length is valid
    }
}

// Add event listener to the password input field to trigger validation
document.getElementById("password").addEventListener("keyup", validatePassword);



</script>




</body>
</html>




<?php


    //check if the submit button is clicked or not
    if(isset($_POST['login-submit']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        //sql to check the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE email = '$username' AND password = '$password'";

        //execute the sql queery
        $result = mysqli_query($conn,$sql);

        //count the rows 
        $count = mysqli_num_rows($result);

        if($count==1)
        {

            $row = mysqli_fetch_assoc($result);
            $_SESSION['admin_id'] = $row['id'];
            
            //user is exist
            echo '<script>
            swal({
                title: "Success",
                text: "Login Successfully",
                icon: "success"
            }).then(function() {
                window.location = "index.php";
            });
        </script>';

       



       
        
        exit;

        }
        else{
            //user not available
            echo '<script>
            swal({
                title: "Error",
                text: "Username or Password did not match",
                icon: "error"
            }).then(function() {
                window.location = "admin_login.php";
            });
        </script>';
        
        exit;
        }
    }

?>