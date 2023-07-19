<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "serial_generator";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
{
  die("Connection failed: " . $conn->connect_error);
  echo "error";
}
else
{
  $id = $_POST['del_button'];

  $sql = "DELETE FROM `items` WHERE `items`.`serial_code` = '$id';";

  if ($conn->query($sql) === TRUE)
  {
    header("location: table.php");
    exit;
    echo "error";
  }
  else
  {
    echo "error";
  }

}
$conn->close();

 ?>
