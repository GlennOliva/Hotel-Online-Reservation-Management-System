<?php 
include('frontend-components/header.php');
?>


   <!-- end -->

   <!-- home -->

   <section class="home" id="home">

      <div class="swiper home-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide" style="background: url(images/home-slide1.jpg) no-repeat;">
               <div class="content">
                 <h3>Discover the luxury of seamless online reservations at our exquisite hotel. With just a few clicks, you can ensure a delightful and stress-free stay with us.</h3>
                  <a href="#" class="btn">Book Now</a>
               </div>
            </div>

            <div class="swiper-slide slide" style="background: url(images/home-slide3.jpg) no-repeat;">
               <div class="content">
                  <h3>Experience Unforgettable Stays with Hassle-Free Online Reservations</h3>

        <a href="#" class="btn">Book Now</a>
               </div>
            </div>

            <div class="swiper-slide slide" style="background: url(images/Rm216.JPG) no-repeat;">
               <div class="content">
                <h3>Discover the luxury of seamless online reservations at our exquisite hotel. With just a few clicks, you can ensure a delightful and stress-free stay with us.</h3>
        <a href="#" class="btn">Book Now</a>
               </div>
            </div>

            <div class="swiper-slide slide" style="background: url(images/Rm215.JPG) no-repeat;">
               <div class="content">
                  <h3>Experience Unforgettable Stays with Hassle-Free Online Reservations. </h3>

                  <a href="#" class="btn">Book Now</a>
               </div>
            </div>

         </div>

         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>

      </div>

   </section>

   <!-- end -->

   <!-- availability -->

   <section class="availability">

      

   </section>

   <!-- end -->


   <!-- about -->

   <section class="about" id="about">

      <div class="row">

         <div class="image">
            <img src="images/Rm211.JPG" alt="">
         </div>

         <div class="content">
            <h3>about us</h3>
            <p style="text-align: justify;">Welcome to Fabulous Finds by Sabrina Hotel, where luxury meets unparalleled comfort. Our tastefully designed rooms and suites redefine elegance, providing a perfect sanctuary for your stay. Our commitment to exceptional service ensures that your every need is not just met but exceeded. Indulge in a culinary journey at our renowned on-site restaurant, offering a diverse menu to cater to every palate. Conveniently located in the heart of The Sentinel Residences Suites 528 EDSA Cubao 1109 Quezon City, Philippines, our hotel is the ideal choice for both business and leisure travelers. When you book directly with us, you unlock exclusive deals and discounts, enhancing your stay with special perks. Connect with us online through our website and social media platforms to stay updated on promotions, events, and behind-the-scenes glimpses. Explore our referral program, frequent stay rewards, and seasonal packages to make your stay even more rewarding. Whether for business or leisure, Fabulous Finds by Sabrina Hotel welcomes you to experience a stay where every moment is crafted for perfection. Contact our reservation team at 287760282 or visit our website to book your stay and embark on a journey into luxury. #FabulousFindsExperience #LuxuryRedefined</p>
         </div>

      </div>

   </section>

   <!-- end -->

   <!-- room -->

   <section class="room" id="room">

<h1 class="heading">our room</h1>

<div class="swiper room-slider">

    <div class="swiper-wrapper">

        <?php
        $sql = "SELECT * FROM tbl_room";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                    $rid = $rows['id'];
                    $room_name = $rows['name'];
                    $room_price = $rows['price'];
                    $room_details = $rows['details'];
                    $room_category = $rows['category'];
                    $image = $rows['image'];
                    ?>

                    <div class="swiper-slide slide">
                        <div class="image">
                            <span class="price">₱ <?php echo $room_price; ?></span>
                            <img src="images/room/<?php echo $image; ?>" alt="">
                            <a href="view_room.php?id=<?php echo $rid;?>" class="fa fa-eye"></a>
                        </div>
                        <div class="content">
                            <p><span style="font-weight: bold;">Room Name:</span> <?php echo $room_name; ?> </p>
                            <p><span style="font-weight: bold;">Room Category:</span> <?php echo $room_category; ?></p>
                            <p style="text-align: justify;"><span style="font-weight: bold; ">Room Details:</span> <?php echo $room_details; ?></p>
                            <a href="room_book.php?id=<?php echo $rid;?>" class="btn">Book Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
        }
        ?>
    </div>

    <div class="swiper-pagination"></div>

</div>

