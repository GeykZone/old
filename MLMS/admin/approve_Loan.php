<?php
include "../connection/connect.php";

 ?>


 <?php
 $ph = $_COOKIE['get_phonenumber_to_approve'];
 $dateapproved = $_COOKIE['application_approved'];
 $approvedduedate = $_COOKIE['application_approved_due'];
 $approvestats = "Approved";
 $sql = "UPDATE `pending` SET `date`= '$dateapproved',`dueDate`= '$approvedduedate',`status`= '$approvestats',`currentdate`= '$dateapproved' WHERE `phone` = '$ph'";
 if ($conn->query($sql) === TRUE)
 {


   //move table content to other table
   $sql = "Insert Into approved (select * from pending WHERE phone=$ph)";
   $result = $conn->query($sql);
   if ( $result === TRUE)
   {

     $sql = "Insert Into loanhistory (select * from approved WHERE phone=$ph)";
     $result = $conn->query($sql);
     if ( $result === TRUE)
     {
       $alert = 1;

       $sql = "DELETE FROM `pending` WHERE `phone`= $ph ";
       $result = $conn->query($sql);
     }
   }
   else {
      $sql = "UPDATE `pending` SET `date`= 'Pending',`dueDate`= 'Pending',`status`= 'Pending',`currentdate`= 'Pending' WHERE `phone` = '$ph'";
       if ($conn->query($sql) === TRUE)
       {
               $alert = 2;
       }
   }
   //

 }

  ?>

  <?php
  echo '<script> if ( window.history.replaceState ){window.history.replaceState( null, null, window.location.href );}</script>'; //to avoid resubmition
  if ($alert==1)
  {
    ?><script>

               $('.alert_success').addClass("show");
               $('.alert_success').removeClass("hide");
               document.getElementById("okay").innerHTML = "Loan application accepted!";
               $('.alert_success').addClass("showAlert");
               setTimeout(function()
               {
                 $('.alert_success').removeClass("show");
                 $('.alert_success').addClass("hide");
               },5000);

             $('.close-btn').click(function()
             {
               $('.alert_success').removeClass("show");
               $('.alert_success').addClass("hide");
             });

               window.location.reload();

    </script><?php

    $alert = 0;
  }

  elseif ($alert==2)
  {
    ?><script>

               $('.alert_warning').addClass("show");
               $('.alert_warning').removeClass("hide");
               document.getElementById("warning").innerHTML = "User has an unpaid loan!";
               document.getElementById("warning").style.fontSize = "20px";
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
        $alert = 0;
  }

   ?>
