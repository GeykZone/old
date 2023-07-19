<?php
include "../connection/connect.php";
 ?> 

 <?php
if(isset($_SESSION['adminlog'])){
 header("location: admintab.php");
 }
 elseif(isset($_SESSION['log'])) {
 header("location: ../user/usertab.php");
 }
  ?>

 <?php
 $alert = 0;

 if(isset($_POST['admin_submit']))
 {
   $checkbox ="";
   $cookie_name  = "";
   $adminame = $_POST['username'];
   $adminpass = $_POST['pwd'];
   $_SESSION['adminname'] =  $adminame;

   //setting cookies
   if (isset($_POST['remember'])) {
     $checkbox = "checked";
    }

    if ($checkbox == "checked") {

      $cookie_name  = 'admin_cookies';
      setcookie($cookie_name, $adminame, time() + (86400 * 30), "/"); // 3d days
    }

    if(!isset($_COOKIE[$cookie_name]))
    {
      $cookieadmin = $adminame;

   }
   else
   {
     $cookieadmin = $adminame;

   }
    ///end//

    $sql= "SELECT `Name`, `Password` FROM `admin` WHERE `Name` = '$cookieadmin'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {

          if (password_verify($adminpass, $row['Password']))
          {
            $_SESSION['adminlogged_in'] = "set";
            header("Location: admintab.php");
          }
          else
          {
            $alert=1;
          }
      }

    }
    else {
      $alert=1;
    }

 }


  ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="AdminNav.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <link rel="stylesheet" href="../alertcss/warning.css">
  <link rel="stylesheet" href="../alertcss/success.css">
</head>
<body style="background:#555;">

<div class="container-fluid" style="background:white; margin-bottom: -15px;">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <div class="logoTittle">
          <img id="logo" class="logo img-responsive" src="../Images/logo/MLMS.png" alt="Logo" style="width:200px; height:auto;   display: block; margin-left: auto; margin-right: auto;">
      </div>

      <ul class="nav nav-pills nav-stacked" id="sideUL">
        <li class="navBTN" ><a href="../index.php">Home</a></li>
        <li  class="navBTN active"><a href="admin.php">Admin</a></li>
        <li  class="navBTN"><a href="../user/user.php">User</a></li>
        <li  class="navBTN"><a href="../about.php">About</a></li>
      </ul>

    </div>


  <!-- View Area para sa section-->
    <div class="col-sm-9" id="viewArea">

      <!--alerts template-->
      <div class="alert_warning hide">
         <span class="fas fa-exclamation-circle"></span>
         <span class="msg" id="warning">User already existed!</span>
         <div class="close-btn">
            <span class="fas fa-times"></span>
         </div>
      </div>

      <div class="alert_success hide">
         <span class="fas fa-exclamation-circle"></span>
         <span class="msg" id="okay">You are now registered!</span>
         <div class="close-btn">
            <span class="fas fa-times"></span>
         </div>
      </div>
      <!-------->

      <div class="adminLog container-fluid">
        <h2>Admin Login</h2>

        <form method="post" action="" id="adminform">

          <div class="form-group">
            <label for="username">User Name:</label>
            <input type="text" class="form-control" id="username" placeholder="Enter user name" name="username">
          </div>

          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
          </div>

          <div class="checkbox">
            <label><input type="checkbox" name="remember" id="rememberme"> Remember me</label>
          </div>

          <button type="submit" class="submitButton" form="adminform" name = "admin_submit">Submit</button>
        </form>
      </div>

      <div class="container-fluid" >
        <img id="logohome" class="logohome img-responsive" src="../Images/bg/adminbg.png" alt="Logo" style="width:800px; height:auto; margin-top:100px; display: block; margin-left: auto; margin-right: auto;">

      </div>

    </div>
  </div>
</div>

<footer class="container-fluid text-center" style="font-size: 12px;">
  <p>System Created By Geykson M. Maravillas</p>
  <p>Designed Using Bootstrap3 Templates</p>
  <p>© 5/2/2022 - <script> document.write(new Date().getDate());</script>/<script> document.write(new Date().getMonth());</script>/<script> document.write(new Date().getFullYear());</script>  </p>
</footer>

<!-- Java scripts -->
<script>

/*  when button is press or active it will change its color */
var header = document.getElementById("sideUL");
var btns = header.getElementsByClassName("navBTN");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>

<?php
echo '<script> if ( window.history.replaceState ){window.history.replaceState( null, null, window.location.href );}</script>'; //to avoid resubmition
if ($alert==1)
{
  ?><script>

             $('.alert_warning').addClass("show");
             $('.alert_warning').removeClass("hide");
             document.getElementById("warning").innerHTML = "The information is invalid!";
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
}

 ?>

</body>
</html>
