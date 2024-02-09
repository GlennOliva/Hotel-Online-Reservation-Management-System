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
        <p class="font-weight-bold">Manage Rooms</p>
    </div>

    <div class="btn btn-success" style="background-color: #28a745; border-color: #28a745; margin-bottom: 1%;">
    <a href="add_room.php" style="text-decoration: none; color: #fff;">
        <span class="material-icons-sharp" ></span> Add Room
    </a>
</div>



    <table class="table table-bordered" id="admin_table">
        <thead>
            <tr class="table-dark">
                <th scope="col">Room ID</th>
                <th scope="col">Room Name</th>
                <th scope="col">Room Price</th>
                <th scope="col">Room Image</th>
                <th scope="col">Room Details</th>
                <th scope="col">Room Category</th>
                <th scope="col">Room Feature</th>
                <th scope="col">Actions</th>
                <!-- Add more table headers as needed -->
            </tr>
        </thead>
        <tbody>

        <?php
        if(isset($_SESSION['admin_id']))

        {
            $admin_id = $_SESSION['admin_id'];
        $sql = "SELECT * FROM tbl_room WHERE admin_id = $admin_id";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                $ids = 1;

                while ($rows = mysqli_fetch_assoc($result)) {
                    $id = $rows['id'];
                    $room_name = $rows['name'];
                    $room_price = $rows['price'];
                    $room_details = $rows['details'];
                    $room_category = $rows['category'];
                    $image = $rows['image'];
                    $feature = $rows['feature'];
                    ?>


            <tr>
                <td><?php echo $ids++;?></td>
                <td><?php echo $room_name;?></td>
                <td><?php echo $room_price;?></td>
                <td><img src="images/room/<?php echo $image;?>" alt="" style='width: 70px;'></td>
                <td><?php echo $room_details?></td>
                <td><?php echo $room_category;?></td>
                <td><?php echo $feature;?></td>
                <td>
                <a href="update_room.php?id=<?php echo $id;?>" class="btn btn-primary">Edit</a>
                <form action="code.php" method="POST">
                <button type="button" class="btn btn-danger delete_roombtn" value="<?= $id;?>">Delete</button>
                </form>

                </td>
                <!-- Add more table data as needed -->
            </tr>
<?php

                }

            }
        }

        }
        else
        {

        }
           

            ?>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</main>






      <?php
        include('components/footer.php');
      ?>