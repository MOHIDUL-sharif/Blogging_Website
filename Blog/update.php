<?php   
// connection
session_start();
$conn = mysqli_connect("localhost", "root", "", "sharifblog");


if (isset($_FILES["image"])) {
    $img_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $img_explode = explode('.', $img_name);
    $img_ext = end($img_explode);



    $sno = $_POST["sno"];
    $oldPath = "./image/".$sno;
    unlinkImage($oldPath);

    $newimage = $sno.".".$img_ext;
    $path = "./image/".$sno."/".$newimage;
    
    if (move_uploaded_file($tmp_name, $path)) {
        $title = $_POST["title"];
        $des = $_POST["blogdes"];
        $id = $_POST["hbid"];

        $insert = mysqli_query($conn, "UPDATE blog  SET title='$title',description='$des',image='$newimage' WHERE `id`='".$id."' ");
        if ($insert) {
            $_SESSION['create_message'] = "Blog Updated Successfully";
            header("Location: updateBlog.php?id=".$id."&sno=".$sno);
        } else {
            echo "not insertde";
        }
    }
}else{
    $title = $_POST["title"];
    $des = $_POST["blogdes"];
    $id = $_POST["hbid"];

    $insert = mysqli_query($conn, "UPDATE blog  SET title='$title',description='$des', WHERE `id`='".$id."' ");
    if ($insert) {
        $_SESSION['create_message'] = "Blog Updated Successfully";
        header("Location: updateBlog.php?id=".$id."&sno=".$sno);
    } else {
        echo "not insertde";
    }
}



function unlinkImage($storePath)
{
    
    $files = glob($storePath."*");
    foreach($files as $file){ // iterate files
        if(is_file($file)) {
          unlink($file); // delete file
        }
    }

}



?>