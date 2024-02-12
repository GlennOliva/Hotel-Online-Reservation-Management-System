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

$sql = "SELECT * FROM tbl_book WHERE id=$id";

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

        $status = $row['status'];

      
    }
    else
    {
        header('Location: manage_history.php');
        exit();
    }
}

?>


<main class="main-container">
    <div class="main-title">
        <p class="font-weight-bold">Update Book </p>
    </div>

    <div class="card">
    <div class="card-body">
        <form action="" method="post">
            
         

<div class="mb-3">
    <label for="bookStatus" class="form-label">Book Status</label>
    <select class="form-select" id="adminStatus" name="bookStatus">
        <option value="Pending" <?php echo ($status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
        <option value="Declined" <?php echo ($status == 'Declined') ? 'selected' : ''; ?>>Declined</option>
        <option value="Approved" <?php echo ($status == 'Approved') ? 'selected' : ''; ?>>Approved</option>
        <option value="Cancel Approved" <?php echo ($status == 'Cancel Approved') ? 'selected' : ''; ?>>Cancel Approved</option>
    </select>
</div>
          

            <button type="submit" name='update_book' class="btn btn-primary">Update Book</button>

            <input type="hidden" name="id" value="<?php echo $id;?>">
        </form>
    </div>
</div>


<?php
if(isset($_POST['update_book']))
{
 

    $status = $_POST['bookStatus'];

    //create sql query update
    $sql = "UPDATE tbl_book SET  status = '$status'  WHERE id = '$id'";

    //execute the query
    $result = mysqli_query($conn,$sql);

    //check the query executed or not
    if($result == True)
    {
        //query update sucess
        echo '<script>
        swal({
            title: "Success",
            text: "Book Successfully Update",
            icon: "success"
        }).then(function() {
            window.location = "manage_history.php";
        });
    </script>';
    
    exit; // Make sure to exit after performing the redirect
    }
    else{
        //failed to update
        echo '<script>
            swal({
                title: "Error",
                text: "Book Failed to  Update",
                icon: "error"
            }).then(function() {
                window.location = "update_book.php";
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