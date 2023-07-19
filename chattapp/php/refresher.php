<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";


        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        if ($result=mysqli_query($conn,$sql))
          {
          // Return the number of rows in result set
               $updatedrowcount = mysqli_num_rows($result);
               //set cookies
               setcookie('usertabupdatedTable', $updatedrowcount, time() + (86400 * 30), "/"); // 3d days

          }
    }
    else
    {
        header("location: ../login.php");
    }

?>
