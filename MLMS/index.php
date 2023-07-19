
<?php
include "connection/connect.php";
 ?>

 <?php
 if(isset($_SESSION['log']))
 {
 header("location: user/usertab.php");
 }
 elseif(isset($_SESSION['adminlog']))
 {
  header("location: admin/admintab.php");
  }
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background:#555;">

<div class="container-fluid" style="background:white; margin-bottom:-10px;">
  <div class="row content">
    <div class="col-sm-2 sidenav" style="height: 98.9%;">
      <div class="logoTittle">
          <img id="logo" class="logo img-responsive" src="Images/logo/MLMS.png" alt="Logo" style="width:200px; height:auto;   display: block; margin-left: auto; margin-right: auto;">
      </div>

      <ul class="nav nav-pills nav-stacked" id="sideUL">
        <li class="navBTN active" ><a href="index.php">Home</a></li>
        <li  class="navBTN"><a href="admin/admin.php">Admin</a></li>
        <li  class="navBTN"><a href="user/user.php">User</a></li>
        <li  class="navBTN"><a href="about.php">About</a></li>
      </ul>

    </div>


  <!-- View Area para sa section-->
    <div class="col-sm-9" id="viewArea">

      <div class="container-fluid" >
        <img id="logohome" class="logohome img-responsive" src="Images/bg/bghome.png" alt="Logo" style="width:800px; height:auto; margin-top:175px; display: block; margin-left: auto; margin-right: auto;">

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

</body>
</html>
