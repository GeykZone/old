<?php
include "../connection/connect.php";
 ?>
 <table class="table" width="100% " id="example" >
 <thead class="thead-dark" >
   <tr >
     <th scope="col">Loan Amount</th>
     <th scope="col">Date</th>
     <th scope="col">Loan Status</th>
   </tr>
 </thead>
 <tbody id="tbody" >
   <?php

   $phone = $_SESSION['phoneNumber'];
   $sql = "SELECT `phone`, `name`, `job`, `salary`, `loanAmount`, `bank`, `description`, `date`, `dueDate`, `status`, `payable`, `paidamount`, `applicationdate`, `currentdate` FROM `loanhistory`
    WHERE `phone` = '$phone' ORDER BY  `currentdate` DESC";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {

         ?>
         <tr data-toggle="modal" data-target="#tablemodal" class="trow">
           <td><?php echo $row['loanAmount']; ?></td>
           <td><?php echo $row['currentdate']; ?></td>
           <td><?php echo $row['status']; ?></td>
         </tr>
         <?php
       }
   }
    ?>
 </tbody>
</table>
<a href="#" id="callrefresher"></a>


<script type="text/javascript">


  //to add dataTables
  $(document).ready(function() {
      $('#example').DataTable( {
          "pagingType": "simple",
          columnDefs: [ { type: 'date', 'targets': [1] } ],
          order: [[ 1, 'desc' ]]
      } );
  } );


//so that when I click a row it will get the value and insert into modal
  $(document).ready(function(){
  $(".trow").click(function(){
    var currentRow=$(this).closest("tr");
    var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
    var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
    var col3=currentRow.find("td:eq(2)").text(); // get current row 3rd TD
    //to load the modal from other page
    $("#tablemodalbody").load("loan-history.php", {
      newcol1: col1,
      newcol2: col2,
      newcol3: col3
    });
  });
  });

  </script>
