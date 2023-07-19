
<?php
include "../connection/connect.php";
 ?>

 <?php
 $paidph = $_COOKIE['get_phonenumber_to_paid'];
 $datepaid = $_COOKIE['paiddate'];
 $paidpayment = $_COOKIE['current_payable'];
 $paidstats = "Paid: $paidpayment";
 $sql = "UPDATE `approved` SET `status`= '$paidstats', `currentdate`= '$datepaid' WHERE `phone` = '$paidph'";
 if ($conn->query($sql) === TRUE)
 {


   //move table content to other table
   $sql = "Insert Into paid (select * from approved WHERE phone= $paidph )";
   $result = $conn->query($sql);
   if ( $result === TRUE)
   {

     $sql = "Insert Into loanhistory (select * from paid WHERE phone= $paidph )";
     $result = $conn->query($sql);
     if ( $result === TRUE)
     {
       $alert = 1;

       $sql = "DELETE FROM `approved` WHERE `phone`= $paidph ";
       $result = $conn->query($sql);
     }
   }
   else {
     ?><script type="text/javascript">

     alert("Error insert into paid");

     </script>  <?php
   }
   //

 }
 else {
   ?><script type="text/javascript">

   alert("error_update");

   </script>  <?php
 }



  ?>

  <?php
  echo '<script> if ( window.history.replaceState ){window.history.replaceState( null, null, window.location.href );}</script>'; //to avoid resubmition
  if ($alert==1)
  {
    ?><script>

               $('.alert_success').addClass("show");
               $('.alert_success').removeClass("hide");
               document.getElementById("okay").innerHTML = "User is marked as paid!";
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

   ?>
