<?php
    include('components/header.php');
?>


<?php
        include('components/sidebar.php');
      ?>


<?php
if(!isset($_SESSION['admin_id']))
{
    echo '<script>
                                    swal({
                                        title: "Error",
                                        text: "You must login first before you proceed!",
                                        icon: "error"
                                    }).then(function() {
                                        window.location = "admin_login.php";
                                    });
                                </script>';
                                exit;
}

?>



<main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">Manage User</p>
        </div>

        <table class="table table-bordered">
        <thead>
            <tr class="table-dark">
                <th scope="col">User ID</th>
                <th scope="col">User Full_Name</th>
                <th scope="col">User Email</th>
                <th scope="col">User Phone_Number</th>
                <th scope="col">User Address</th>
                <th scope="col">Status</th>
                <!-- Add more table headers as needed -->
            </tr>
        </thead>
        <tbody>
            <tr>

            <?php

        $sql = "SELECT * FROM tbl_user ";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                $ids = 1;

                while ($rows = mysqli_fetch_assoc($result)) {
                    $id = $rows['id'];
                    $full_name = $rows['full_name'];
                    $email = $rows['email'];
                    $phone = $rows['phone'];
                    $address = $rows['address'];
                    $status = $rows['status'];
                    ?>
                <td><?php echo $ids++;?></td>
                <td><?php echo $full_name;?></td>
                <td><?php echo $email;?></td>
                <td><?php echo $phone;?></td>
                <td><?php echo $address;?></td>
                <td><?php echo $status;?></td>
                <!-- Add more table data as needed -->
            </tr>
            <!-- Add more rows as needed -->
        </tbody>

        <?php
                }
            }
        }
    ?>
    </table>
      </main>
      <!-- End Main -->



      <?php
        include('components/footer.php');
      ?>