
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=720, user-scalable=0">
    <title>Serial Number Generator Main Page</title>

    <link rel="stylesheet" href="css/mainstyle.css">


  </head>


  <body>

    <div class="head">
       <h1>Product Serial Number Generator</h1>

    </div>
      <div class="small_form">

        <form class="" name="main_form" onsubmit="return validateForm()" action="page/insert.php" method="post">

          <div class="inside">
            <label class="serial_code_label" for="">Serial Number</label><br>
            <input class="serial_code_input" type="text" name="serial_code_input" id="serial_code_id" readonly>

            <br><br>

            <label class="product_name_label" for="">Product Name</label><br>
            <input class="product_name_input" type="text" name="product_name_input" id="product_name_id" onkeyup="empty()" value="" required >

            <br><br>

            <label class="price_label" for="">Price</label><br>
            <input class="price_input" type="text" name="price_input" id="price_id" value="" required  onkeydown="return ( event.ctrlKey || event.altKey
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9)
                    || (event.keyCode>34 && event.keyCode<40)
                    || (event.keyCode==46) )">

          </div>

          <div class="button_div">


            <button class="save_button" type="submit" name="save_button" id="save_button_id">SAVE</button>

            <button class="generate_button" type="button" name="generate_button" onclick="generateSerial()" id="generate_button" disabled>Generate</button>
            <script src="javascript/mainscript.js"></script>


          </div>

        </form>
      </div>

      <div class="database_div">
        <form class="database_form" action="page/table.php">
          <button class="database_button_class" type="submit" name="database_button" id="database_id">Database</button>

          <img class="watermark" src="image/watermark.png" alt="GeykZone">
          <img class="tools" src="image/tools.png" alt="logo">
        </form>
      </div>

  </body>
</html>
