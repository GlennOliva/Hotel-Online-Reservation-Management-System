<?php
    include('components/header.php');
    include('connection/dbcon.php');
?>


<?php
        include('components/sidebar.php');
      ?>
      


      <?php
      if(isset($_GET['id']))
      {
          //get all the details
          $id = $_GET['id'];
      
          //sql query to get the selected food
          $sql = "SELECT * FROM tbl_room WHERE id = $id";
      
          //execute the query
          $result = mysqli_query($conn,$sql);
      
          //get the value based on query executed
          $row = mysqli_fetch_assoc($result);
      
          //get the individuals values of selected food
          $room_name = $row['name'];
          $details = $row['details'];
          $price = $row['price'];
          $current_image = $row['image'];
          $category = $row['category'];
      }      
      
      ?>


<main class="main-container">
    <div class="main-title">
        <p class="font-weight-bold">Update Room</p>
    </div>

    <div class="card">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
    <label for="roomName" class="form-label">Current Image Room:</label>
</div>
<div class="mb-3">
    <img src="images/room/<?php echo $current_image?>" style='width: 20%;'>
</div>



            <div class="mb-3">
                <label for="roomName" class="form-label">Room Name New:</label>
                <input type="text" class="form-control" id="roomName" name="roomName" value='<?php echo $room_name;?>'>
            </div>
            <div class="mb-3">
                <label for="roomPrice" class="form-label">Room Price New:</label>
                <input type="number" class="form-control" id="roomPrice" name="roomPrice" value='<?php echo $price;?>'>
            </div>
            <div class="mb-3">
                <label for="roomImage" class="form-label">Room Image New:</label>
                <input type="file" class="form-control" id="roomImage" name="roomImage">
            </div>
            <div class="mb-3">
                <label for="roomDetails" class="form-label">Room Details New:</label>
                <textarea class="form-control" id="roomDetails" name="roomDetails" rows="3"><?php echo $details;?></textarea>
            </div>
            <div class="mb-3">
                <label for="roomCategory" class="form-label">Select Room Category New:</label>
                <select class="form-select" id="roomCategory" name="roomCategory">
                    <option value="Standard Room" <?php if ($category === 'Standard Room') echo 'selected'; ?> >Standard Room</option>
                    <option value="Deluxe Room" <?php if ($category === 'Deluxe Room') echo 'selected'; ?>>Deluxe Room</option>
                    <option value="Suite Room" <?php if ($category === 'Suite Room') echo 'selected'; ?>>Suite Room</option>
                    <option value="Executive Room" <?php if ($category === 'Executive Room') echo 'selected'; ?>>Executive Room</option>
                    <option value="Family Room" <?php if ($category === 'Family Room') echo 'selected'; ?>>Family Room</option>
                    <!-- Add more options as needed -->
                </select>
            </div>

            <input type="hidden" name="id" value="<?php echo $id;?>">
      <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
            <button type="submit" name='update_room' class="btn btn-primary">Update Room</button>
        </form>
    </div>
</div>

</main>


<?php
   
   if(isset($_POST['update_room']))
   {
       //get all the details from form
       $id = $_POST['id'];
       $room_name = $_POST['roomName'];
       $details = $_POST['roomDetails'];
       $price = $_POST['roomPrice'];
       $current_image = $_POST['current_image'];
       $category = $_POST['roomCategory'];

       //uploadt the image if selected
       
       //check whether upload button is click or not
       if(isset($_FILES['roomImage']['name']))
       {
           $image_name = $_FILES['roomImage']['name']; //new image nname

           //check if the file is available or not
           if($image_name!="")
           {
               //image is available

               //rename the image
               //rename the image
$exploded = explode('.', $image_name);
$ext = end($exploded);
$image_name = "Hotel-Room-" . rand(0000, 9999) . '.' . $ext;


               //get the source path and destination
               $src_path = $_FILES['roomImage']['tmp_name'];
               $destination_path = "images/room/".$image_name;

               //upload the image
               $upload = move_uploaded_file($src_path,$destination_path);

               //check if the image is uploaded or not
               if($upload==false)
               {
                   //failed to upload
                   echo '<script>
                   swal({
                       title: "Error",
                       text: "Failed to upload image",
                       icon: "error"
                   }).then(function() {
                       window.location = "manage_room.php";
                   });
               </script>';

               exit;

                               
               }
               //remove the current image if available
               if($current_image!="")
               {
                   //current image is available
                   $remove_path = "images/room/".$current_image;

                   $remove = unlink($remove_path);

                   //check whether the image is remove or not
                   if($remove==false)
                   {
                       //failed to remove current image
                       echo '<script>
                       swal({
                           title: "Error",
                           text: "Failed to remove current image",
                           icon: "error"
                       }).then(function() {
                           window.location = "manage_room.php";
                       });
                   </script>';

                   exit;

                       
                   }
               }
           }
       }
       else
       {
           $image_name = $current_image;
       }


       //update the food in database
       $sql2 = "UPDATE tbl_room SET name = '$room_name' , details = '$details' , price = $price , image = '$image_name' , category = '$category' WHERE id = $id";

       //execute the sql query
       $result2 = mysqli_query($conn,$sql2);

       //check if the query is executed or not
       if($result2==true)
       {
           //query executed and food updated successfully
           echo '<script>
           swal({
               title: "Success",
               text: "Room Successfully Update",
               icon: "success"
           }).then(function() {
               window.location = "manage_room.php";
           });
       </script>';

       exit;



       }
       else
       {
           //failed to update
           echo '<script>
           swal({
               title: "Error",
               text: "Failed to update",
               icon: "error"
           }).then(function() {
               window.location = "manage_room.php";
           });
       </script>';

       exit;

          
       }
   }
?>



      <?php
        include('components/footer.php');
      ?>