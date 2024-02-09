<?php
    include('components/header.php');
    include('connection/dbcon.php');
?>


<?php
        include('components/sidebar.php');
      ?>



<?php
if(!isset($_SESSION['admin_id']))
{
    echo '<script>
                                    swal({
                                        title: "Error",
                                        text: "You must login first before you proceed!",
                                        icon: "error"
                                    }).then(function() {
                                        window.location = "admin_login.php";
                                    });
                                </script>';
                                exit;
}

?>






<?php
if(isset($_SESSION['admin_id']))

{
    $admin_id = $_SESSION['admin_id'];
$sql = "SELECT * FROM tbl_admin WHERE id = $admin_id";

//execute the query
$result = mysqli_query($conn,$sql);

//check if the query is executed or not!
if($result == True)
{
    //check if the data is available or not
    $count = mysqli_num_rows($result);

    //ccheck if we have admin data or not
    if($count==1)
    {
        //display the details
        //echo "admin available"; 
        $row = mysqli_fetch_assoc($result);

        $full_name = $row['full_name'];
        $email = $row['email'];

        $status = $row['status'];

      
    }
    else
    {
        header('Location: adminacc.php');
        exit();
    }
}
}
?>


<main class="main-container">
    <div class="main-title">
        <p class="font-weight-bold">Update Profile</p>
    </div>

    <div class="card">
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="adminFullname" class="form-label">Admin Full_Name </label>
                <input type="text" class="form-control" id="adminFullName" name="adminFullName" value="<?php echo $full_name;?>">
            </div>
            <div class="mb-3">
                <label for="adminEmail" class="form-label">Admin Email</label>
                <input type="email" class="form-control" id="adminEmail" name="adminEmail" value='<?php echo $email;?>'>
            </div>
 
    <div class="mb-3">
                <label for="adminAge" class="form-label">Admin Current Password</label>
                <input type="password" class="form-control" id="password" name="current_password">
            </div>




            <div class="mb-3">
                <label for="adminAge" class="form-label">Admin New Password</label>
                <input type="password" class="form-control" id="password" name="new_password" >
            </div>

        


            <div class="mb-3">
                <label for="adminAge" class="form-label">Admin Confirm Password</label>
                <input type="password" class="form-control" id="password" name="confirm_password" >
            </div>

        
</div>


          

            <button type="submit" name='update_admin' class="btn btn-primary">Update Profile</button>

            <input type="hidden" name="id" value="<?php echo $id;?>">
        </form>
    </div>
</div>


<script>
        function validatePassword() {
            var passwordInput = document.getElementById("password");
            var passwordError = document.getElementById("password-error");
            var passwordPattern = /^(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;

            if (!passwordPattern.test(passwordInput.value)) {
                passwordError.textContent = "Password must be at least 8 characters and include big letters and special characters";
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
if(isset($_POST['update_admin']))
{

    $full_name = $_POST['adminFullName'];
    $email = $_POST['adminEmail'];
    $status = $_POST['adminStatus'];
    $current_passowrd = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];


    $sql1 = "SELECT * FROM tbl_admin WHERE id=$admin_id && password ='$current_passowrd'";
    $result = mysqli_query($conn,$sql1);

            if($result==true)
            {
                $count = mysqli_num_rows($result);

                if($count==1)
                {
                    //User exist and password can be changed

                    //check whether the new password confrim and match
                    if($new_password==$confirm_password)
                    {
                        //create sql query update
    $sql = "UPDATE tbl_admin SET full_name = '$full_name' , email = '$email' ,  password = '$new_password'   WHERE id = '$admin_id'";

    //execute the query
    $result = mysqli_query($conn,$sql);

    //check the query executed or not
    if($result == True)
    {
        //query update sucess
        echo '<script>
        swal({
            title: "Success",
            text: "Admin Successfully Update Profile",
            icon: "success"
        }).then(function() {
            window.location = "update_adminprofile.php";
        });
    </script>';
    
    exit; // Make sure to exit after performing the redirect
    }
    else{
        //failed to update
        echo '<script>
            swal({
                title: "Error",
                text: "Admin Failed to  Update Profile",
                icon: "error"
            }).then(function() {
                window.location = "update_adminprofile.php";
            });
        </script>';

        exit;
    }
                }
                else{
                    //user doesn't exist
                    echo '<script>
                    swal({
                        title: "Error",
                        text: "User doesnt exist",
                        icon: "error"
                    }).then(function() {
                        window.location = "manage_admin.php";
                    });
                </script>';

                exit;
                }
            }
   
}
}

?>




</main>



      <?php
        include('components/footer.php');
      ?>