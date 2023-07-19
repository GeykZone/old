<?php
    session_start();

    // remove cookie


    if(session_destroy()){
      header("location: admin.php");
      if (isset($_COOKIE['admin_cookies']))
      {

        unset($_COOKIE['admin_cookies']);
        setcookie('admin_cookies', null, -1, '/');
        return true;
      }
    else
    {
    return false;
    }
    }
?>
