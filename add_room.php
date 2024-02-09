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



<main class="main-container">
    <div class="main-title">
        <p class="font-weight-bold">Add Room</p>
    </div>

    <div class="card">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="roomName" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="roomName" name="roomName">
            </div>
            <div class="mb-3">
                <label for="roomPrice" class="form-label">Room Price</label>
                <input type="number" class="form-control" id="roomPrice" name="roomPrice">
            </div>
            <div class="mb-3">
                <label for="roomImage" class="form-label">Room Image</label>
                <input type="file" class="form-control" id="roomImage" name="roomImage">
            </div>
            <div class="mb-3">
                <label for="roomDetails" class="form-label">Room Details</label>
                <textarea class="form-control" id="roomDetails" name="roomDetails" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="roomCategory" class="form-label">Room Category</label>
                <select class="form-select" id="roomCategory" name="roomCategory">
                    <option value="Standard Room">Standard Room</option>
                    <option value="Deluxe Room">Deluxe Room</option>
                    <option value="Suite Room">Suite Room</option>
                    <option value="Executive Room">Executive Room</option>
                    <option value="Family Room">Family Room</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <div class="mb-3">
                <label for="roomFeature" class="form-label">Room Feature</label>
                <select class="form-select" id="roomFeature" name="roomFeature">
                    <option value="Active">Active</option>
                    <option value="Disabled">Disable</option>
                </select>
            </div>

            <button type="submit" name='add_room' class="btn btn-primary">Add Room</button>
        </form>
    </div>
</div>


<?php

if(isset($_SESSION['admin_id']))

            {
                $admin_id = $_SESSION['admin_id'];
if(isset($_POST['add_room']))
{
    $room_name = $_POST['roomName'];
    $room_price = $_POST['roomPrice'];
    $room_details = $_POST['roomDetails'];
    $room_category = $_POST['roomCategory'];
    $room_feature = $_POST['roomFeature'];

    //upload the image if selected
    if(isset($_FILES['roomImage']['name']))
    {
        //get the details of the selected image
        $image_name = $_FILES['roomImage']['name'];

        //check if the imaage selected or not.
        if ($image_name != "") {
            // Image is selected
            // Rename the image
            $ext_parts = explode('.', $image_name);
            $ext = end($ext_parts);
        
            // Create a new name for the image
            $image_name = "Hotel-Room-" . rand(0000, 9999) . "." . $ext;
        
            // Upload the image
        
            // Get the src path and destination path
        
            // Source path is the current location of the image
            $src = $_FILES['roomImage']['tmp_name'];
        
            // Destination path for the image to be uploaded
            $destination = "images/room/" . $image_name;
        
            // Upload the food image
            $upload = move_uploaded_file($src, $destination);
        
            // Check if the image uploaded or not
            if ($upload == false) {
                // Failed to upload the image
                echo '<script>
                    swal({
                        title: "Error",
                        text: "Failed to upload image",
                        icon: "error"
                    }).then(function() {
                        window.location = "add_room.php";
                    });
                </script>';
        
                die();
                exit;
            } else {
                // Image uploaded successfully
            }
        }
        

    }
    else
    {
        $image_name = ""; 
    }

     //insert data to database
     $sql = "INSERT INTO tbl_room SET name = '$room_name' , admin_id = $admin_id,   details = '$room_details' , price = $room_price , category = '$room_category' , image = '$image_name' , feature = '$room_feature'  ";

     //execute the query
     $result = mysqli_query($conn,$sql);

     //check if the data is inserted or not
     if($result==TRUE)
     {
         //DATA inserted successfully
         echo '<script>
         swal({
             title: "Success",
             text: "Room Successfully Inserted",
             icon: "success"
         }).then(function() {
             window.location = "manage_room.php";
         });
     </script>';

     exit;
     }
     else
     {
         //failed to insert data
         echo '<script>
                 swal({
                     title: "Error",
                     text: "Failed to insert room",
                     icon: "error"
                 }).then(function() {
                     window.location = "add_room.php";
                 });
             </script>';
             exit;
     }

}

            }

?>

</main>



      <?php
        include('components/footer.php');
      ?>