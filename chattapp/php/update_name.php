<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $unique_id = $_SESSION['unique_id'];
    if(!empty($fname))
    {
      $sql = "UPDATE `users` SET `fname`= '$fname' WHERE `unique_id` = '$unique_id' ";
      if ($conn->query($sql) === TRUE)
      {
          echo "Updated successfully";
      }
      else {
        echo "Error in updating first name";
      }
    }
    else
    {
        echo "All input fields are required!";
    }
?>
