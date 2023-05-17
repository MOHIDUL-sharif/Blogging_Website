<?php   
session_start();

// connection
$conn = mysqli_connect("localhost", "root", "", "sharifblog");


$blogid = $_POST["deleteid"];

$insert = mysqli_query($conn, "DELETE FROM blog where id=".$blogid."");

if ($insert) {
    $_SESSION['flash_message'] = "Blog Deleted Successfully";
    header("Location: admin.php");
} else {
    echo "not insertde";
}



?>