<?php
include "../connection/connect.php";
 ?>

<?php
setcookie('view_payable', " ", time() + (86400 * 30), "/"); // 3d days
if(isset($_SESSION['logged_in']))
{
    $_SESSION['log'] = "log";
}
else
{
  if(session_destroy()){
      header("location: user.php");
  }
}
?>


<!--for loan application-->
<?php
$alert = 0;
$phone = $_SESSION['phoneNumber'];
$userfullname = "";
//TO CALL THE USER INFO FROM DATABASE AND ASSIGN IT TO NEW define_syslog_variable
$sql = "SELECT `phonenumber`, `fullname`, `age`, `job`, `salary`, `password` FROM `user` WHERE `phonenumber` = '$phone'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
        $userfullname = $row["fullname"];
  }
}

if(isset($_POST['loan_submit']))
{
    $phone = $_SESSION['phoneNumber'];
    $name = "";
    $currentjob = "";
    $salary = "";
    $loanAmount = $_POST['loan_amount'];
    $bank = $_POST['Bname'];
    $description = $_POST['comment'];
    $date = "Pending";
    $dueDate = "Pending";
    $status = "Pending";
    $payable = "Pending";
    $paidamount = "Pending";
    $applicationdate = $_COOKIE['applicationdate'];
    $datenow = $_COOKIE['applicationdate'];

    //TO CALL THE USER INFO FROM DATABASE AND ASSIGN IT TO NEW define_syslog_variable
    $sql = "SELECT `phonenumber`, `fullname`, `age`, `job`, `salary`, `password` FROM `user` WHERE `phonenumber` = '$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {

            $phone = $row["phonenumber"];
            $name = $row["fullname"];
            $currentjob = $row["job"];
            $salary = $row["salary"];

      }
    }


    //insert into pending
    $sql = "INSERT INTO `pending`(`phone`, `name`, `job`, `salary`, `loanAmount`, `bank`, `description`, `date`, `dueDate`, `status`, `payable`, `paidamount`, `applicationdate`, `currentdate`)
    VALUES ('$phone','$name','$currentjob','$salary','$loanAmount','$bank','$description','$date','$dueDate','$status','$payable','$paidamount','$applicationdate','  $datenow ')";
    if ($conn->query($sql) === TRUE)
    {
      $alert = 1;
      //insert into loan histor
      $sql = "Insert Into loanhistory (select * from pending WHERE phone=$phone)";
      $result = $conn->query($sql);
      if ( $result === TRUE)
      {

      }

    }
    else {

      $alert = 2;

    }
}
 ?>

<!--update the user profile-->
 <?php
 if (isset($_POST['update_submit'])) {
   $phone = $_SESSION['phoneNumber'];
   $updatejob = $_POST['CurrentJob'];
   $updatesal = $_POST['optradio'];
   $updatejob = ucwords($updatejob);
   $updatepass = $_POST['updatepwd'];
   $password = password_hash($updatepass, PASSWORD_DEFAULT);

//update
   $sql = "UPDATE `user` SET `job`=' $updatejob', `salary`= '$updatesal', `password`= '$password' WHERE `phonenumber` = '$phone'";
   if ($conn->query($sql) === TRUE)
   {
     $alert = 3;
   }
   // code...
 }
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Tabs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="usertab.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
  <script type="text/javascript"src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
  <link rel="stylesheet" href="../alertcss/warning.css">
  <link rel="stylesheet" href="../alertcss/success.css">
