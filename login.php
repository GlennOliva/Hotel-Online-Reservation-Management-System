<?php
include('frontend-components/login-header.php');
include('connection/dbcon.php');
session_start();
?>
<body>
    <section class="vh-100">
        <div class="container-fluid">
          <div class="row">
            
            <div class="col-sm-6 text-black">
      
      
              <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                
                
                
             

                <form style="width: 40rem; height: auto;" method="POST">
                    <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; text-align: center;">LOGIN FORM</h3>
                
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example18">Email address</label>
                        <input type="email" id="form2Example18" class="form-control form-control-lg" name="email" />
                    </div>
                
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example28">Password</label>
                        <input type="password" id="form2Example28" class="form-control form-control-lg" name="password" />
                    </div>
                
                    <div class="pt-1 mb-4 text-center">
                        <button class="btn btn-info btn-lg " style="width: 300px; margin: 0 auto;" type="submit" name="login-submit">LOGIN</button>
                    </div>
                    
                    <p>Don't have an account? <a href="register.php" class="link-info">Register here</a></p>
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
</body>
</html>

<?php


    //check if the submit button is clicked or not
    if(isset($_POST['login-submit']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        //sql to check the user with username and password exists or not
        $sql = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password'";

        //execute the sql queery
        $result = mysqli_query($conn,$sql);

        //count the rows 
        $count = mysqli_num_rows($result);

        if($count==1)
        {

            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['id'];
            
            //user is exist
            echo '<script>
            swal({
                title: "Success",
                text: "Login Successfully",
                icon: "success"
            }).then(function() {
                window.location = "home.php";
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
                window.location = "login.php";
            });
        </script>';
        
        exit;
        }
    }

?>