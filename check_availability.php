<?php
// Include necessary database connection or configuration files
include('connection/dbcon.php');

// Get parameters from the AJAX request
$checkInDate = $_POST['check_in'];
$checkOutDate = $_POST['check_out'];
$roomID = $_POST['room_id'];

// Perform a database query to check availability
$sql = "SELECT * FROM tbl_book WHERE room_id = $roomID AND check_in = '$checkInDate' AND check_out = '$checkOutDate'";
$result = $conn->query($sql);

// Check if the date range is in the future
$today = date("Y-m-d");
if (strtotime($checkInDate) >= strtotime($today) && strtotime($checkOutDate) >= strtotime($today)) {
    // Assuming you have a function like isDateRangeAvailable
    if (isDateRangeAvailable($roomID, $checkInDate, $checkOutDate) && $result->rowCount() == 0) {
        echo 'available';
    } else {
        echo 'unavailable';
    }
} else {
    echo 'invalid_date';
}

// Function to check date range availability
function isDateRangeAvailable($roomID, $checkInDate, $checkOutDate) {
    // Implement your logic to check availability
    // You may use a similar SQL query as used in the check_availability.php script
    // and return true if the room is available for the specified date range
    return true; // Replace with your logic
}
?>
