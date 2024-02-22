<?php
include('connection/dbcon.php');
$roomId = $_GET['room_id'];
// Fetch booked dates from tbl_book
$sql = "SELECT check_in, check_out FROM tbl_book WHERE room_id = $roomId";
$result = $conn->query($sql);

$bookedDates = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookedDates[] = array(
            'check_in' => $row['check_in'],
            'check_out' => $row['check_out']
        );
    }
}

// Close the database connection
$conn->close();

// Return booked dates as JSON
echo json_encode($bookedDates);
?>