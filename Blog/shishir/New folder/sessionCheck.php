
<?php
session_start();
if (!isset($_SESSION['adminSession'])) {
  header("location: ./login.php");
}
?>