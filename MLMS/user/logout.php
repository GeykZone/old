<?php
    session_start();

    // remove cookie


    if(session_destroy()){
      header("location: user.php");
      if (isset($_COOKIE['user_cookies']))
      {

        unset($_COOKIE['user_cookies']);
        setcookie('user_cookies', null, -1, '/');
        return true;
      }
    else
    {
    return false;
    }
    }
?>
