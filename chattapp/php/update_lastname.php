<?php
    session_start();
    include_once "config.php";
    $lastname = mysqli_real_escape_string($conn, $_POST['lname']);
    $unique_id = $_SESSION['unique_id'];
    if(!empty($lastname))
    {
      $sql = "UPDATE `users` SET `lname`= '$lastname' WHERE `unique_id` = '$unique_id' ";
      if ($conn->query($sql) === TRUE)
      {
          echo "Updated successfully";
      }
      else {
        echo "Error in updating last name";
      }
    }
    else
    {
        echo "All input fields are required!";
    }
?>
