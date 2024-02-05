<?php
include('connection/dbcon.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the booking_id parameter is set
    if (isset($_POST['booking_id'])) {
        $bookingId = $_POST['booking_id'];

        // Update the booking status to 'cancel' in the database
        $updateSql = "UPDATE tbl_book SET status = 'cancel' WHERE id = $bookingId";

        // Assuming you are using mysqli for database operations
        $updateResult = mysqli_query($conn, $updateSql);

        if ($updateResult) {
            // The cancellation was successful
            echo 'success';
        } else {
            // The cancellation failed
            echo 'error';
        }
    } else {
        // Invalid request, booking_id parameter is not set
        echo 'error';
    }
} else {
    // Invalid request, not a POST request
    echo 'error';
}
?>
