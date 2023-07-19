<?php
session_start();
 ?>

<?php  $_SESSION['current_payable']  = $_COOKIE['current_payable']; ?>
<label for="currentpay">Current Payable Amount:</label>
<p Name = "currentpay"><?php echo $_SESSION['current_payable']; ?></p><br>
