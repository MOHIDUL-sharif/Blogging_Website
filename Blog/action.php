<?php   
// connection
session_start();
$conn = mysqli_connect("localhost", "root", "", "sharifblog");
if (isset($_FILES["image"])) {


    $randomnumber = rand(10000, 50000);
    $img_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $img_type = $_FILES['image']['type'];
    $img_explode = explode('.', $img_name);
    $img_ext = end($img_explode);
     
    $dirname = "./image/".$randomnumber."/";
    $path = $dirname . $randomnumber.".".$img_ext;
    mkdir($dirname, 0777, true);

    $newname = $randomnumber.".".$img_ext;

    if (move_uploaded_file($tmp_name, $path)) {
        $title = $_POST["title"];
        $des = $_POST["blogdes"];

        $insert = mysqli_query($conn, "INSERT INTO blog  (title,description,image) VALUES ('".$title."','".$des."','".$newname."')");
        if ($insert) {
            $_SESSION['create_message'] = "Blog Created Successfully";
            header("Location: admin.php");
        } else {
            echo "not insertde";
        }
    }
}



?>