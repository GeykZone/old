<?php
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body >

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <div class="wrapper">
    <div class="Header">
       <h1 id="titlebar" style="text-align:center; margin-top: 20%; margin-bottom:10%;">Tara Usapp</h1>
    </div>
    <section class="users" id="delete_action">
      <div class="">
        <a href="update.php" class="update">Update Account</a><br>
        <a href="#" class="delete"  data-toggle="modal" data-target="#deleteModal" >Delete Account</a><br>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="deleteModal" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" style="text-align:center;">Are you sure that you want to delete this account?</h4>
            </div>
            <div class="modal-body container-fluid">

              <div class="container-fluid col-sm-12" style="width:275px;">

                <button onclick="deleteacc(); hideitems();" type="button" class="del" id="del_this" data-dismiss="modal" style="margin: 10px; width:100px;">Yes</button>
                <button type="button" class="del" data-dismiss="modal"  style="margin: 10px; width:100px;">No</button>

              </div>

            </div>
          </div>
        </div>
      </div>

      <header>
        <div class="content">
          <?php
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname'] ?></span> <br>
            <span><?php echo $row['lname'] ?></span>
            <p style="font-size: 12px;"><?php echo $row['status']; ?></p>
          </div>
        </div>
         <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout" onclick="hide()">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list" id="user_list" style="display:block;">
        <p>Loading....</p>
      </div>
      <div class="logout_load"  id="signingout" style="display:none;">
        <p>Signing Out.....</p>
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>
    <script src="javascript/delete_account.js"></script>
  <script type="text/javascript">

  function hide()
  {
    document.getElementById('user_list').style.display = "none";
    document.getElementById('signingout').style.display = "block";
  }

  function hideitems()
  {
    document.getElementById('delete_action').style.display = "none";
    document.getElementById('titlebar').innerHTML = "Deleting...";
    window.location.replace("login.php");

  }

  </script>

</body>
</html>
