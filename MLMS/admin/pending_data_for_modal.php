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
 $ph = "newusercol1";
 $phone = $_POST[$ph];

 $sql = "SELECT `phone`, `name`, `job`, `salary`, `loanAmount`, `bank`, `description`, `date`, `dueDate`, `status`, `payable`, `paidamount`, `applicationdate`
 FROM `pending` WHERE `phone` = '$phone'";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
     // output data of each row
       while($row = $result->fetch_assoc())
       {
         ?>
         <label for="appdate">Date Applied:</label>
         <p Name = "appdate"><?php echo $row['applicationdate']; ?></p><br>

         <label for="dateproved">Date Approved:</label>
         <p Name = "dateproved"><?php echo $row['date']; ?></p><br>

         <label for="Phone">Phone:</label>
         <p Name="Phone"> <?php echo $row['phone']; ?></p><br>

         <label for="name">Name:</label>
         <p Name = "name"><?php echo $row['name']; ?></p><br>

         <label for="job">Current Job:</label>
         <p Name="jon"><?php echo $row['job']; ?></p><br>

         <label for="sal">Salary:</label>
         <p Name = "sal"><?php echo $row['salary']; ?></p><br>

         <label for="loanAmount">Loan Amount:</label>
         <p Name = "loanAmount"><?php echo $row['loanAmount']; ?></p><br>

         <label for="atm">Bank ATM:</label>
         <p Name = "atm"><?php echo $row['bank']; ?></p><br>

         <label for="purpose">Purpose:</label>
         <p Name = "purpose"><?php echo $row['description']; ?></p><br>

         <label for="due">Due Date:</label>
         <p Name = "due"><?php echo $row['dueDate']; ?></p><br>

         <label for="stats">Status:</label>
         <p Name = "stats"><?php echo $row['status']; ?></p><br>



         <?php

            setcookie('get_phonenumber_to_approve', $phone, time() + (86400 * 30), "/"); // 3d days

       }

 }
 else {

 }
  ?>

  <script type="text/javascript">

  //load the reject loan php
  function reject_this()
  {
    document.getElementById('reject_application').innerHTML = "Reject Loan";
    //to load the modal from other page
    $("#reject_loan_reader").load("reject_Loan.php", {

    });
  }

  //load the approve loan php
  function approve_this()
  {
    document.getElementById('approve_application').innerHTML = "Approve Loan";
    //to load the modal from other page
    $("#approve_loan_reader").load("approve_Loan.php", {

    });
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

  var date = new Date(); // Now
  setCookie("application_approved", date.toLocaleString('en-US'), 30);

  //get the duedate..
  date.setDate(date.getDate() + 30); // Set now + 30 days as the new date
  setCookie("application_approved_due", date.toLocaleString('en-US'), 30);
  //


  </script>