</head>
<body   style="  background-color: #555;"><!--#555-->
<!--header navbar area-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" data-toggle="modal" data-target="#UserModal">USER</a>
      <!-- Modal --> <!--for updating account-->
      <div class="modal fade" id="UserModal" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="userName"><?php echo $userfullname; ?></h4>
            </div>
            <div class="modal-body">
              <h3>Update User Account</h3>
              <br>

              <!--Update account form-->
              <form action="" id="updateactform" method="post">
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
                            <label><input  type="radio" onclick="updateinf()" name="optradio" value="10K+ Monthly" required>10K+ Monthly</label>
                          </div>
                          <div class="radio">
                            <label><input type="radio" name="optradio" onclick="updateinf()" value="20K+ Monthly">20K+ Monthly</label>
                          </div>
                          <div class="radio">
                            <label><input type="radio" name="optradio" onclick="updateinf()" value="50K+ Monthly">50K+ Monthly</label>
                          </div>
                          <div class="radio">
                            <label><input type="radio" name="optradio" onclick="updateinf()" value="100K+ Monthly">100K+ Monthly</label>
                          </div>
                        </div>
                      </ul>
                    </div>
                </div>

                <div class="form-group">
                  <label for="updatepwd">Password:</label>
                  <input type="password" class="form-control" id="updatepwd" placeholder="Enter password" name="updatepwd" required>
                </div>

                <button name="update_submit" type="submit" class="submitButton" form="updateactform">Submit</button>
              </form>

            </div>
            <div class="modal-footer">
              <button type="button" class="closedropdown" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right" >
        <li><a href="#" data-toggle="modal" data-target="#PaymentModal" id="see_payable" onclick="load_payment()">Piable Amount</a></li>
      </ul>

      <!--Payment Modal -->
      <div class="modal fade" id="PaymentModal" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Payment Details</h4>
            </div>
            <div class="modal-body" id="payment_viewer_modal">

            </div>
            <div class="modal-footer">
              <button type="button" class="closedropdown" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    </div>
    </div>
  </div>
</nav>

<!--tittle area-->
<div class="container-fluid" style="background: #f1f1f1;">

<img id="logohome" class="logohome img-responsive center-block" src="../Images/logo/MLMS.png" alt="Logo" style="margin-top: -8%; margin-bottom: -5%; margin-right: 35%; margin-left:35%; height:auto; width: 30%!important;" >

</div>

<!--content view-->
<div class="container-fluid" style="background:white; height:auto; padding-bottom: 50px; padding-top: 50px;">

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


  <!--loan area-->
  <div class="container-fluid col-sm-4" style=" text-align:justify; ">
    <div class="container-fluid" style="margin-top:15px; margin-bottom:15px; text-align:; background-color:white; border: solid 1px lightgray; border-radius:20px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" >
      <br>  <h1 style="text-align: center;  font-weight:bold; color:#0074D9; font-size: 150%;"   >Loan Application Form</h1>

        <p id="loan_form_note">Note: The purpose of this form is to record your information. You can also use this account to check the due date of your loan and the amount you owed. Since your ATM card will be handed to the us your payment will be automatic.</p>
        <br>
        <p id="loan_form_note">It is assumed that you have already given us your ATM card before completing this form. We only offer a 6 percent interest loan per month, so this is a good deal for you. Thank you very much!</p>
        <br>

      <!--Loan Foram-->
      <form action="" id="loanform" method="post" style="width:80%; margin:auto;">
        <div class="form-group">
          <label for="loan_amount">Loan Amount</label>
          <input type="number" name="loan_amount" class="form-control" id="loan_amount" ondrop="return false;" onpaste="return false;" onkeypress='return event.charCode>=48 && event.charCode<=57  || event.charCode == 46'  placeholder="Enter loan amount" required style="width:155px;">
        </div>

        <div class="form-group"  >
          <label for="Bname">Bank:</label>
          <input type="text" class="form-control" id="Bname" placeholder="Enter bank name" name="Bname" required style="width:155px;">
        </div>

        <div class="form-group">
        <label for="comment">Loan Purpose:</label>
        <textarea class="form-control" rows="3" name="comment" id="comment"></textarea>
        </div>

        <button type="submit" name="loan_submit" class="submitButton" form="loanform" onclick="checkCookie()">Submit</button>
      </form>
      <br><br>

    </div>
  </div>

  <!--Loan history-->
  <div class="container-fluid col-sm-8" style="">

        <div class="container-fluid" style="margin-top:15px; margin-bottom:15px; text-align:justify; background-color:white; " >
            <h1 style="font-weight:bold;" >Loan History</h1>

            <br>
            <p style="100%">Note: After we verify the ATM card that you give, we will now then change the status of your loan from pending to approved.
               If we are unable to verify this ATM card, your application will be rejected.The ATM card that you give to us should be active,
               inactive ATM card will be automatically rejected. </p>

  <!--History Table-->
  <div class="hscroll" style="border: 1px solid lightgray; border-radius:10px; padding: 5px;" id="tablearea">


  </div>

  <!-- Modal -->
  <div id="tablemodal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Loan History Detailed View</h4>
        </div>
        <div class="modal-body" id="tablemodalbody" >

        </div>
        <div class="modal-footer">
          <button type="button" class="closedropdown" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

        </div>

  </div>

