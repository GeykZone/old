<h1 style="color:#0074D9; font-weight:Bold;">Paid Users</h1>
<br>
<div class="hscroll" style="border: 1px solid lightgray; border-radius:10px; padding: 5px;">
  <table class="table" width="100% " id="example">
  <thead class="thead-dark" >
    <tr >
      <th scope="col">Phone</th>
      <th scope="col">Paid Date</th>
      <th scope="col">Name</th>
      <th scope="col">Loan Amount</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody id="tbody" >
    <?php

    $sql = "SELECT `phone`, `name`, `job`, `salary`, `loanAmount`, `bank`, `description`, `date`, `dueDate`, `status`, `payable`, `paidamount`, `applicationdate`,`currentdate`
    FROM `paid`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

          ?>
          <tr data-toggle="modal" data-target="#paid_table_modal" class="paidrow">
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['currentdate']; ?></td>
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


<!-- Modal -->
<div id="paid_table_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Paid User</h4>
      </div>
      <div class="modal-body" id="paid_application_modal_body">


      </div>
      <div class="modal-footer">
        <button type="button" class="closedropdown" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">

//so that when I click a row it will get the value and insert into modal
  $(document).ready(function(){
  $(".paidrow").click(function(){

    var usercurrentRow=$(this).closest("tr");
    var usercol1=usercurrentRow.find("td:eq(0)").text(); // get current row 1st TD value
    var usercol2=usercurrentRow.find("td:eq(1)").text(); // get current row 2nd TD
    var usercol3=usercurrentRow.find("td:eq(2)").text(); // get current row 3rd TD
    var usercol4=usercurrentRow.find("td:eq(3)").text(); // get current row 2nd TD
    var usercol5=usercurrentRow.find("td:eq(4)").text(); // get current row 3rd TD
    //to load the modal from other page


    $("#paid_application_modal_body").load("paid_data_for_modal.php", {

      newusercol1: usercol1,
      newusercol2: usercol2,
      newusercol3: usercol3,
      newusercol4: usercol4,
      newusercol5: usercol5
    });

  });
  });

</script>
