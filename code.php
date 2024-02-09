<?php
include('connection/dbcon.php');
session_start();

if(isset($_POST['delete_adminbtn']))
{

    $id = $_POST['admin_id'];
    //Create SQL query to delete admin
$sql = "SELECT * FROM tbl_admin WHERE id=$id";

// Execute the query
$result = mysqli_query($conn, $sql);

$count2 = mysqli_fetch_array($result);




   $sql1 = "DELETE FROM tbl_admin WHERE id=$id";
   $result1 = mysqli_query($conn,$sql1);

   if($result1)
   {
    

        echo 200;

    }
    else
    {
        echo 500;
    }


}
else if(isset($_POST['delete_userbtn']))
{

    $id = $_POST['user_id'];
    //Create SQL query to delete admin
$sql = "SELECT * FROM tbl_user WHERE id=$id";

// Execute the query
$result = mysqli_query($conn, $sql);

$count2 = mysqli_fetch_array($result);




   $sql1 = "DELETE FROM tbl_user WHERE id=$id";
   $result1 = mysqli_query($conn,$sql1);

   if($result1)
   {
    

        echo 600;

    }
    else
    {
        echo 900;
    }


}

else if(isset($_POST['delete_roombtn']))
{
   $id = $_POST['room_id'];

   $sql2 = "SELECT * FROM tbl_room WHERE id=$id";

   $result2 = mysqli_query($conn,$sql2);
   
   $count = mysqli_fetch_array($result2);
   $image_name = $count['image'];

   $sql3 = "DELETE FROM tbl_room WHERE id=$id";
   $result3 = mysqli_query($conn,$sql3);

   if($result3)
   {
        if(file_exists("images/room/".$image_name))
        {
            unlink("images/room/".$image_name);
        }

        echo 400;

    }
    else
    {
        echo 800;
    }
 
    
  
 
}


?>