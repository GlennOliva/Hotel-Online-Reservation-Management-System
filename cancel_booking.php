<?php
include('connection/dbcon.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the booking_id parameter is set
    if (isset($_POST['booking_id'])) {
        $bookingId = $_POST['booking_id'];

        // Check if the booking status is not already 'cancel' or 'Cancel Approved'
        $checkSql = "SELECT status FROM tbl_book WHERE id = $bookingId";
        $checkResult = mysqli_query($conn, $checkSql);

        if ($checkResult) {
            $row = mysqli_fetch_assoc($checkResult);
            $currentStatus = $row['status'];

            if ($currentStatus !== 'For approval to admin to cancel your book' && $currentStatus !== 'Cancel Approved') {
                // Update the booking status to 'For approval to admin to cancel your book' in the database
                $updateSql = "UPDATE tbl_book SET status = 'For approval to admin to cancel your book' WHERE id = $bookingId";
                $updateResult = mysqli_query($conn, $updateSql);

                if ($updateResult) {
                    // The cancellation was successful
                    echo 'success';
                } else {
                    // The cancellation failed
                    echo 'error';
                }
            } elseif ($currentStatus === 'Cancel Approved') {
                // The booking is already cancelled and approved
                echo 'already_cancelled_approved';
            } else {
                // The booking is already in the process of cancellation
                echo 'already_cancellation_process';
            }
        } else {
            // Error in checking the current status
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