</section>


   <!-- end -->

   <!-- services -->



   <!-- end -->

   <!-- gallery -->

   <section class="gallery" id="gallery">

      <h1 class="heading">our gallery</h1>

      <div class="swiper gallery-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
               <img src="images/Pool.JPG" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
               <img src="images/Resto.JPG" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
               <img src="images/Jogging area.JPG" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
               <img src="images/Gym.JPG" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
               <img src="images/IMG_6881.JPG" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
               <img src="images/gallery6.jpg" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
               <img src="images/gallery1.jpg" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>


            <div class="swiper-slide slide">
               <img src="images/gallery2.jpg" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>


            <div class="swiper-slide slide">
               <img src="images/gallery3.jpg" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>


            <div class="swiper-slide slide">
               <img src="images/gallery4.jpg" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>


            <div class="swiper-slide slide">
               <img src="images/gallery5.jpg" alt="">
               <div class="icon">
                  <i class="fas fa-magnifying-glass-plus"></i>
               </div>
            </div>
         </div>

      </div>

   </section>

   <!-- end -->

   <!-- review -->

   <section class="review" id="review">

      <div class="swiper review-slider">
         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
               <h2 class="heading">client's review</h2>
               <i class="fas fa-quote-right"></i>
               <p>From the moment I stepped into the lobby, I knew I was in for a treat at Fabulous Finds by Sabrina Hotel. The stylish decor, combined with the warm and friendly staff, created an atmosphere of pure comfort. The culinary delights from the on-site restaurant added the perfect touch to my memorable stay.</p>
               <div class="user">
                  <img src="images/judz.jpg" alt="">
                  <div class="user-info">
                     <h3>Judz</h3>
                     <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                     </div>
                  </div>
               </div>
            </div>

            <div class="swiper-slide slide">
               <h2 class="heading">client's review</h2>
               <i class="fas fa-quote-right"></i>
               <p>Fabulous Finds by Sabrina Hotel exceeded all my expectations! The attention to detail in the room design and the impeccable service from the staff made my stay truly exceptional. I can't wait to return for another luxurious experience.</p>
               <div class="user">
                  <img src="images/rica.jpg" alt="">
                  <div class="user-info">
                     <h3>Rica</h3>
                     <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                     </div>
                  </div>
               </div>
            </div>

            <div class="swiper-slide slide">
               <h2 class="heading">client's review</h2>
               <i class="fas fa-quote-right"></i>
               <p>Choosing Fabulous Finds by Sabrina Hotel was the best decision for my business trip. The prime location, coupled with the seamless check-in process and comfortable amenities, made my stay both convenient and enjoyable. I highly recommend this hotel for a top-notch experience.</p>
               <div class="user">
                  <img src="images/aljon.jpg" alt="">
                  <div class="user-info">
                     <h3>Aljon</h3>
                     <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                     </div>
                  </div>
               </div>
            </div>

           

           

         </div>
         <div class="swiper-pagination"></div>
      </div>

   </section>

   <!-- end -->

   <!-- faq -->

   <section class="faqs" id="faq">

      <h1 class="heading">Frequently Asked Questions</h1>
   
      <div class="row">
   
         <div class="image">
            <img src="images/FAQs.gif" alt="Frequently Asked Questions">
         </div>
   
         <div class="content">
   
            <div class="box active">
               <h3>How can I make an online reservation?</h3>
               <p>To make an online reservation, you can visit our website and use the booking system. Select your desired dates, room type, and complete the required information to finalize your reservation.</p>
            </div>
   
            <div class="box">
               <h3>What payment methods are accepted for online bookings?</h3>
               <p>We accept various payment methods for online bookings, including credit cards and other secure online payment options. Please check our payment policy for more details.</p>
            </div>
   
            <div class="box">
               <h3>Is my personal information secure when making an online reservation?</h3>
               <p>Yes, we take the security of your personal information seriously. Our website uses encryption and secure protocols to ensure that your data is protected during the reservation process. We do not share your information with third parties.</p>
            </div>
   
            <div class="box">
               <h3>Can I modify or cancel my online reservation?</h3>
               <p>Yes, you can modify or cancel your reservation through our website. Please refer to our reservation policy for details on modification and cancellation fees, as well as the timeframe for making changes to your booking.</p>
            </div>
   
            <div class="box">
               <h3>Do I receive a confirmation after making an online reservation?</h3>
               <p>Yes, once you complete the online reservation process, you will receive a confirmation email with the details of your booking. Please review this confirmation to ensure that all information is accurate.</p>
            </div>
   
         </div>
   
      </div>
   
   </section>
   

   <!-- end -->

   

   <!-- footer -->









<?php 
include('frontend-components/footer.php');
?>








