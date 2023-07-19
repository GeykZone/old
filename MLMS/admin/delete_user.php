<?php
include "../connection/connect.php";
 ?>


<?php
$delphone = $_SESSION['User_history'];


$sql = "DELETE FROM `user` WHERE `phonenumber`= $delphone";
$result = $conn->query($sql);


$sql = "DELETE FROM `loanhistory` WHERE `phone`= $delphone";
$result = $conn->query($sql);


$sql = "DELETE FROM `pending` WHERE `phone`= $delphone";
$result = $conn->query($sql);

$sql = "DELETE FROM `paid` WHERE `phone`= $delphone";
$result = $conn->query($sql);

$sql = "DELETE FROM `approved` WHERE `phone`= $delphone";
$result = $conn->query($sql);

$alert = 10;
 ?>


 <?php
 echo '<script> if ( window.history.replaceState ){window.history.replaceState( null, null, window.location.href );}</script>'; //to avoid resubmition
 if ($alert==10)
 {
   ?><script>

              $('.alert_success').addClass("show");
              $('.alert_success').removeClass("hide");
              document.getElementById("okay").innerHTML = "User has been deleted!";
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
