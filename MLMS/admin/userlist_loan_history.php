<?php
include "../connection/connect.php";
 ?>

 <style media="screen">
  /* Force table to not be like tables anymore */
  #this, #thead, #tbody2, #th, #td, #tr {
    display: block;
  }

  /* Hide table headers (but not display: none;, for accessibility) */
  #thead #tr {
    position: absolute;
    top: -9999px;
    left: -9999px;
  }

  #tr { border: 1px solid #ccc; }

  #td {
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee;
    position: relative;
    padding-left: 50%;
  }

  #td:before {
    /* Now like a table header */
    position: absolute;
    /* Top/left values mimic padding */
    top: 6px;
    left: 6px;
    width: 45%;
    padding-right: 10px;
    white-space: nowrap;
  }

  #tbody2 #tr:hover
  {
    background-color: white !important;
    font-size: 14px;
    font-weight: normal;

  }

  /*
  Label the data
  */
  #td:nth-of-type(1):before { content: "History Date:"; }
  #td:nth-of-type(2):before { content: "Date Applied"; }
  #td:nth-of-type(3):before { content: "Date Approved"; }
  #td:nth-of-type(4):before { content: "Phone"; }
  #td:nth-of-type(5):before { content: "Name"; }
  #td:nth-of-type(6):before { content: "Current Job"; }
  #td:nth-of-type(7):before { content: "Salary"; }
  #td:nth-of-type(8):before { content: "Loan Amount"; }
  #td:nth-of-type(9):before { content: "Bank ATM"; }
  #td:nth-of-type(10):before { content: "Purpose"; }
    #td:nth-of-type(11):before { content: "Due Date"; }
      #td:nth-of-type(12):before { content: "Status"; }
 </style>





 <?php
$phone = $_SESSION['User_history'];
$sql = "SELECT `phone`, `name`, `job`, `salary`, `loanAmount`, `bank`, `description`, `date`, `dueDate`, `status`, `payable`, `paidamount`, `applicationdate`, `currentdate` FROM `loanhistory`
 WHERE `phone` = '$phone' ORDER BY `currentdate` DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  ?> <table class="table" width="100% " id="this">
   <thead class="thead-dark" id="thead">
     <tr id="tr">
       <th id="th" >Current date</th>
       <th id="th">Date Applied</th>
       <th id="th">Date Approved</th>
       <th id="th">Phone</th>
       <th id="th">Name</th>
       <th id="th">Current Jbob</th>
       <th id="th">Salary</th>
       <th id="th">Loan Amount</th>
       <th id="th">Bank ATM</th>
       <th id="th">Purpose</th>
       <th id="th">Due Date</th>
       <th id="th">Status</th>
     </tr>
    </thead>
     <tbody id="tbody2" ><?php
    // output data of each row
    while($row = $result->fetch_assoc()) {

      ?>
          <tr id="tr" style="margin-top: 10px;">
            <td id="td" ><?php echo $row['currentdate']; ?></td>
            <td id="td"><?php echo $row['applicationdate']; ?></td>
            <td id="td"><?php echo $row['date']; ?></td>
            <td id="td"><?php echo $row['phone']; ?></td>
            <td id="td"><?php echo $row['name']; ?></td>
            <td id="td"><?php echo $row['job']; ?></td>
            <td id="td"><?php echo $row['salary']; ?></td>
            <td id="td"><?php echo $row['loanAmount']; ?></td>
            <td id="td"><?php echo $row['bank']; ?></td>
            <td id="td"><?php echo $row['description']; ?></td>
            <td id="td"><?php echo $row['dueDate']; ?></td>
            <td id="td"><?php echo $row['status']; ?></td>
          </tr>

      <?php
    }
    ?>
  </tbody>
     </table>
     <?php
}
else {

  ?> <p style="color:gray;">No Loan History Available</p> <?php
}
 ?>


 <script type="text/javascript">

 //to add dataTables
 $(document).ready(function() {
     $('#this').DataTable( {
       "lengthChange": false,
         columnDefs: [ { type: 'date', 'targets': [0] } ],
         order: [[ 0, 'desc' ]],
          paging: false,          //show only the search in data tables
          info: false
     } );
 } );

 </script>
