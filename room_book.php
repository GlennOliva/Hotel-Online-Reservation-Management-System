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


.terms-and-conditions {
    border: 1px solid #ccc;
    padding: 20px;
    margin-top: 20px;
    background-color: #f9f9f9;
}

.terms-and-conditions h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.terms-and-conditions p {
    margin-bottom: 10px;
}

.terms-and-conditions ul {
    margin-bottom: 10px;
}

.terms-and-conditions li {
    margin-bottom: 5px;
}

.accept-decline {
    margin-top: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.accept-decline input[type="checkbox"] {
    margin-right: 10px;
    width: 20px;
    height: 20px;
}

.accept-decline label {
    font-size: 14px;
    display: inline-block;
    padding:12px;
    margin-bottom: 1%;
}

.accept-decline label span {
    font-weight: bold;
    color: #333;
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

                    <label for="children">Number of Children:</label>
                    <input type="number" id="children" name="children" onchange="checkAvailabilityAndCalculateTotalPrice()" min="0"  required>

                    <label for="adults">Number of Adults:</label>
                    <input type="number" id="adults" name="adults" onchange="checkAvailabilityAndCalculateTotalPrice()" min="0"  required>


                    <div class="terms-and-conditions">
        <h3 style='text-align: center;'>Terms & Policies</h3>
        <p><strong>Check-in and Check-out:</strong></p>
        <ul>
            <li>Please note that the check-in time is 2pm and the check-out time is 11am the next day. You can early check-in in case if there is an available unit but we will charge 100 per hour.</li>
            <li>No extension of stay to give way to our housekeeping to clean and sanitize the room before the next guest checks in.</li>
            <li>Upon check-in, please expect that our authorized staff will collect 1,000 pesos for a security deposit. Upon check-out you must return the key in the Unit 10i, our staff will check the unit before we refund your security deposit to ensure that our rooms are in good condition before you leave the condo.</li>
        </ul>

        <p><strong>Booking Cancellation:</strong></p>
        <ul>
            <li>We can refund 100% of your payment if you cancel the booking 5 days before your arrival.</li>
            <li>Please be informed that you can get a refund of your payment in 2–3 business days.</li>
            <li>Before you book please make sure that you are comfortable with FFBS cancellation policy.</li>
        </ul>

        <p><strong>Using of Common Areas:</strong></p>
        <ul>
            <li>Please be informed that this policy is being implemented by the management of The Sentinel Residences. All guests must comply.</li>
            <li>Disobeying the house rules of the building will be subject to a violation charge by the security personnel.</li>
            <li>No pets allowed</li>
            <li>No smoking</li>
            <li>No loitering</li>
            <li>Proper disposal of garbage in the second-floor garbage room area.</li>
            <li>No loud music</li>
            <li>No parties</li>
            <li>No eating in any common areas (especially in the Swimming pool area)</li>
            <li>No illegal parking you must avail your own parking space in the reception area. The rate is 150 for the first 3 hours, 300 pesos for 24 hours and the succeeding time is 20 pesos per hour.</li>
            <li>You need to leave a one valid ID in the reception area for security purposes.</li>
        </ul>

        <p><strong>Security & Privacy:</strong></p>
        <p>The Fabulous Finds By Sabrina pledges to fully comply with the requirements of Republic Act No. 10173, known as “Data Privacy Act of 2012,” and the internationally recognized standards of data privacy security and protection.</p>
        <p>The Fabulous Finds By Sabrina stresses the importance of privacy. We are committed to earning and maintaining your trust by adopting high standards for the protection and security of personal information. The Hotel uses personal information to provide our valued guests or any individual or entities with whom the Hotel does business, regardless of the type of reservations and contractual arrangement, a wonderful experience of the unparalleled Service from efficient and courteous hotel personnel, as well as comfort, luxury, and impeccable service in every visit to the Hotel.</p>
        <p>As part of that undertaking, this Privacy Policy gives effect to our commitment to protect your personal information and serves as guidelines to be observed by The Fabulous Finds By Sabrina.</p>
        <p>You will be asked to consent to the terms of this Privacy Policy when making a reservation, registering for events or promotions, sending inquiries, or otherwise corresponding with us via the website or other platforms under applicable law. Subject to the requirements of applicable law, your continued use of the FFBS Online-Reservation website will constitute your consent to the terms of this Privacy Policy.</p>
        <p>It is also our policy to respect and uphold data privacy rights, and ensure that all personal information collected from you are processed pursuant to the general principles of transparency, legitimate purpose, and proportionality as expressly stated in the Data Privacy Act of 2012.</p>
        <p>As the Hotel’s valued guests or any individual or entities with whom the Hotel does business, regardless of the type of reservations and contractual arrangement, it is expected that you understand, agree, and consent that the Hotel collects, uses, and discloses personal data or information in accordance with the laws.</p>

        <p><strong>Other Reminders:</strong></p>
        <ul>
            <li>Please observe cleanliness inside the unit. (CLEAN AS YOU GO).</li>
            <li>STRICTLY no extra guests; our rooms can only occupy 2 people.</li>
            <li>Respect our staffs and other Building Personnel.</li>
        </ul>

        <div class="accept-decline">
        <input type="checkbox" id="accept" name="accept" required>
        <label for="accept">I accept the terms and conditions</label>
        <br>
        <input type="checkbox" id="decline" name="decline">
        <label for="decline">I decline the terms and conditions</label>
    </div>
    </div>



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

    var numberOfChildren = parseInt(document.getElementById('children').value);
    var numberOfAdults = parseInt(document.getElementById('adults').value);

    var totalPrice = diffDays * roomPrice;

    // Check if the total number of guests exceeds 2
    var totalGuests = numberOfChildren + numberOfAdults;
    if (totalGuests > 2) {
        // Calculate additional fee for each person beyond 2
        var additionalGuests = totalGuests - 2;
        var additionalFeePerPerson = 500;
        var additionalFee = additionalGuests * additionalFeePerPerson;
        totalPrice += additionalFee;
    }

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
                        children: document.getElementById('children').value,
                        adults: document.getElementById('adults').value,
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
