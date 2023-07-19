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
 $phone = $_POST['newusercol1'];
 $paidate= $_POST['newusercol2'];
 $paidname= $_POST['newusercol3'];
 $paidloanam= $_POST['newusercol4'];
 $paidstats= $_POST['newusercol5'];

 $sql = "SELECT `phone`, `name`, `job`, `salary`, `loanAmount`, `bank`, `description`, `date`, `dueDate`, `status`, `payable`, `paidamount`, `applicationdate` ,`currentdate`
 FROM `paid` WHERE `phone` = '$phone' && `currentdate`= '$paidate' &&  `name`= '$paidname' && `loanAmount`= ' $paidloanam' && `status`= '$paidstats'";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
     // output data of each row
       while($row = $result->fetch_assoc())
       {

         ?>

         <label for="applied">Date Applied:</label>
         <p Name = "applied"><?php echo $row['applicationdate']; ?></p><br>

         <label for="dateproved">Date Approved:</label>
         <p Name = "dateproved"><?php echo $row['date']; ?></p><br>

         <label for="due">Paid Date:</label>
         <p Name = "due"><?php echo $row['currentdate']; ?></p><br>

         <label for="Phone">Phone:</label>
         <p Name="Phone"> <?php echo $row['phone']; ?></p><br>

         <label for="name">Name:</label>
         <p Name = "name"><?php echo $row['name']; ?></p><br>

         <label for="loanAmount">Loan Amount:</label>
         <p Name = "loanAmount"><?php echo $row['loanAmount']; ?></p><br>

         <label for="atm">Bank ATM:</label>
         <p Name = "atm"><?php echo $row['bank']; ?></p><br>

         <label for="purpose">Purpose:</label>
         <p Name = "purpose"><?php echo $row['description']; ?></p><br>

         <label for="sts">Status:</label>
         <p Name = "sts"><?php echo $row['status']; ?></p><br>

        <?php
       }

 }
 else {

 }
  ?>
