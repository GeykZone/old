
<?php
include "../connection/connect.php";
 ?>

 <?php
 if(isset($_SESSION['log'])) {
 header("location: usertab.php");
 }
 elseif(isset($_SESSION['adminlog'])){
  header("location: ../admin/admintab.php");
  }
  ?>



<!--register-->
<?php
$alert = 0;
if(isset($_POST['register_submit']))
{

  $phone = $_POST['phone'];
  $name = $_POST['fname'];
  $name = ucwords($name);//to make evry first leeter capitalize//
  $age = $_POST['age'];
  $currentjob = $_POST['CurrentJob'];
  $salary = $_POST['optradio'];
  $password = $_POST['createpwd'];
  $password = password_hash($password, PASSWORD_DEFAULT);


  $sql = "INSERT INTO `user`(`phonenumber`, `fullname`, `age`, `job`, `salary`, `password`) VALUES ('$phone','$name','$age','$currentjob','$salary','$password')";
  if ($conn->query($sql) === TRUE)
  {
    $alert = 1;
  }
  else {

    $alert = 2;

  }
}
 ?>


 <!---Login-->
 <?php
if (isset($_POST['login_submit']))
{
  $checkbox ="";
  $cookie_name  = "";
  $cookie_value = "";
  $log_number = $_POST['lognumber'];
  $log_Pass = $_POST['user_log_pass'];

  $_SESSION['phoneNumber'] = $log_number;

  //setting cookies
  if (isset($_POST['remember'])) {
    $checkbox = "checked";
   }

   if ($checkbox == "checked") {

     $cookie_name  = 'user_cookies';
     setcookie($cookie_name, $log_number, time() + (86400 * 30), "/"); // 3d days
   }


   if(!isset($_COOKIE[$cookie_name]))
   {
     $cookielog = $log_number;


  }
  else
  {
    $cookielog = $log_number;

  }
   ///end//


  $sql= "SELECT `phonenumber`, `fullname`, `age`, `job`, `salary`, `password` FROM `user` WHERE `phonenumber` = '$cookielog'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
    {$hash = $row['password'];

        if (password_verify($log_Pass, $hash))
        {
          $_SESSION['logged_in'] = "set";
          header("Location: usertab.php");
        }
        else
        {
          $alert=3;
        }
    }

  }
  else {
  $alert=3;//Information is invalid

  ?>
  <script type="text/javascript">

  alert(<?php echo "error phone"; ?>)

  </script>
  <?php
  }

}

  ?>



<!--- HTML Starts here --->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <link rel="stylesheet" href="UserNav.css">
  <link rel="stylesheet" href="../alertcss/warning.css">
  <link rel="stylesheet" href="../alertcss/success.css">
</head>
<body style="background:#555;">

