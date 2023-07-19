<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=1150, user-scalable=0">
    <title>Database Table</title>
      <link rel="stylesheet" href="../css/table_style.css">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script>
      $(document).ready(function(){
        $("#search_id").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#table_body tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
      </script>

  </head>


  <body>

    <div class="holder">

      <div class="Home">

        <form class="" action="../index.php" method="post">

          <button class="home_button" type="submit" name="button">Home</button>

        </form>

      </div>



      <table class="my_table">

          <thead>

            <th>Serial Number</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Operation</th>
          </thead>


          <tbody id="table_body">
            <?php
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
                $sql = "SELECT `serial_code`, `product`, `price` FROM `items`";
                $result = $conn-> query($sql);

                if ($result-> num_rows > 0)
                {
                  while ($row = $result-> fetch_assoc())
                  {
                    ?>
                    <tr>
                      <td><?php echo $row['serial_code']; ?></td>
                      <td><?php echo $row['product']; ?></td>
                      <td><?php echo $row['price']; ?></td>
                      <td><form class="" action="delete.php" method="post"> <button class="delete_button_class" type="anchor" name="del_button" value = "<?php echo $row['serial_code']; ?>">Delete</button> </form></td>
                    </tr>
                    <?php

                  }

                }
                else
                {
                  echo "0 Result";
                }
            }
            $conn->close();
            ?>
          </tbody>
      </table>

      <div class="">

        <input id="search_id" class="search" type="text" name="" value="" placeholder="Search Here:">

      </div>

    </div>

  </body>
</html>
