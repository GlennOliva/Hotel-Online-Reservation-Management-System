<?php
include('components/header.php');
include('connection/dbcon.php');

?>

<?php
include('components/sidebar.php');
?>

<main class="main-container">
    <div class="main-title">
        <p class="font-weight-bold">Add Admin</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="" method="post" onsubmit="return validateForm()">
                <div class="mb-3">
                    <label for="adminFullname" class="form-label">Admin Full_Name</label>
                    <input type="text" class="form-control" id="adminFullName" name="adminFullName">
                </div>
                <div class="mb-3">
                    <label for="adminEmail" class="form-label">Admin Email</label>
                    <input type="email" class="form-control" id="adminEmail" name="adminEmail">
                </div>

                <div class="mb-3">
                    <label for="adminPassword" class="form-label">Admin Password</label>
                    <input type="password" class="form-control" id="password" name="adminPassword">
                </div>

                <div id="password-error" style="color: red; display: none; margin-bottom: 3%;">Password must be at least 8 characters with special characters and at least 1 capital letter</div>

                <button type="submit" name='add_admin' class="btn btn-primary">Add Admin</button>
            </form>
        </div>
    </div>

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
    if (isset($_POST['add_admin'])) {
        // Count the number of existing admins
        $count_query = "SELECT COUNT(*) AS admin_count FROM tbl_admin";
        $count_result = mysqli_query($conn, $count_query);
        $row = mysqli_fetch_assoc($count_result);
        $admin_count = $row['admin_count'];

        // Check if the number of admins is less than 3 before inserting a new admin
        if ($admin_count < 3) {
            $full_name = $_POST['adminFullName'];
            $email = $_POST['adminEmail'];
            $password = $_POST['adminPassword'];

            $insert_admin = "INSERT INTO tbl_admin (full_name, email, password) VALUES ('$full_name', '$email', '$password')";

            $insert_result = mysqli_query($conn, $insert_admin);

            if ($insert_result) {
                echo '<script>
                swal({
                    title: "Success",
                    text: "Admin Successfully Inserted",
                    icon: "success"
                }).then(function() {
                    window.location = "manage_admin.php";
                });
                </script>';
                exit;
            } else {
                echo '<script>
                swal({
                    title: "Error",
                    text: "Admin Failed to Insert",
                    icon: "error"
                }).then(function() {
                    window.location = "add_admin.php";
                });
                </script>';
                exit;
            }
        } else {
            echo '<script>
                swal({
                    title: "Error",
                    text: "You can only have 3 administrators",
                    icon: "error"
                }).then(function() {
                    window.location = "add_admin.php";
                });
                </script>';
            exit;
        }
    }
    ?>
</main>

<?php
include('components/footer.php');
?>
