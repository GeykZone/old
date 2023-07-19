<?php
include 'connect.php';
$a=10;
 ?>

 <!----------------------------------------------------------->
 <?php
 // Include the database configuration file
 if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){

   // File upload path
   $targetDir = "images/";
   $fileName = basename($_FILES["file"]["name"]);
   $targetFilePath = $targetDir . $fileName;
   $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
     // Allow certain file formats
     $allowTypes = array('jpg','png','jpeg','gif','PNG','JPG','GIF','JPEG');
     if(in_array($fileType, $allowTypes)){
         // Upload file to server
         if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
             // Insert image file name into database
             $insert = $conn->query("INSERT INTO `users`(`img`) VALUES ('$fileName')");
             if($insert){
                  $a=1;
                    $_SESSION['ID'] = $fileName = basename($_FILES["file"]["name"]);
             }else{
                 $a=2;
             }
         }else{
              $a=3;
         }
     }else{
         $a=4;
     }
 }
 ?>
 <!----------------------------------->




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>By Geyk Maravillas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style media="screen" type="text/css">
    .container
    {
      display: flex;
      justify-content: center;
    }
    .chs_fl
    {
      color: white;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        background: black;
    }

    .glow-on-hover {
        width: 220px;
        height: 50px;
        border: none;
        outline: none;
        color: #fff;
        background: #111;
        cursor: pointer;
        position: relative;
        z-index: 0;
        border-radius: 10px;
    }

    .glow-on-hover:before {
        content: '';
        background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
        position: absolute;
        top: -2px;
        left:-2px;
        background-size: 400%;
        z-index: -1;
        filter: blur(5px);
        width: calc(100% + 4px);
        height: calc(100% + 4px);
        animation: glowing 20s linear infinite;
        opacity: 0;
        transition: opacity .3s ease-in-out;
        border-radius: 10px;
    }

    .glow-on-hover:active {
        color: #000
    }

    .glow-on-hover:active:after {
        background: transparent;
    }

    .glow-on-hover:hover:before {
        opacity: 1;
    }

    .glow-on-hover:after {
        z-index: -1;
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: #111;
        left: 0;
        top: 0;
        border-radius: 10px;
    }

    @keyframes glowing {
        0% { background-position: 0 0; }
        50% { background-position: 400% 0; }
        100% { background-position: 0 0; }
    }


    </style>
  </head>
  <body>
    <div class="container">
      <form class="" action="" method="post" enctype="multipart/form-data">
        <input class="chs_fl" type="file" name="file" id="imgInp">
        <button class="glow-on-hover" type="submit" name="submit" id="Save">Convert Image</button>
      </form>
    </div>

    <script type="text/javascript">
    imgInp.onchange = evt =>
    {
      const [file] = imgInp.files
      if (file) {
        profile_pic.src = URL.createObjectURL(file)
        document.getElementById("Save").style.display="inline";
      }
    }
    </script>

    <?php
    echo '<script> if ( window.history.replaceState ){window.history.replaceState( null, null, window.location.href );}</script>';
    if ($a==1)
    {
      ?><script>
      setTimeout(function()
      {alert('<?php echo "The file ".$fileName. " has been uploaded successfully."; ?>');}, 50);
      window.location.href = "portrait.php";
      </script><?php
      $a=5;
    }

    if ($a==2)
    {
      ?><script>
      setTimeout(function()
      {alert('<?php echo "File upload failed, please try again."; ?>');}, 50);
      </script><?php

    }

    if ($a==3)
    {
      ?><script>
      setTimeout(function()
      {alert('<?php echo "Sorry, there was an error uploading your file."; ?>');}, 50);
      </script><?php
      $a=5;
    }

    if ($a==4)
    {
      ?><script>
      setTimeout(function()
      {alert('<?php echo 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.'; ?>');}, 50);
      </script><?php
      $a=5;
    }


     ?>


  </body>
</html>
