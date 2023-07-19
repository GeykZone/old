<?php
include "../connection/connect.php";
 ?>

<?php
$alert=0;
if(isset($_SESSION['adminlogged_in']))
{
    $_SESSION['adminlog'] = "log"; 
}
else
{
  if(session_destroy()){
      header("location: admin.php");
  }
}
?>

<!--update the admin profile-->
 <?php
 if (isset($_POST['update_admin_now'])) {
   $adname = $_SESSION['adminname'];
   $updatename = $_POST['adname'];
   $updatename = ucwords($updatename);
   $updatepass = $_POST['adpass'];
   $updatepass = password_hash($updatepass, PASSWORD_DEFAULT);
//update
   $sql = "UPDATE `admin` SET `Name`= '$updatename',`Password`= '$updatepass' WHERE `Name` = '$adname'";
   if ($conn->query($sql) === TRUE)
   {
     $alert = 1;
   }
   else {
     ?>
      <script type="text/javascript">
        alert('Error');
      </script>
     <?php
   }
   // code...
 }
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Tabs</title>
  <?php
    include "header.php"; //to call the linksheets
   ?>
</head>
<body  onload="loadTable()" style="  background-color: #555;"><!--#555-->
<!--header navbar area-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" data-toggle="modal" data-target="#adminupdate">Admin</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-left" >
        <li class="nav-item nav-userlist"><a  href="admintab.php?page=userlist" onclick="">Users</a></li>
        <li class="nav-item nav-pending"><a  href="admintab.php?page=pending">Pending</a></li>
        <li class="nav-item nav-approved "><a  href="admintab.php?page=approved">Approved</a></li>
        <li class="nav-item nav-paid "><a  href="admintab.php?page=paid">Paid</a></li>
      </ul>
    </div>
    </div>
  </div>
</nav>
<!--tittle area-->
<div class="container-fluid" style="background: #f1f1f1;">
    <img id="logohome" class="logohome img-responsive center-block" src="../Images/logo/MLMS.png" alt="Logo" style="margin-top: -8%; margin-bottom: -5%; margin-right: 35%; margin-left:35%; height:auto; width: 30%!important;" >
</div>

<!--content view-->
<div class="container-fluid" style="background:white; height:auto; padding-bottom: 50px; padding-top: 50px;" id="displayport">
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

  <!--to view other page that is not part of this page-->
  <?php $page = isset($_GET['page']) ? $_GET['page'] :'userlist'; ?>
  <?php include $page.'.php' ?>



</div>

<div class="container-fluid" style="background: #f1f1f1;">
    <img id="logohomedown" class="logohomedown img-responsive center-block" src="../Images/bg/adminbg.png" alt="Logo" style="  height:auto; width: 40%; margin-top:10px;" >
    <!--modal for admin update------------->
    <div class="modal fade" id="adminupdate" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="adminname">Admin: </h4>
          </div>
          <div class="modal-body">

            <!--Create account form-->
            <form action="" id="update_admin_info" method="post">
              <div class="form-group">
                <label for="adname">Update Admin Name:</label>
                <input type="text" class="form-control" id="adname" placeholder="Enter admin user name" name="adname" required style="text-transform: capitalize;">
              </div>
              <div class="form-group">
                <label for="adpass">Update Password:</label>
                <input type="password" class="form-control" id="adpass" placeholder="Enter password" name="adpass" required>
              </div>
              <button name="update_admin_now" type="submit" class="submitButton" form="update_admin_info">Update</button>
            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="closedropdown" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!------------------------------>
</div>



<footer class="container-fluid col-sm-12 text-center" style="font-size:12px;">
  <p>System Created By Geykson M. Maravillas</p>
  <p>Designed Using Bootstrap3 Templates</p>
  <p>© 5/2/2022 - <script> document.write(new Date().getDate());</script>/<script> document.write(new Date().getMonth());</script>/<script> document.write(new Date().getFullYear());</script>  </p>
</footer>


<!--javascript-->
<script type="text/javascript">

//make the navbar active when load
$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : 'userlist' ?>').addClass('active')

//to add dataTables
$(document).ready(function() {
    $('#example').DataTable( {
        "pagingType": "simple"
    } );
} );
</script>

<?php
echo '<script> if ( window.history.replaceState ){window.history.replaceState( null, null, window.location.href );}</script>'; //to avoid resubmition
if ($alert==1)
{
  ?><script>
  setTimeout(function()
  {
             $('.alert_success').addClass("show");
             $('.alert_success').removeClass("hide");
             document.getElementById("okay").innerHTML = "Your account is now updated!";
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
  </script><?php
  $alert = 0;
}

 ?>


</body>
</html>
