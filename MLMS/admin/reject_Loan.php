<?php
include "../connection/connect.php";
 ?>


 <?php
 $ph = $_COOKIE['get_phonenumber_to_approve'];
 $rejstats = "Rejected";
 $daterej = $_COOKIE['application_approved'];
 $sql = "UPDATE `pending` SET `status`= '$rejstats',  `currentdate`= '$daterej' WHERE `phone` = '$ph'";
 if ($conn->query($sql) === TRUE)
 {

    $sql = "Insert Into loanhistory (select * from pending WHERE phone=$ph)";
     $result = $conn->query($sql);
     if ( $result === TRUE)
     {
       $alert = 9;

       $sql = "DELETE FROM `pending` WHERE `phone`= $ph ";
       $result = $conn->query($sql);
     }

 }
 else
 {
   alert("error");
 }

  ?>

  <?php
  echo '<script> if ( window.history.replaceState ){window.history.replaceState( null, null, window.location.href );}</script>'; //to avoid resubmition
  if ($alert==9)
  {
    ?><script>

               $('.alert_warning').addClass("show");
               $('.alert_warning').removeClass("hide");
               document.getElementById("warning").innerHTML = "Loan has been rejected!";
               document.getElementById("warning").style.fontSize = "18px";
               $('.alert_warning').addClass("showAlert");
               setTimeout(function()
               {
                 $('.alert_warning').removeClass("show");
                 $('.alert_warning').addClass("hide");
               },5000);

             $('.close-btn').click(function()
             {
               $('.alert_warning').removeClass("show");
               $('.alert_warning').addClass("hide");
             });

    </script><?php

    $alert=0;
  }

   ?>
