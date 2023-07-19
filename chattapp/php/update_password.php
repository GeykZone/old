<?php
    session_start();
    include_once "config.php";
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $unique_id = $_SESSION['unique_id'];
    if(!empty($password))
    {

          $encrypt_pass = md5($password);
          $sql = "UPDATE `users` SET `password`= '$encrypt_pass' WHERE `unique_id` = '$unique_id' ";
          if ($conn->query($sql) === TRUE)
          {
              echo "Updated successfully";
          }
          else
          {
            echo "Error in updating password name";
          }
    }
    else
    {
        echo "All input fields are required!";
    }
?>
