<?php
    session_start();
    $endsession = 0;
    include_once "config.php";
    $unique_id = $_SESSION['unique_id'];

      $sql = "DELETE FROM `users` WHERE `unique_id`= $unique_id";
      if ($conn->query($sql) === TRUE)
      {
          echo "Account has been deleted";

          if(isset($_SESSION['unique_id'])){
              if(isset($unique_id)){
                  $status = "Offline now";
                  $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = '{$unique_id}' ");
                  if($sql){
                    session_unset();
                    session_destroy();
                      header("location: ../login.php");
                      $endsession = 1;
                  }
              }else{
                  header("location: ../users.php");
              }
          }else{
              header("location: ../login.php");
          }


      }
      else {
        echo "Error in deleting account";
      }

?>
