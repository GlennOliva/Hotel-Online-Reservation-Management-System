<?php 
include('frontend-components/header.php');
?>

<style>
.view-container {
    width: 85%; /* Adjust the width as needed */
    margin: auto; /* Center the container */
}

.view {
    display: flex;
    flex-direction: column; /* Stack items vertically on mobile */
    align-items: center;
    background-color: #f8f8f8;
    padding: 2rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    margin-top: 7%;
}

.view img {
    max-width: 40%; /* Adjust image width to fill container */
    border-radius: 8px; /* Optional: Add border-radius for a rounded image */
    margin-bottom: 1rem; /* Add space between image and other elements */
}

.context {
    max-width: 100%; /* Full width on mobile */
}

.context h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
    text-align: center;
}

.booking-form {
    display: flex;
    flex-direction: column; /* Stack form columns vertically on mobile */
}

.form-column {
    flex: 1;
    padding: 0 1rem;
    margin-bottom: 1rem; /* Add space between form columns on mobile */
}

.context label {
    margin-top: 2rem;
    font-weight: bold; /* Optional: Add bold font for labels */
    font-size: 16px;
    padding-top: 10px;
}

.context input,
.context select {
    margin-top: 0.5rem;
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%; /* Make inputs and selects full-width */
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
}

.context button {
    margin-top: 1rem;
    padding: 1rem 2rem;
    background-color: #007bff;
    color: #fff;
    font-size: 1.2rem;
    cursor: pointer;
    border: none;
    border-radius: 4px;
}

.context button:hover {
    background-color: #0056b3;
}

/* Media query for screens smaller than 768px (typical mobile devices) */
@media screen and (max-width: 768px) {
    .view {
        padding: 1rem; /* Adjust padding for smaller screens */
    }

    .context input,
    .context select {
        margin-top: 0.5rem;
        padding: 0.5rem;
        width: calc(100% - 1rem); /* Adjust width with some spacing */
    }

    .form-column {
        padding: 0; /* Remove horizontal padding on mobile */
    }
}
</style>

<?php

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM tbl_user WHERE id = $user_id";

    // Assuming you are using mysqli for database operations
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $full_name = $row['full_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
    } else {
        // Handle the query error if needed
        $total_rooms = 0;
    }
}
?>




<section class="view-container">
    <div class="view">

        <div class="context">
            <h2>User Profile</h2>
            <form action="" method="post" class="booking-form" onsubmit="return validateForm()">

                <div class="form-column">
                    <label for="room_name">Full Name:</label>
                    <input type="text" id="room_name" name="full_name" value="<?php echo $full_name;?>" required>

                    <label for="price">Email:</label>
                    <input type="email" id="room_price" name="email" value="<?php echo $email;?>" required>

                    <label for="price">Phone #:</label>
                    <input type="text" id="room_totalprice" name="phone" value="<?php echo $phone;?>" required maxlength="11">
                </div>

                <div class="form-column">

                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo $address;?>" required>


                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example28">Password</label>
                        <input type="password" id="password" class="form-control form-control-lg" name="password"/>
                    </div>

                    <div id="password-error" style="color: red; display: none; margin-bottom: 3%;">Password must be at least 8 characters with special characters and at least 1 capital letter</div>


                    <input type="hidden" value="<?php echo $id;?>" name="id">    
                    <button type="submit" name="update_profile" class="btn">Update Profile</button>
                </div>

            </form>
        </div>
    </div>
</section>

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
    if (!validatePassword()) {
        return false; // Prevent form submission if password is invalid
    }
    return true; // Allow form submission if all validations pass
}

// Add event listener to the password input field to trigger validation
document.getElementById("password").addEventListener("keyup", validatePassword);
</script>


<?php
if(isset($_POST['update_profile']))
{
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];


    $sql = "UPDATE tbl_user SET full_name = '$full_name' , email = '$email' , phone = '$phone' , address = '$address' , password = '$password' WHERE id = $id";

    $res = mysqli_query($conn,$sql);

    if($res == true)
    {
        echo '<script>
        swal({
            title: "Success",
            text: "User Successfully Update Profile",
            icon: "success"
        }).then(function() {
            window.location = "update_profile.php";
        });
    </script>';
    
    exit; 
    }
    else
    {
        echo '<script>
    swal({
        title: "Error",
        text: "User Failed to Update Profile",
        icon: "error"
    }).then(function() {
        window.location = "update_profile.php";
    });
</script>';

exit;
    }
}

?>



<?php 
include('frontend-components/footer.php');
?>
