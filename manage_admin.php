<?php
    include('components/header.php');
    include('connection/dbcon.php');

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
          <p class="font-weight-bold">Manage Admin</p>
        </div>

        <div class="btn btn-success" style="background-color: #28a745; border-color: #28a745; margin-bottom: 1%;">
    <a href="add_admin.php" style="text-decoration: none; color: #fff;">
        <span class="material-icons-sharp" ></span> Add Admin
    </a>
</div>



<table class="table table-bordered" id='admin_table'>
    <thead >
    <tr class="table-dark">
    <th scope="col">Admin ID</th>
    <th scope="col">Admin Full_Name</th>
    <th scope="col">Admin Email</th>
    <th scope="col">Status</th>
    <th scope="col">Actions</th>
    <!-- Add more table headers as needed -->
</tr>

    </thead>
    <tbody>
    <?php
     if(isset($_SESSION['admin_id']))

     {
         $admin_id = $_SESSION['admin_id'];
        $sql = "SELECT * FROM tbl_admin";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                $ids = 1;

                while ($rows = mysqli_fetch_assoc($result)) {
                    $id = $rows['id'];
                    $full_name = $rows['full_name'];
                    $email = $rows['email'];

                    $status = $rows['status'];
                    ?>
                    <tr>
                        <td><?php echo $ids++; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $email; ?></td>

                        <td><?php echo $status; ?></td>
                        <td>
                            <a href="update_admin.php?id=<?php echo $id; ?>" class="btn btn-primary">Edit</a>
              


<form action="code.php" method="post">
                                    <button type="button"  class="btn btn-danger delete_adminbtn" value="<?= $id;?>"> Delete</button>
                                    </form>

                        </td>
                    </tr>
                    <?php
                }
            }
        }
    }
    ?>
</tbody>

</table>



      </main>
      <!-- End Main -->



      <?php
        include('components/footer.php');
      ?>