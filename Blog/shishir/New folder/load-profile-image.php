<?php   
  $conn = mysqli_connect("localhost", "root", "", "searchbuy");
  $query = "SELECT * FROM users INNER JOIN userdetails ON users.email = userdetails.email AND users.uid='" . $_SESSION['adminSession'] . "'";
  $row = mysqli_query($conn, $query);
  $cust = mysqli_fetch_array($row);
  $sidebarImage = '../Asset/image/admin/'.$cust["photo"];
?>