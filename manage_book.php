<?php 
include('frontend-components/header.php');
?>



<section class="view-container">
    <h1 style="font-size: 24px;">MY BOOKINGS</h1>

    <table class="booking-table">
        <thead>
            <tr>
                <th>Id:</th>
                <th>User_id:</th>
                <th>Room_id:</th>
                <th>Check_in:</th>
                <th>Check_out:</th>
                <th>Room_name:</th>
                <th>Total_price</th>
                <th>Book_status:</th>
                <th>Book_date:</th>
                <th>Action:</th>
            </tr>
        </thead>
        <tbody>
        <?php
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM tbl_book WHERE user_id = $user_id";

    // Assuming you are using mysqli for database operations
    $result = mysqli_query($conn, $sql);
    $ids = 1;
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $user_id = $row['user_id'];
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
                    <td>$room_id</td>
                    <td>$check_in</td>
                    <td>$check_out</td>
                    <td>$room_name</td>
                    <td>$total_price</td>
                    <td>$status</td>
                    <td>$created_at</td>
                    <td>
                                <button class='cancel-button' data-booking-id='$id'>Cancel Book</button>
                            </td>
                </tr>";

                $ids++;
        }
    } else {
        // Handle the query error if needed
    }
}
?>

        </tbody>
    </table>
</section>


<script>
    // Assuming you have jQuery loaded
    $(document).ready(function () {
        // Event listener for cancel button click
        $('.cancel-button').on('click', function () {
            var bookingId = $(this).data('booking-id');
            var button = $(this); // Capture the reference to the button

            // AJAX request to update booking status to 'cancel'
            $.ajax({
                url: 'cancel_booking.php', // Replace with your PHP script to handle the cancellation
                type: 'POST',
                data: { booking_id: bookingId },
                success: function (response) {
                    console.log('AJAX Response:', response); // Log the AJAX response for debugging

                    if (response.trim() === 'success') {
                        // Display Swal alert if cancellation is successful
                        swal({
                            icon: 'success',
                            title: 'Room booking is cancelled',
                            text: 'Please claim your refund payment at the actual place.'
                        }).then((result) => {
                            // Check if the user clicked "OK"
                            
                                // Redirect to manage_book.php
                                window.location.href = 'manage_book.php';
                          
                        });

                        // Update the status column in the row
                        button.closest('tr').find('.status-column').text('cancel');
                    } else {
                        // Handle error if cancellation fails
                        swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Cancellation failed. Please try again later.'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error); // Log AJAX errors for debugging

                    // Handle error if AJAX request fails
                    swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred during the cancellation request. Please try again later.'
                    });
                }
            });
        });
    });
</script>






<style>
    /* Add this to your existing CSS file or create a new one */

.view-container {
    margin: 20px;
    margin-top: 7%;
}

.booking-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.booking-table th, .booking-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
    font-size: 16px;
}

.booking-table th {
    background-color: #f2f2f2;
}

</style>

<?php 
include('frontend-components/footer.php');
?>
