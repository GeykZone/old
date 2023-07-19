<?php
  session_start();
    include_once "php/config.php";
?>
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
      <h3 style="text-align:center;" id="loading">Update Image</h3>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field image">
            <label>Select Image</label>
            <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
          </div>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Update">
        </div>
      </form>
      <div class="link"><a href="update.php">Back</a></div>
    </section>
  </div>

  <script src="javascript/update_image.js"></script>

</body>
</html>
