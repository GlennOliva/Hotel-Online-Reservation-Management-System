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
        <form action="" method="post">
            <div class="mb-3">
                <label for="adminFullname" class="form-label">Admin Full_Name</label>
                <input type="text" class="form-control" id="adminFullName" name="adminFullName">
            </div>
            <div class="mb-3">
                <label for="adminEmail" class="form-label">Admin Email</label>
                <input type="email" class="form-control" id="adminEmail" name="adminEmail">
            </div>

            <div class="mb-3">
                <label for="adminPasword" class="form-label">Admin Password</label>
                <input type="password" class="form-control" id="adminPassword" name="adminPassword">
            </div>


            <div class="mb-3">
                <label for="adminAge" class="form-label">Admin Age</label>
                <input type="number" class="form-control" id="adminAge" name="adminAge">
            </div>
            <div class="mb-3">
                <label for="adminAddress" class="form-label">Admin Address</label>
                <textarea class="form-control" id="adminAddress" name="adminAddress" rows="3"></textarea>
            </div>
          

            <button type="submit" name='add_admin' class="btn btn-primary">Add Admin</button>
        </form>
    </div>
</div>

<?php
if(isset($_POST['add_admin']))
{
    $full_name = $_POST['adminFullName'];
    $email = $_POST['adminEmail'];
    $age = $_POST['adminAge'];
    $address = $_POST['adminAddress'];
    $password = $_POST['adminPassword'];


    $insert_admin = "INSERT INTO tbl_admin SET full_name = '$full_name', email = '$email' , password = '$password' ,  age = '$age', address = '$address'";


    $insert_result = mysqli_query($conn,$insert_admin);

    if($insert_result == true)
    {
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
    }
    else
    {
        echo '<script>
    swal({
        title: "Error",
        text: "Admin Failed to  Insert",
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