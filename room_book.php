<?php 
include('frontend-components/header.php');
?>

<style>
.view-container {
    width: 85%; /* Adjust the width as needed */
    margin: auto; /* Center the container */
}

.view {
    display: flex;
    flex-direction: column; /* Stack items vertically on mobile */
    align-items: center;
    background-color: #f8f8f8;
    padding: 2rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    margin-top: 7%;
}

.view img {
    max-width: 30%; /* Adjust image width to fill container */
    border-radius: 8px; /* Optional: Add border-radius for a rounded image */
    margin-bottom: 1rem; /* Add space between image and other elements */
}

.context {
    max-width: 100%; /* Full width on mobile */
}

.context h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
    text-align: center;
}

.booking-form {
    display: flex;
    flex-direction: column; /* Stack form columns vertically on mobile */
}

.form-column {
    flex: 1;
    padding: 0 1rem;
    margin-bottom: 1rem; /* Add space between form columns on mobile */
}

.context label {
    margin-top: 2rem;
    font-weight: bold; /* Optional: Add bold font for labels */
    font-size: 16px;
    padding-top: 10px;
}

.context input,
.context select {
    margin-top: 0.5rem;
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%; /* Make inputs and selects full-width */
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
}

.context button {
    margin-top: 1rem;
    padding: 1rem 2rem;
    background-color: #007bff;
    color: #fff;
    font-size: 1.2rem;
    cursor: pointer;
    border: none;
    border-radius: 4px;
}

.context button:hover {
    background-color: #0056b3;
}

/* Media query for screens smaller than 768px (typical mobile devices) */
@media screen and (max-width: 768px) {
    .view {
        padding: 1rem; /* Adjust padding for smaller screens */
    }

    .context input,
    .context select {
        margin-top: 0.5rem;
        padding: 0.5rem;
        width: calc(100% - 1rem); /* Adjust width with some spacing */
    }

    .form-column {
        padding: 0; /* Remove horizontal padding on mobile */
    }
}


#paypal-button-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%; /* Adjust as needed */
    margin: 0 auto;
    margin-top: 3%;
    width: 50%; /* Adjust as needed */
}


</style>

<?php


$user_name = '';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM tbl_user WHERE id = $user_id";

    // Assuming you are using mysqli for database operations
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $full_name = $row['full_name'];
        $address = $row['address'];

    } else {
        // Handle the query error if needed
        $total_rooms = 0;
    }
}
?>


<section class="view-container">
    <div class="view">
    <?php
        $rid = $_GET['id'];
        $sql = "SELECT * FROM tbl_room WHERE id = $rid";
        $res = mysqli_query($conn, $sql);

        if ($res->num_rows > 0) {
            while ($fetch_room = mysqli_fetch_assoc($res)) {
                
                ?>
 <img src="images/room/<?php echo $fetch_room['image'];?>" alt="Room Image">


    
        <div class="context">
            <h2>Room Details</h2>
            <form  method="post" class="booking-form">

                <div class="form-column">
                <label for="check_in">Check-in Date:</label>
  <input type="date" id="check_in" name="check_in" onchange="checkAvailabilityAndCalculateTotalPrice()" required>

  <label for="check_out">Check-out Date:</label>
  <input type="date" id="check_out" name="check_out" onchange="checkAvailabilityAndCalculateTotalPrice()" required>

  <div id="availabilityMessage"></div>

                    <label for="room_name">Room Name:</label>
                    <input type="text" id="room_name" name="room_name" value="<?php echo $fetch_room['name'];?>" required readonly>

                    <label for="price">Room Price:</label>
                    <input type="text" id="room_price" name="room_price" value="<?php echo $fetch_room['price'];?>" required readonly>

                    <label for="price">Total Price:</label>
                    <input type="text" id="room_totalprice" name="total_price" required readonly>



                </div>

                <div class="form-column">
                    <label for="full_name">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" value="<?php echo $full_name;?>" required>

                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo $address;?>" required>

                    <div id="paypal-button-container"></div>

                    <input type="hidden" name="room_id" id="room_id" value="<?php echo $rid;?>">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">
                    <?php
                
            }
        } else {
            echo "No records found"; // You may want to handle the case where no room is found with the given ID
        }
        ?>


                </div>

            </form>
        </div>
    </div>
