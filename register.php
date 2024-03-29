<?php
include('frontend-components/login-header.php');
include('connection/dbcon.php');

?>

<body>
    <section class="vh-100">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6 text-black">
              <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                
                <form style="width: 40rem; height: auto;" method="POST" onsubmit="return validateForm()">
                    <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; text-align: center;">REGISTER FORM</h3>

                    <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example18">Full name:</label>
                        <input type="text" id="fullname" class="form-control form-control-lg" name="fullname"/>
                    </div>
                
                    <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example18">Email address</label>
                        <input type="email" id="email" class="form-control form-control-lg" name="email" />
                    </div>
                    <br>

                                      <div class="form-outline mb-2">
                      <label class="form-label" for="phone">Phone #:</label>
                      <input type="tel" id="phone" class="form-control form-control-lg" name="phone" />
                  </div>


                    <div class="form-outline mb-2">
                        <label class="form-label" for="form2Example18">Address:</label>
                        <input type="text" id="address" class="form-control form-control-lg" name="address" />
                    </div>
                
                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" class="form-control form-control-lg" name="password"/>
                        <div id="password-error" style="color: red; display: none; margin-bottom: 3%;">Password must be at least 8 characters and include big letters and special characters</div>
                    </div>

                    <div class="g-recaptcha" data-sitekey="6LdKlnspAAAAALP9zAvfDJzi19t1LqUin5Ql_lah"></div>

                    <br>

 
                
                    <div class="pt-1 mb-3 text-center">
                        <button class="btn btn-info btn-lg" style="width: 300px; margin: 0 auto;" type="submit" name="register">REGISTER</button>
                    </div>
                    <p>Have an Account? <a href="login.php" class="link-info">Login here</a></p>
                </form>
              </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
              <img src="images/IMG_6881.JPG"
                alt="Login image" class="w-300 vh-150" style="object-fit: cover; object-position: left;">
            </div>
          </div>
        </div>
    </section>

    <script>
        // Initialize intl-tel-input
        $("#phone").intlTelInput({
            // Options
            initialCountry: "auto", // Automatically detect the user's country
            separateDialCode: true, // Display the country dial code separately
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // Path to the utils script
        });
    </script>

    <script>
        function validatePassword() {
            var passwordInput = document.getElementById("password");
            var passwordError = document.getElementById("password-error");
            var passwordPattern = /^(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;

            if (!passwordPattern.test(passwordInput.value)) {
                passwordError.textContent = "Password must be at least 8 characters with special characters and at least 1 capital letter";
                passwordError.style.display = "block";
                return false; // Password pattern is invalid
            } else {
                passwordError.style.display = "none";
                return true; // Password pattern is valid
            }
        }

        function validateForm() {
    // Check if reCAPTCHA is checked
    var recaptchaResponse = grecaptcha.getResponse();
    if (recaptchaResponse.length == 0) {
        // If reCAPTCHA is not checked, display an error message
        alert("Please complete the reCAPTCHA verification.");
        return false;
    }

    // Check if password is valid
    if (!validatePassword()) {
        return false; // Prevent form submission if password is invalid
    }

    // If all validations pass, allow form submission
    return true;
}


        // Add event listener to the password input field to trigger validation
        document.getElementById("password").addEventListener("keyup", validatePassword);
    </script>
</body>
</html>

<script>
function validatePassword() {
    var passwordInput = document.getElementById("password");
    var passwordError = document.getElementById("password-error");
    var passwordPattern = /^(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;

    if (!passwordPattern.test(passwordInput.value)) {
        passwordError.textContent = "Password must be at least 8 characters with special characters and at least 1 capital letter";
        passwordError.style.display = "block";
        return false; // Password pattern is invalid
    } else {
        passwordError.style.display = "none";
        return true; // Password pattern is valid
    }
}

// Add event listener to the password input field to trigger validation
document.getElementById("password").addEventListener("keyup", validatePassword);
</script>

<?php
if(isset($_POST['register']))
{
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $password = $_POST['password'];

  // Check if the email already exists in the database
  $email_check_query = "SELECT * FROM tbl_user WHERE email='$email'";
  $email_check_result = mysqli_query($conn, $email_check_query);
  if(mysqli_num_rows($email_check_result) > 0) {
    echo '<script>
      swal({
        title: "Error",
        text: "Email already exists! Please use a different email address.",
        icon: "error"
      });
    </script>';
    exit;
  }

  // // Check if the phone number has at least 12 digits
  // if(strlen($phone) < 15) {
  //   echo '<script>
  //     swal({
  //       title: "Error",
  //       text: "Phone number must have at least 15 digits.",
  //       icon: "error"
  //     });
  //   </script>';
  //   exit;
  // }

  $sql = "INSERT INTO tbl_user (full_name, email, phone, address, password) VALUES ('$fullname', '$email', '$phone', '$address', '$password')";

  $res = mysqli_query($conn, $sql);

  if($res == true)
  {
    echo '<script>
    swal({
        title: "Success",
        text: "Successfully Register The Account!",
        icon: "success"
    }).then(function() {
        window.location = "login.php";
    });
</script>';

exit; 
  }
  else
  {
    echo '<script>
    swal({
        title: "Error",
        text: "Failed to Register Account!",
        icon: "error"
    }).then(function() {
        window.location = "register.php";
    });
</script>';

exit;
  }
}

?>
