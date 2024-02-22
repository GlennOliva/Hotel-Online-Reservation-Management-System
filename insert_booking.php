<?php
include('connection/dbcon.php');

$checkInDate = $_POST['check_in'];
$checkOutDate = $_POST['check_out'];
$roomName = $_POST['room_name'];
$roomPrice = $_POST['room_price'];
$totalPrice = $_POST['total_price'];
$fullName = $_POST['full_name'];
$address = $_POST['address'];
$user_id = $_POST['user_id'];
$room_id = $_POST['room_id'];
$children = $_POST['children'];
$adults = $_POST['adults'];
$paymentMethod = $_POST['payment_method'];

// Insert data into the tbl_book table
$sqlInsert = "INSERT INTO tbl_book (user_id, room_id, full_name, address, check_in, check_out, room_name, room_price, total_price, payment_method, children , adults,  created_at) 
VALUES ('$user_id', '$room_id', '$fullName', '$address', '$checkInDate', '$checkOutDate', '$roomName', '$roomPrice', '$totalPrice', '$paymentMethod', '$children' , '$adults', NOW())";

if (mysqli_query($conn, $sqlInsert)) {
    echo 'Data inserted successfully.';
} else {
    echo 'Error inserting data: ' . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
