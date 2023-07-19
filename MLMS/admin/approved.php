

<h1 style="color:#0074D9; font-weight:Bold;">Approved Loan Applications</h1>
<br>
<div class="hscroll" style="border: 1px solid lightgray; border-radius:10px; padding: 5px;">
  <table class="table" width="100% " id="example">
  <thead class="thead-dark" >
    <tr >
      <th scope="col">Phone</th>
      <th scope="col">Name</th>
      <th scope="col">Loan Amount</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody id="tbody" >
    <?php

    $sql="SELECT * FROM approved";

    if ($result=mysqli_query($conn,$sql))
      {
      // Return the number of rows in result set
           $approved_current = mysqli_num_rows($result);
           //set cookies
           setcookie('approved_current', $approved_current, time() + (86400 * 30), "/"); // 3d days

      }

    $sql = "SELECT `phone`, `name`, `job`, `salary`, `loanAmount`, `bank`, `description`, `date`, `dueDate`, `status`, `payable`, `paidamount`, `applicationdate`
    FROM `approved`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

          ?>
          <tr data-toggle="modal" data-target="#approved_table_modal" class="approvedrow">
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['loanAmount']; ?></td>
            <td><?php echo $row['status']; ?></td>
          </tr>
          <?php
        }
    }
     ?>
  </tbody>
</table>
</div>
<a id="approved_table_refresher_display"></a> <a id="paid_loan_reader"></a>

<!-- Modal -->
<div id="approved_table_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Approved Loan Application</h4>
      </div>
      <div class="modal-body" id="approved_application_modal_body">


      </div>
      <div class="modal-footer">
        <button type="button" class="submitButton" id = "paid_application" data-dismiss="modal" onclick="wew()">Mark as Paid</button>
        <button type="button" class="closedropdown" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">


//so that when I click a row it will get the value and insert into modal
  $(document).ready(function(){
  $(".approvedrow").click(function(){



    var usercurrentRow=$(this).closest("tr");
    var usercol1=usercurrentRow.find("td:eq(0)").text(); // get current row 1st TD value
    var usercol2=usercurrentRow.find("td:eq(1)").text(); // get current row 2nd TD
    var usercol3=usercurrentRow.find("td:eq(2)").text(); // get current row 3rd TD
    //to load the modal from other page


    $("#approved_application_modal_body").load("approved_data_for_modal.php", {

      newusercol1: usercol1,
      newusercol2: usercol2,
      newusercol3: usercol3
    });

  });
  });

</script>
