

<?php
include "connection/connect.php";
 ?>

<?php
if(isset($_SESSION['log'])) {
header("location: user/usertab.php");
}
elseif(isset($_SESSION['adminlog'])){
 header("location: admin/admintab.php");
 }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>ABout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="about.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background:#555;">

<div class="container-fluid" style="background:white; margin-bottom: -10px;" >
  <div class="row content">
    <div class="col-sm-2 sidenav" style="  background-color: #f1f1f1; height: 98.9%;">
      <div class="logoTittle">
          <img id="logo" class="logo img-responsive" src="Images/logo/MLMS.png" alt="Logo" style="width:200px; height:auto;   display: block; margin-left: auto; margin-right: auto;">
      </div>

      <ul class="nav nav-pills nav-stacked" id="sideUL">
        <li class="navBTN " ><a href="index.php">Home</a></li>
        <li  class="navBTN"><a href="admin/admin.php">Admin</a></li>
        <li  class="navBTN"><a href="user/user.php">User</a></li>
        <li  class="navBTN active"><a href="about.php">About</a></li>
      </ul>

    </div>


  <!-- View Area para sa section-->
    <div class="col-sm-9" id="viewArea">

      <div class="container-fluid" >
      <img id="aboutlogo" class="aboutlogo img-responsive" src="Images/bg/aboutbg.png" alt="Logo" style="width:800px; height:auto; margin-top:175px; display: block; margin-left: auto; margin-right: auto;">
      </div>

      <div class="aboutSystem container-fluid" style="width:50%; text-align:justify;">

        <p>This system is all about loan monitoring and application on a monthly basis. I created this system as a simple project for our IT6 Subject. It is important to note that any flaws in the system are due to the fact that it is only a prototype; hopefully, I the creator of this simple system will soon create a much larger system.</p>
        <p>This system's functionality is built with JavaScript: Ajax, jQuery, PHP and MySQL. The website's design is based on a Bootstrap 3 Template, and it employs basic forms, inputs, and plugins.</p>

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
