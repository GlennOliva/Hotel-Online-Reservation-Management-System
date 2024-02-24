<?php
    include('components/header.php');
?>


<?php
        include('components/sidebar.php');
      ?>



<main class="main-container">
    <div class="main-title">
        <p class="font-weight-bold">Manage Sales Report</p>
    </div>



    <div class="centered-date-filter mb-2" style='width: 18%; margin: 0 auto;'>
    <form method="post" action="">
        <div style="display: flex; justify-content: space-between;">
            <input type="month" class="form-control" style='margin-right: 5%;' name="filter_month">
            <button type="submit" class="btn btn-success">Filter</button>
        </div>
    </form>
</div>




    <style>
    .centered-date-filter {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="table-toolbar"> <!-- Contains the print button and other tools -->
        <button class="btn btn-primary" onclick="printTable()">Print</button>
        <!-- Add other tools as needed -->

        <table class="table table-bordered mt-3" id="printTable">
            <thead>
                <tr class="table-dark">
                    <th scope="col">Id</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Room Id</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check Out</th>
                    <th scope="col">Mode Of Payment</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Status</th>
                    <!-- Add more table headers as needed -->
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php
// Assuming you have a database connection in $conn

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected month
    $filter_month = $_POST['filter_month'];

    // Extract year and month from the selected month
    $year_month = explode('-', $filter_month);
    $year = $year_month[0];
    $month = $year_month[1];

    // Perform the SQL query with month filtering
    $sql = "SELECT * FROM tbl_book WHERE YEAR(created_at) = '$year' AND MONTH(created_at) = '$month' AND status = 'Approved'";
    $res = mysqli_query($conn, $sql);

    // Display the filtered results
    $count = mysqli_num_rows($res);
    $ids = 1;
    $total_sales = 0;

    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $user_id = $row['user_id'];
            $room_id = $row['room_id'];
            $check_in = $row['check_in'];
            $check_out = $row['check_out'];
            $total_price = $row['total_price'];
            $payment = $row['payment_method'];
            $status = $row['status'];
            $created_at = $row['created_at'];

            // Calculate total sales
            $total_sales += $total_price;

            ?>
            <tr>
                <td><?php echo $ids++;?></td>
                <td><?php echo $user_id; ?></td>
                <td><?php echo $room_id; ?></td>
                <td><?php echo $check_in; ?></td>
                <td><?php echo $check_out; ?></td>
                <td><?php echo $payment; ?></td>
                <td><?php echo $total_price; ?></td>
                <td><?php echo $status; ?></td>
            </tr>
            <?php
        }
    } else {
        // No records found for the selected month
        echo '<tr><td colspan="8">No sales report available for the selected month.</td></tr>';
    }

    // Display total sales for the month
    echo '<tr><td colspan="6"><strong>Total Sales for the Month:</strong></td><td colspan="2"><strong>₱ ' . number_format($total_sales, 2) . '</strong></td></tr>';

}
?>

                    <!-- Add more table data as needed -->
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</main>

<script>
    function printTable() {
        // Get the content of the table to be printed
        var tableContent = document.getElementById('printTable').outerHTML;

        // Create a new window for printing with a minimal HTML structure
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Month Revenue Sales</title></head><body>' + tableContent + '</body></html>');
        
        // Print the window
        printWindow.print();
        
        // Close the new window after printing
        printWindow.close();
    }
</script>


      <!-- End Main -->



      <?php
        include('components/footer.php');
      ?>