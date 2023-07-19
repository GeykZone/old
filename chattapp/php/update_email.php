<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $unique_id = $_SESSION['unique_id'];
    if(!empty($email))
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {

          $sql = "UPDATE `users` SET `email`= '$email' WHERE `unique_id` = '$unique_id' ";
          if ($conn->query($sql) === TRUE)
          {
              echo "Updated successfully";
          }
          else
          {
            echo "Error in updating email name";
          }

        }
        else
        {
            echo "$email is not a valid email!";
        }


    }
    else
    {
        echo "All input fields are required!";
    }
?>
