<?php
include "../connection/connect.php";
 ?>

 <?php

 $modalphonenumber = $_POST['newusercol1'];
 $_SESSION['User_history'] = $modalphonenumber;

 $getphone = "";
 $getname = "";
 $getage = "";
 $getjob = "";
 $getsal = "";

 $sql = "SELECT `phonenumber`, `fullname`, `age`, `job`, `salary`, `password` FROM `user` WHERE `phonenumber`='$modalphonenumber'";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
     // output data of each row
       while($row = $result->fetch_assoc())
       {
        $getphone = $row['phonenumber'];
         $getname = $row['fullname'];
         $getage = $row['age'];
         $getjob = $row['job'];
         $getsal =$row['salary'];

       }

 }
  ?>

  <label for="phonenumber">Phone:</label>
  <p Name = "phonenumber"><?php echo $getphone; ?></p><br>

  <label for="Name">Name:</label>
  <p Name="Name"> <?php echo $getname; ?></p><br>

  <label for="age">Age:</label>
  <p Name = "age"><?php echo $getage; ?></p><br>

  <label for="job">Current Job:</label>
  <p Name="jon"><?php echo $getjob; ?></p><br>

  <label for="sal">Salary:</label>
  <p Name = "sal"><?php echo $getsal;?></p><br>



<style media="screen">
 label
 {
   font-weight: bold;
 }

</style>
