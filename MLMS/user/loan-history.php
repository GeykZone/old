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
 $modalloanamount = $_POST['newcol1'];
 $modalapplication = $_POST['newcol2'];
 $modalstatus = $_POST['newcol3'];

 $sql = "SELECT `phone`, `name`, `job`, `salary`, `loanAmount`, `bank`, `description`, `date`, `dueDate`, `status`, `payable`, `paidamount`, `applicationdate`,`currentdate`
 FROM `loanhistory` WHERE `phone` = '$phone' && `loanAmount` = '$modalloanamount' && `currentdate` = '$modalapplication ' && `status` = '$modalstatus'";
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
       }

 } else {

 }
  ?>
