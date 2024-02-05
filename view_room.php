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
    max-width: 40%; /* Adjust image width to fill container */
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
        padding: 2rem; /* Adjust padding for smaller screens */
        margin-top: 50%;
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
</style>



<section class="view-container">
    <div class="view">
        <?php
        $rid = $_GET['id'];
        $sql = "SELECT * FROM tbl_room WHERE id = $rid";
        $res = mysqli_query($conn, $sql);

        if ($res->num_rows > 0) {
            while ($fetch_room = mysqli_fetch_assoc($res)) {
                ?>
                <img src="images/room/<?php echo $fetch_room['image'];?>" alt="Room Image"> <!-- Update the image source as needed -->
                <form action="" method="post">
                <div class="context">
                    <h2>View Room</h2>
                    <p style="font-size: 16px;"><span style="font-weight: bold; font-size: 16px;">Room Name:</span> <?php echo $fetch_room['name']; ?></p>
                    <p style="font-size: 16px;"><span style="font-weight: bold; font-size: 16px;">Room Price:</span> ₱<?php echo $fetch_room['price']; ?> per night</p>
                    <p style="font-size: 16px;"><span style="font-weight: bold; font-size: 16px;">Room Category:</span> <?php echo $fetch_room['category']; ?></p>
                    <p style="font-size: 16px;"><span style="font-weight: bold; font-size: 16px;">Room Details: </span> <?php echo $fetch_room['details']; ?></p>
                    <a href="room_book.php?id=<?php echo $rid;?>" class="btn">Book Now</a>
                </div>
                </form>
                <?php
            }
        } else {
            echo "No records found"; // You may want to handle the case where no room is found with the given ID
        }
        ?>
    </div>
</section>




<?php 
include('frontend-components/footer.php');
?>
