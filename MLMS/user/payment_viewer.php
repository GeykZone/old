<?php
include "../connection/connect.php";
 ?>
<style media="screen">

 label
 {
   font-weight: bold;
 }

</style>

 <?php
 $phone = $_SESSION['phoneNumber'];

 $sql = "SELECT `phone`, `name`, `job`, `salary`, `loanAmount`, `bank`, `description`, `date`, `dueDate`, `status`, `payable`, `paidamount`, `applicationdate`
 FROM `approved` WHERE `phone` = '$phone'";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
     // output data of each row
       while($row = $result->fetch_assoc())
       {

         $MonthlyInterest = $row['loanAmount'] * 0.06;
         $dailyInterest = $MonthlyInterest / 30;
         $getloanamount = $row['loanAmount'];
         $get_loan_date =  $row['date'];

         ?>

         <p Name = "Monthly" style="color:gray; opacity: 0.6;"><?php echo $_COOKIE['thisdate']; ?></p><br><br>

         <label for="due">Due Date:</label>
         <p Name = "due"><?php echo $row['dueDate']; ?></p><br>

         <label for="loanAmount">Loan Amount:</label>
         <p Name = "loanAmount"><?php echo $row['loanAmount']; ?></p><br>

        <?php

        setcookie('view_loan_amount', $getloanamount, time() + (86400 * 30), "/"); // 3d days
        setcookie('view_daily_interest', $dailyInterest, time() + (86400 * 30), "/"); // 3d days
        setcookie('view_loan_date_here', $get_loan_date, time() + (86400 * 30), "/");


        ?>

        <label for="Monthly">Monthly Interest:</label>
        <p Name = "Monthly"><?php echo $MonthlyInterest; ?></p><br>

        <label for="daily">Daily Interest:</label>
        <p Name = "daily"><?php echo $dailyInterest;?></p><br>

        <label for="duedate">Due Date Payable Amount:</label>
        <p Name = "duedate"><?php echo $getloanamount +  $MonthlyInterest; ?></p><br>
        <div id="getcurrentpayable"></div>

        <label for="currentpay">Current Payable Amount:</label>
        <p Name = "currentpay"><?php echo $_COOKIE['view_payable']; ?></p><br>


        <?php
       }

 }
 else
 {
   ?> <p>No data available!</p> <?php
 }
  ?>

  <script type="text/javascript">

  // Calculate days since Dec 1st 2012
  var estimated = getCookie('view_loan_date_here');
  var dailyrate =  getCookie('view_daily_interest');
  var loanamount = getCookie('view_loan_amount');
  var convertedloanamount = Number(loanamount);
  var dailyrateconverted = Number(dailyrate);
  // To set two dates to two variables
  var date1 = new Date(getCookie('view_loan_date_here'));
  var date2 = new Date();

  // To calculate the time difference of two dates
  var Difference_In_Time = date2.getTime() - date1.getTime();

  // To calculate the no. of days between two dates
  var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
  Difference_In_Days = Math.round(Difference_In_Days);
  var daysSince =(Difference_In_Days * dailyrateconverted)  + convertedloanamount;
  setCookie("view_payable", daysSince, 30);
  setCookie("thisdate", new Date().toLocaleString('en-US'), 30);



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

    var date = new Date(); // Now
  //to format convert date format in yyy/mm/dd or mm/dd/yyy
  function formatDate(date) {
    var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    day = '' + d.getDate(),
    year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
  }
  </script>
