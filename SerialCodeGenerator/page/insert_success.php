<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Insert Success!</title>

    <style >

      body
      {
        margin: auto;
        font-family: arial;
        background-color: rgba(0, 0, 0, 0.4);
        background: url(../image/mainbackground.jpg) no-repeat center fixed;
        background-position: absolute;
        background-size: cover;
      }

      .logo
      {
        width:20%;
        display:block;
        margin-left: auto;
        margin-right: auto;
        animation-name: logo_move;
        animation-duration: 2s;
        animation-delay: 0s;
      }

      @keyframes logo_move {

        0%   {width: 20%;}
        50%  {width: 30%;}
        110%  {width: 20%;}

      }



      .note
      {
        text-align: center;
        font-size: 30px;
      }

      button
      {
        display:block;
        margin-left: auto;
        margin-right: auto;

        position:relative;
        background-color: rgba(0, 206, 255, 1);
        color:  rgba(51, 132, 222, 1 );
        top: 50px;
        text-align: center;
        border-radius: 12px;
        border: 5px solid rgba(0, 109, 217, 1);
        padding: 10px 86px;
        outline: none;
        cursor: pointer;
        font-weight:Bold;
        transition: 0.51s;
        font-size: 20px;
      }

      button:hover{
        background-color: rgba(51, 132, 222, 1 );
        color: rgba(0, 206, 255, 1);
        border: 5px solid rgba(0, 206, 255, 1);
        font-size: 15px;
      }

      form
      {
        position:relative;
        top: 150px;
        background-color: rgb(240, 240, 240,0.8 );
        padding:120px 50px;
        width: 900px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 20px;
      }

    </style>
  </head>

  <body>
    <form class="" action="../index.php">
      <img class="logo" src="../image/check.png" alt="Upload Success">
      <div class="note"><h1>Successfully Saved in Database!</h1></div>
      <button type="submit" name="button">HOME</button>
    </form>
  </body>
</html>
