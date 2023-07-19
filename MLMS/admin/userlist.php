
<h1 style="color:#0074D9; font-weight:Bold;">User List</h1>
<br>
<div class="hscroll" style="border: 1px solid lightgray; border-radius:10px; padding: 5px;">
  <table class="table" width="100% " id="example">
  <thead class="thead-dark" >
    <tr >
      <th scope="col">Phone</th>
      <th scope="col">Name</th>
      <th scope="col">Current Job</th>
    </tr>
  </thead>
  <tbody id="tbody" >
    <?php

    $sql="SELECT * FROM user";

    // Return the number of rows in result set
    if ($result=mysqli_query($conn,$sql))
      {

           $olddrowcount = mysqli_num_rows($result);
           setcookie('olddrowcount',  $olddrowcount, time() + (86400 * 30), "/"); // 3d days

      }

    $sql = "SELECT `phonenumber`, `fullname`, `age`, `job`, `salary`, `password` FROM `user` ORDER BY phonenumber";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

          ?>
          <tr data-toggle="modal" data-target="#tablemodal" class="usertrow">
            <td><?php echo $row['phonenumber']; ?></td>
            <td><?php echo $row['fullname']; ?></td>
            <td><?php echo $row['job']; ?></td>
          </tr>
          <?php
        }
    }
     ?>
  </tbody>
</table>



</div>
<a id="admin_userlist_refresher_display"></a>



<!-- Modal -->
<div id="tablemodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User List</h4>
        <p id="detailed_viewer_userlist" style="cursor: pointer; color: black !important;" onclick="detailed_viewer_userlist(); load_userlist_loanHistory();">(Click To See History)</p>
      </div>
      <div class="modal-body" id="userstablemodalbody">

      </div>
      <div class="modal-body" id="Detailed_view_userlist" style="display:none;">

      </div>
      <div class="modal-footer">
        <a id="deleteuser"></a>
        <button type="button" class="closedropdown" data-dismiss="modal" onclick="del_user()">Delete User</button>
        <button type="button" class="closedropdown" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">

function del_user()
{
  $("#deleteuser").load("delete_user.php", {
  });
}

function load_userlist_loanHistory()// to load deatiled view for user list
{
  $("#Detailed_view_userlist").load("userlist_loan_history.php", {
  });
}

//to change text when clicked
function detailed_viewer_userlist() {
  if ( document.getElementById('detailed_viewer_userlist').innerHTML == "(Click To See History)") {

      document.getElementById('detailed_viewer_userlist').innerHTML="(Click To See Personal Info)";

      document.getElementById('userstablemodalbody').style.display="none";
      document.getElementById('Detailed_view_userlist').style.display="block";

  }
  else {
        document.getElementById('detailed_viewer_userlist').innerHTML="(Click To See History)";

        document.getElementById('userstablemodalbody').style.display="block";
        document.getElementById('Detailed_view_userlist').style.display="none";
  }

}


//so that when I click a row it will get the value and insert into modal
  $(document).ready(function(){
  $(".usertrow").click(function(){

      document.getElementById('detailed_viewer_userlist').innerHTML="(Click To See History)";
      document.getElementById('userstablemodalbody').style.display="block";
      document.getElementById('Detailed_view_userlist').style.display="none";

    var usercurrentRow=$(this).closest("tr");
    var usercol1=usercurrentRow.find("td:eq(0)").text(); // get current row 1st TD value
    var usercol2=usercurrentRow.find("td:eq(1)").text(); // get current row 2nd TD
    var usercol3=usercurrentRow.find("td:eq(2)").text(); // get current row 3rd TD
    //to load the modal from other page
    $("#userstablemodalbody").load("user_table_modal.php", {
      newusercol1: usercol1,
      newusercol2: usercol2,
      newusercol3: usercol3
    });
  });
  });

</script>
<?php

 ?>
