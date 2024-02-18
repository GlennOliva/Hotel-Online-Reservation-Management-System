
<?php
include('connection/dbcon.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Hotel Website</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- swiper js cdn link -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- custom css link -->



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

   <link rel="stylesheet" href="css/front.css">
   <link rel="icon" href="images/logo.jpg" type="image/x-icon">

   <style>
   

      /* Style for the dropdown */
      .dropdown {
          position: relative;
          display: inline-block;
      }

      /* Style for the dropdown content */
      .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f9f9f9;
          min-width: 160px;
          box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
          z-index: 1;
      }

      /* Style for the dropdown link */
      .dropdown a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
      }

      /* Change color on hover */
      .dropdown a:hover {
         color: #48cae4;
      }

      /* Show the dropdown content on hover */
      .dropdown:hover .dropdown-content {
          display: block;
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
        $user_name = $row['full_name'];
    } else {
        // Handle the query error if needed
        $total_rooms = 0;
    }
}
?>
</head>

<body>

   <!-- header -->

   <header class="header">

      <a href="#" class="logo"> <i class="fas fa-hotel"></i>FABULOUS FINDS BY SABRINA </a>

      <nav class="navbar">
         <a href="#home">home</a>
         <a href="#about">about</a>
         <a href="#room">room</a>
         <a href="#gallery">gallery</a>
         <a href="#review">review</a>
         <a href="#faq">faq</a>
         <div class="dropdown">
            <a href="#faq">Hi: <?php echo $user_name;?></a>
            <div class="dropdown-content">
                <a href="manage_book.php">My Bookings</a>
                <a href="update_profile.php">Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
      </nav>

      <div id="menu-btn" class="fas fa-bars"></div>

   </header>

