<?php
    include('components/header.php');
    include('connection/dbcon.php');
?>


<?php
        include('components/sidebar.php');
      ?>



<?php

//1get the id 
$id = $_GET['id'];

//create sql querty

$sql = "SELECT * FROM tbl_admin WHERE id=$id";

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
        $address = $row['address'];
        $age = $row['age'];
        $status = $row['status'];

      
    }
    else
    {
        header('Location: adminacc.php');
        exit();
    }
}

?>


<main class="main-container">
    <div class="main-title">
        <p class="font-weight-bold">Update Admin</p>
    </div>

    <div class="card">
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="adminFullname" class="form-label">Admin Full_Name New</label>
                <input type="text" class="form-control" id="adminFullName" name="adminFullName" value="<?php echo $full_name;?>">
            </div>
            <div class="mb-3">
                <label for="adminEmail" class="form-label">Admin Email New</label>
                <input type="email" class="form-control" id="adminEmail" name="adminEmail" value='<?php echo $email;?>'>
            </div>
            <div class="mb-3">
                <label for="adminAge" class="form-label">Admin Age New</label>
                <input type="number" class="form-control" id="adminAge" name="adminAge" value="<?php echo $age;?>">
            </div>
            <div class="mb-3">
    <label for="adminAddress" class="form-label">Admin Address New</label>
    <textarea class="form-control" id="adminAddress" name="adminAddress" rows="3"><?php echo $address;?></textarea>
</div>

<div class="mb-3">
    <label for="adminStatus" class="form-label">Admin Status</label>
    <select class="form-select" id="adminStatus" name="adminStatus">
        <option value="Inactive" <?php echo ($status == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
        <option value="Active" <?php echo ($status == 'Active') ? 'selected' : ''; ?>>Active</option>
    </select>
</div>
          

            <button type="submit" name='update_admin' class="btn btn-primary">Update Admin</button>

            <input type="hidden" name="id" value="<?php echo $id;?>">
        </form>
    </div>
</div>


<?php
if(isset($_POST['update_admin']))
{
    $id = $_POST['id'];
    $full_name = $_POST['adminFullName'];
    $email = $_POST['adminEmail'];
    $age = $_POST['adminAge'];
    $address = $_POST['adminAddress'];
    $status = $_POST['adminStatus'];

    //create sql query update
    $sql = "UPDATE tbl_admin SET full_name = '$full_name' , email = '$email' , age = '$age', address = '$address' , status = '$status'  WHERE id = '$id'";

    //execute the query
    $result = mysqli_query($conn,$sql);

    //check the query executed or not
    if($result == True)
    {
        //query update sucess
        echo '<script>
        swal({
            title: "Success",
            text: "Admin Successfully Update",
            icon: "success"
        }).then(function() {
            window.location = "manage_admin.php";
        });
    </script>';
    
    exit; // Make sure to exit after performing the redirect
    }
    else{
        //failed to update
        echo '<script>
            swal({
                title: "Error",
                text: "Admin Failed to  Update",
                icon: "error"
            }).then(function() {
                window.location = "update_admin.php";
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