</section>

<script src="https://www.paypal.com/sdk/js?client-id=AXc3pZdSHDKAKBZt33EqU6d5Zu2sgux-JQOrU48YNuznMdhEcVthc1pwOLfSXUzbRkDD1T4eWfJygeR1&currency=PHP"></script>

<script>
      function checkAvailabilityAndCalculateTotalPrice() {
    var checkInDate = new Date(document.getElementById('check_in').value);
    var checkOutDate = new Date(document.getElementById('check_out').value);

    var timeDiff = Math.abs(checkOutDate.getTime() - checkInDate.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

    var roomPrice = parseFloat(document.getElementById('room_price').value);

    var totalPrice = diffDays * roomPrice;

    document.getElementById('room_totalprice').value = totalPrice.toFixed(2);

    // Fetch booked dates from the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'getBookedDates.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var bookedDates = JSON.parse(xhr.responseText);
            var isAvailable = checkRoomAvailability(checkInDate, checkOutDate, bookedDates);

            var messageElement = document.getElementById('availabilityMessage');
            var paypalButtonContainer = document.getElementById('paypal-button-container');

            if (isAvailable) {
                messageElement.textContent = 'Room is available for booking.';
                messageElement.style.color = 'green';
                // Update PayPal button with the new total price and enable it
                updatePayPalButton(totalPrice.toFixed(2), false);
            } else {
                messageElement.textContent = 'Room is not available for the selected dates.';
                messageElement.style.color = 'red';
                // Disable PayPal button or hide it
                updatePayPalButton(totalPrice.toFixed(2), true);
            }
        }
    };

    xhr.send();
}

    function checkRoomAvailability(checkInDate, checkOutDate, bookedDates) {
      for (var i = 0; i < bookedDates.length; i++) {
        var bookedStartDate = new Date(bookedDates[i]['check_in']);
        var bookedEndDate = new Date(bookedDates[i]['check_out']);
        bookedEndDate.setDate(bookedEndDate.getDate() + 1); // Assuming booking is for one day

        if (
          (checkInDate >= bookedStartDate && checkInDate < bookedEndDate) ||
          (checkOutDate > bookedStartDate && checkOutDate <= bookedEndDate) ||
          (checkInDate <= bookedStartDate && checkOutDate >= bookedEndDate)
        ) {
          return false; // Room is not available
        }
      }
      return true; // Room is available
    }

    function updatePayPalButton(totalPrice, isDisabled) {
    // Remove existing PayPal button if it exists
    document.getElementById("paypal-button-container").innerHTML = '';

    // Render the PayPal button with the updated total price if it's not disabled
    if (!isDisabled) {
        paypal.Buttons({
            createOrder: function(data, actions) {
                // Set up the transaction when the button is clicked
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            currency_code: 'PHP',
                            value: totalPrice // Set your payment amount here
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Log success message to console
                    console.log('Payment successful! Details:', details);

                    // Add the data you want to send to the server
                    var postData = {
                        check_in: document.getElementById('check_in').value,
                        check_out: document.getElementById('check_out').value,
                        room_name: document.getElementById('room_name').value,
                        room_price: document.getElementById('room_price').value,
                        total_price: document.getElementById('room_totalprice').value,
                        full_name: document.getElementById('full_name').value,
                        address: document.getElementById('address').value,
                        room_id: document.getElementById('room_id').value,
                        user_id: document.getElementById('user_id').value,
                        payment_details: details // Pass the payment details to the server
                    };

                    $.ajax({
                        type: 'POST',
                        url: 'insert_booking.php',
                        data: postData,
                        success: function(response) {
                            // Handle the server response if needed
                            console.log('Data inserted successfully:', response);

                            // Show SweetAlert with success message
                            swal({
                                title: 'Thank you for booking!',
                                text: 'Payment Successful',
                                icon: 'success',
                            }).then((value) => {
                                // Redirect to manage_book.php after user clicks OK in the SweetAlert
                                window.location.href = 'manage_book.php';
                            });
                        },
                        error: function(error) {
                            // Handle the error if the insertion fails
                            console.error('Error inserting data:', error);
                        }
                    });
                });
            }
        }).render('#paypal-button-container');
    }
}

</script>


<?php 
include('frontend-components/footer.php');
?>