</div>



<footer class="container-fluid col-sm-12 text-center" style="font-size:12px;">
  <p>System Created By Geykson M. Maravillas</p>
  <p>Designed Using Bootstrap3 Templates</p>
  <p>© 5/2/2022 - <script> document.write(new Date().getDate());</script>/<script> document.write(new Date().getMonth());</script>/<script> document.write(new Date().getFullYear());</script>  </p>
</footer>


<!--javascript-->
<script type="text/javascript">
loadTable();
getusertabcookie();



//
function load_payment()
{

    //////////////
    function setIntervalloadpayment(callback, delay, repetitions) {
        var x = 0;
        var intervalID = window.setInterval(function () {

           callback();

           if (++x === repetitions) {
               window.clearInterval(intervalID);
           }
        }, delay);
    }


    // This will be repeated 5 times with 1 second intervals:
    setIntervalloadpayment(function () {

          $("#payment_viewer_modal").load("payment_viewer.php", {

          });

    }, 0, 10);
    ////////////////

}



//load the loan History table
function loadTable() {
  load_payment();
  $("#tablearea").load("loan-history-table.php", {
  });
}




//avoid resubmission
if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
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


//script to change the dropdown of revieve method text
function change()
{
  var radios = document.getElementsByName('paymentradio');
  for (var i = 0, length = radios.length; i < length; i++) {
    if (radios[i].checked) {
      document.getElementById("loandropdown").innerHTML = "Loan Method: " + radios[i].value + " ";
      document.getElementById("loandropdown").value = radios[i].value
      break;
    }
  }

//to add span in create account button
  var span = document.getElementById("loandropdown");
    var a = document.createElement('a');
  // Set attribute for span element, such as id
        a.setAttribute("class", "caret");
        span.appendChild(a);
}


//script to change the dropdown text of salary
function updateinf()
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


//set cookie for date to pass in php
function setCookie(cname,cvalue,exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkCookie() {

    var date = new Date(); // Now
    setCookie("applicationdate", date.toLocaleString('en-US'), 30);
}
//


</script>


<!--php and java combined-->
<?php
echo '<script> if ( window.history.replaceState ){window.history.replaceState( null, null, window.location.href );}</script>'; //to avoid resubmition

if ($alert==1)
{
  ?><script>
  setTimeout(function()
  {
             $('.alert_success').addClass("show");
             $('.alert_success').removeClass("hide");
             document.getElementById("okay").innerHTML = "You have successfully apply for loan!";
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
}
elseif ($alert==2)
{
  ?><script>
  setTimeout(function()
  {
             $('.alert_warning').addClass("show");
             $('.alert_warning').removeClass("hide");
             document.getElementById("warning").innerHTML = "You still have pending application!";
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
    }, 10);
  </script><?php
}

elseif ($alert==3)
{
  ?><script>
  setTimeout(function()
  {
             $('.alert_success').addClass("show");
             $('.alert_success').removeClass("hide");
             document.getElementById("okay").innerHTML = "Your account is now updated!";
             document.getElementById("okay").style.fontSize = "18px";
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
}
 ?>

</body>
</html>