<div class="container_for_body_sidebar container-fluid" style="background:white; margin-bottom: -30px;">

  <div class="row content" style="height: 930px;">
    <div class="col-sm-2 sidenav">
      <div class="logoTittle">
          <img id="logo" class="logo img-responsive" src="../Images/logo/MLMS.png" alt="Logo" style="width:200px; height:auto;   display: block; margin-left: auto; margin-right: auto;">
      </div>

      <ul class="nav nav-pills nav-stacked" id="sideUL">
        <li class="navBTN" ><a href="../index.php">Home</a></li>
        <li  class="navBTN"><a href="../admin/admin.php">Admin</a></li>
        <li  class="navBTN active"><a href="user.php">User</a></li>
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


      <!--login area-->
      <div class="adminLog container-fluid">
        <h2>User Login</h2>

        <form action="" id="loginform" method="post">
          <div class="form-group">
            <label for="loginnum">Phone Number</label>
            <input type="number" name="lognumber" class="form-control" id="loginnum" ondrop="return false;" onpaste="return false;" placeholder="Enter phone number" required
            onkeypress='return event.charCode>=48 && event.charCode<=57' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength="11">
          </div>

          <div class="form-group">
            <label for="user_log_pass">Password:</label>
            <input type="password" class="form-control" id="user_log_pass" placeholder="Enter password" name="user_log_pass" required>
          </div>

          <div class="checkbox">
            <label><input type="checkbox" name="remember"> Remember me</label>
          </div>
          <button type="submit" name="login_submit" class="submitButton" form="loginform" onclick="numberlength()">Submit</button>
        </form>


        <!--Modal--->
        <h2>Don't Have an Account?</h2>

        <!-- Trigger the modal with a button -->
        <button type="button" class="modalBotton" data-toggle="modal" data-target="#myModal"><span>Create New Account</span></button>

        <!-- Modal --> <!--for creating new account-->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Account Setup</h4>
              </div>
              <div class="modal-body">


                <!--Create account form-->
                <form action="" id="createActform" method="post">

                  <div class="form-group">
                    <label for="phone">Phone Number</label>

                    <!-- to hide the increment arrow-->
                    <style>
                    /* Chrome, Safari, Edge, Opera */
                    input::-webkit-outer-spin-button,
                    input::-webkit-inner-spin-button {
                      -webkit-appearance: none;
                      margin: 0;
                    }

                    /* Firefox */
                    input[type=number] {
                      -moz-appearance: textfield;
                    }
                  </style>

                    <input type="number" class="form-control" name="phone" value="" id="phone" ondrop="return false;" onpaste="return false;" placeholder="Enter phone number" required
                    onkeypress='return event.charCode>=48 && event.charCode<=57' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11">
                  </div>

                  <div class="form-group">
                    <label for="fname">Full Name:</label>
                    <input type="fname" class="form-control" id="fname" placeholder="Enter full name" name="fname" required style="text-transform: capitalize;">
                  </div>

                  <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" class="form-control" id="age" placeholder="Enter age" name="age" required
                      onkeypress='return event.charCode>=48 && event.charCode<=57' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="3">
                  </div>

                  <div class="form-group">
                    <label for="CurrentJob" value="Current Job" >Current Job:</label>
                    <input type="job" class="form-control" id="CurrentJob" placeholder="Enter current job" name="CurrentJob" required style="text-transform:capitalize;">
                  </div>

                  <!--dropdown-->
                  <div class="form-group">
                    <div class="dropdown">
                      <style media="screen">
                        .caret
                        {
                          color: white !important;
                        }
                      </style>
                      <button id="saldropdown" class="saldropdown" type="button" required data-toggle="dropdown" >Select Salary
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <div class="container-fluid">
                            <div class="radio">
                              <label><input  type="radio" onclick="change()" name="optradio" value="10K+ Monthly" required>10K+ Monthly</label>
                            </div>
                            <div class="radio">
                              <label><input type="radio" name="optradio" onclick="change()" value="20K+ Monthly">20K+ Monthly</label>
                            </div>
                            <div class="radio">
                              <label><input type="radio" name="optradio" onclick="change()" value="50K+ Monthly">50K+ Monthly</label>
                            </div>
                            <div class="radio">
                              <label><input type="radio" name="optradio" onclick="change()" value="100K+ Monthly">100K+ Monthly</label>
                            </div>
                          </div>
                        </ul>
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="createpwd">Password:</label>
                    <input type="password" class="form-control" id="createpwd" placeholder="Enter password" name="createpwd" required>
                  </div>

                  <button name="register_submit" type="submit" class="submitButton" form="createActform">Submit</button>
                </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="closedropdown" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

      </div>



      <!--Logo-->
      <div class="userlogocontainer container-fluid"  >
        <img id="logohome" class="logohome img-responsive" src="../Images/bg/userbg.png" alt="Logo" style="width:800px; height:auto; margin-top: 80px; margin-left: auto; margin-right: auto;">
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

//script to change the dropdown text
function change()
{
  var radios = document.getElementsByName('optradio');
  for (var i = 0, length = radios.length; i < length; i++) {
    if (radios[i].checked) {
      document.getElementById("saldropdown").innerHTML = "Salary: " + radios[i].value + " ";
      document.getElementById("saldropdown").value = radios[i].value
      break;
    }
  }

//to add span in create account button
  var span = document.getElementById("saldropdown");
    var a = document.createElement('a');
  // Set attribute for span element, such as id
        a.setAttribute("class", "caret");
        span.appendChild(a);
}




//to stop incrementing the input number when using arrow and mouse scroll
$(document).ready(function() {
    $("input[type=number]").on("focus", function() {
        $(this).on("keydown", function(event) {
            if (event.keyCode === 38 || event.keyCode === 40) {
                event.preventDefault();
            }
        });
    });
});


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


<!--Php alert and Jscipt combined-->
<?php
echo '<script> if ( window.history.replaceState ){window.history.replaceState( null, null, window.location.href );}</script>'; //to avoid resubmition

if ($alert==1)
{
  ?><script>
  setTimeout(function()
  {
             $('.alert_success').addClass("show");
             $('.alert_success').removeClass("hide");
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
    }, 10);
  </script>

  <?php
}

elseif ($alert==2)
{
  ?><script>
  setTimeout(function()
  {
             $('.alert_warning').addClass("show");
             $('.alert_warning').removeClass("hide");
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
    }, 10);
  </script><?php
}


elseif ($alert==3)
{
  ?><script>
  setTimeout(function()
  {
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
    }, 10);
  </script><?php
}




 ?>

</body>
</html>
