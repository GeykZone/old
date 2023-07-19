<?php   session_start();
  include_once "php/config.php"; ?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <?php
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
        if(mysqli_num_rows($sql) > 0){
          $row = mysqli_fetch_assoc($sql);
        }
      ?>
      <header><span><?php echo $row['fname']. " " . $row['lname'] ?></span></header> <br>
      <h3 style="text-align:center;">Update Profile</h3>
      <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">

        <div class="field button">
        <a class="trigger" href="update_name.php"  onclick="">Update First Name</a>
        </div>

        <div class="field button">
          <a class="trigger" href="update_lastname.php"  onclick="">Update Last Name</a>
        </div>

        <div class="field button">
        <a class="trigger" href="update_email.php"  onclick="">Update Email</a>
        </div>

        <div class="field button">
          <a class="trigger" href="update_password.php"  onclick="">Update Password</a>
        </div>

        <div class="field button">
          <a class="trigger" href="update_image.php"  onclick="">Update Image</a>
        </div> <br>
      <div class="link"><a href="users.php">Cancel</a></div>
      </form>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>
  <script type="text/javascript">

  function firstname() {

    alert("First Name");

  }

  </script>

</body>
</html>
