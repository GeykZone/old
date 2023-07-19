<?php
  $serialcode = $_POST['serial_code_input'];
  $product = $_POST['product_name_input'];
  $price = $_POST['price_input']; //get input text

  $upperproduct = ucwords($product);
  $upperprice = ucwords($price);


  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "serial_generator";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  }
  else
  {
    $sql = "INSERT INTO `items`(`serial_code`, `product`, `price`)  VALUES ('$serialcode', '$upperproduct', '$upperprice')";

    if ($conn->query($sql) === TRUE)
    {
      header("Location: insert_success.php");
    }
    else
    {
      header("Location: failed.php");
    }

  }

  $conn->close();

 ?>
