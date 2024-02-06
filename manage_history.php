<?php
    include('components/header.php');
?>


<?php
        include('components/sidebar.php');
      ?>



<main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">Manage Transaction History</p>
        </div>

        <table class="table table-bordered">
        <thead>
            <tr class="table-dark">
                <th scope="col">Id</th>
                <th scope="col">User Full_Name</th>
                <th scope="col">User Address</th>
                <th scope="col">Room Name</th>
                <th scope="col">Room Price</th>
                <th scope="col">Room Total_Price</th>
                <th scope="col">Check In</th>
                <th scope="col">Check Out</th>
                <th scope="col">Status</th>
                <!-- Add more table headers as needed -->
            </tr>
        </thead>
        <tbody>
        <?php
    $sql = "SELECT * FROM tbl_book";

    // Assuming you are using mysqli for database operations
    $result = mysqli_query($conn, $sql);
    $ids = 1;

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $user_id = $row['full_name'];
            $address = $row['address'];
            $room_price = $row['room_price'];
            $room_id = $row['room_id'];
            $check_in = $row['check_in'];
            $check_out = $row['check_out'];
            $room_name = $row['room_name'];
            $total_price = $row['total_price'];
            $status = $row['status'];
            $created_at = $row['created_at'];

            // Display each row in the table
            echo "<tr>
                    <td>$ids</td>
                    <td>$user_id</td>
                    <td>$address</td>
                    <td>$room_name</td>
                    <td>$room_price</td>
                    <td>$total_price</td>
                    <td>$check_in</td>
                    <td>$check_out</td>
                    <td>$status</td>
                </tr>";

            // Increment $ids for the next iteration
            $ids++;
        }
    } else {
        // Handle the query error if needed
    }
?>

        </tbody>
    </table>
      </main>
      <!-- End Main -->



      <?php
        include('components/footer.php');
      ?>