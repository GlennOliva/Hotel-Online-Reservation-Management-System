<?php
    include('frontend-components/header.php');
    include('connection/dbcon.php');
    include('components/chat-header.php');

?>





<?php
if(!isset($_SESSION['user_id']))

{
    echo '<script>
                                    swal({
                                        title: "Error",
                                        text: "You must login first before you proceed!",
                                        icon: "error"
                                    }).then(function() {
                                        window.location = "login.php";
                                    });
                                </script>';
                                exit;
}

?>




<main class="main-container" style='margin: 8%;'>
        <div class="main-title">
          <p class="font-weight-bold">Manage Chats</p>
        </div>

        <body>
		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
				<div class="card-header">
    <div class="input-group">
        <form action="" method="post">
            <input type="text" placeholder="Search..." name="search_user" class="form-control search">
        </form>
    </div>
</div>
<div class="card-body contacts_body">
    <ul class="contacts">
        <?php
        // Check if search query is set
        if (isset($_POST['search_user'])) {
            $search_query = $_POST['search_user'];
            // SQL query to search for users based on full name
            $sql = "SELECT * FROM tbl_admin WHERE full_name LIKE '%$search_query%'";
            $res = mysqli_query($conn, $sql);
            // Check if there are search results
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $admin_id = $row['id'];
                    $name = $row['full_name'];
                    ?>
                    <li class="active" data-user-id="<?php echo $admin_id; ?>">
                        <div class="d-flex bd-highlight">
                            <div class="user_info contact_name">
                                <span><?php echo $name; ?></span>
                                <p>Online</p>
                            </div>
                        </div>
                    </li>
                    <?php
                }
            } else {
                // Display a message if no search results found
                echo "<li>No admin found.</li>";
            }
        } else {
            // If search query is not set, display all users
            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($res)) {
                $admin_id = $row['id'];
                $name = $row['full_name'];
                ?>
                <li class="active">
                    <div class="d-flex bd-highlight">
                        <div class="user_info contact_name" data-user-id="<?php echo $admin_id; ?>">
                            <span><?php echo $name; ?></span>
                            <p>Online</p>
                        </div>
                    </div>
                </li>
                <?php
            }
        }
        ?>
    </ul>
</div>



					<div class="card-footer"></div>
				</div></div>
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">

							<div class="user_info">
    <span id="user_name_span"></span>

</div>

	
								
								
						
							</div>
					
							
						</div>
						<div class="card-body msg_card_body">
					

                        <?php 
$display_message_admin = "SELECT * FROM tbl_message WHERE user_id = $user_id";
$message_result_admin = mysqli_query($conn, $display_message_admin);

$display_message_user = "SELECT * FROM tbl_message_user WHERE user_id = $user_id";
$message_result_user = mysqli_query($conn, $display_message_user);

// Store all messages in an array
$messages = array();

while ($row_admin = mysqli_fetch_assoc($message_result_admin)) {
    $messages[] = array(
        'message' => $row_admin['message'],
        'created_at' => $row_admin['created_at'],
        'sender' => 'admin'
    );
}

while ($row_user = mysqli_fetch_assoc($message_result_user)) {
    $messages[] = array(
        'message' => $row_user['message'],
        'created_at' => $row_user['created_at'],
        'sender' => 'user'
    );
}

// Sort messages by created_at in descending order
usort($messages, function($a, $b) {
    return strtotime($a['created_at']) - strtotime($b['created_at']);
});

// Display messages in reverse order
foreach ($messages as $message) {
    if ($message['sender'] == 'user') {
        ?>
        <div class="d-flex justify-content-end mb-4">
            <div class="msg_cotainer_send">
                <?php echo $message['message']; ?>
                <span class="msg_time"><?php echo $message['created_at']; ?></span>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="d-flex justify-content-start mb-4">
            <div class="msg_cotainer">
                <?php echo $message['message']; ?>
                <span class="msg_time_send"><?php echo $message['created_at']; ?></span>
            </div>
        </div>
        <?php
    }
}

// Handle case where no messages are found
if (empty($messages)) {
    echo "<div>No messages found</div>";
}
?>






								
								
						
						
						</div>
						<div class="card-footer">
						<form action="" method="post">
							<div class="input-group">
							
								<textarea name="chat" class="form-control type_msg" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
								<button type="submit" class="input-group-text send_btn" name="send"><i class="fas fa-location-arrow"></i></button>
								</div>
								

								<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
								<input type="hidden" name="admin_id" value="<?php echo $admin_id;?>">

								
							</div>
							</form>
							<?php
							if(isset($_SESSION['user_id']))
							{
								$admin_id = $_SESSION['user_id'];
							if(isset($_POST['send']))
							{
								$message = $_POST['chat'];
								$user_id = $_POST['user_id'];
								$admin_id = $_POST['admin_id'];
								

								$insert_message = "INSERT INTO tbl_message_user SET user_id = '$user_id', admin_id = '$admin_id', message = '$message' , created_at = NOW() ";
								$result = mysqli_query($conn,$insert_message);

								if($result==true)
								{
									echo '<script>
                                    swal({
                                        title: "Success",
                                        text: "Sucessful send message",
                                        icon: "success"
                                    }).then(function() {
                                        window.location = "chat.php";
                                    });
                                </script>';
                                exit;
								}
								else
								{
									echo '<script>
                                    swal({
                                        title: "Error",
                                        text: "Failed send message",
                                        icon: "error"
                                    }).then(function() {
                                        window.location = "chat.php";
                                    });
                                </script>';
                                exit;
								}
							}
						}
							
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="scripts.js"></script>

    <script>
        $(document).ready(function(){
	$('#action_menu_btn').click(function(){
		$('.action_menu').toggle();
	});
});
    </script>
	</body>
</html>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    const contactList = document.querySelectorAll('.contacts li');

    contactList.forEach(function(contact) {
        contact.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            console.log('User ID:', userId);

            // Fetch the username
            const userNameElement = this.querySelector('.contact_name span');
            if (userNameElement) {
                const userName = userNameElement.innerText.trim(); // Trim any leading/trailing spaces
                console.log('User Name:', userName);

                // Display the username in the user_info span
                const userInfoSpan = document.getElementById('user_name_span');
                if (userInfoSpan) {
                    userInfoSpan.innerText = userName;
                } else {
                    console.log('Error: user_name_span not found.');
                }
            } else {
                console.log('Error: Username element not found.');
            }
        });
    });
});

</script>







      </main>
      <!-- End Main -->



   