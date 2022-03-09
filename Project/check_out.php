<?php
  session_start();

  if(isset($_SESSION['Customer_Id']))
  {
      unset($_SESSION['Customer_Id']);
  }
  session_destroy();
  
  header("location:index.php");
?>