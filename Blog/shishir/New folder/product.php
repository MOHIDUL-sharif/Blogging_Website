<?php
session_start();
include_once("../../DB/connection.php");


$action = $_POST['actions'];
$pname = $_POST['productName'];
$pprice = $_POST['productPrice'];
$pcategory = $_POST['productCategory'];
$pscharge = $_POST['shipingCharge'];
$pquantity = $_POST['productQuantity'];
$pdiscount = $_POST['productDiscount'];
$pdetails = $_POST['productDetails'];
$sirial = $_POST['sno'];

if ($action == "edit") {
    $sno = $_POST['sno'];
    $query = "SELECT * FROM `product` WHERE id ='" . $sno . "'";
    $query_run = mysqli_query($conn, $query);
  
    $cust = mysqli_fetch_assoc($query_run);
    if (mysqli_num_rows($query_run) > 0) {
      echo json_encode($cust);
    }
}

if ($pname != "" && $pprice != "" && $pcategory != "Select Category" && $pdetails != "" && $pquantity != "" && $pdiscount != "" && $pscharge != "Select Shipping Charge") {

    $productsRecive = array();

    if ($action == "insert") {

        $sno = sernum();
        $productsRecive = returnImageArray($sno);
        $image = json_encode($productsRecive);

        if (count($productsRecive) > 0) {

            $sql = "INSERT INTO product(sno,name, price, category, details, quantity, discount, scharge,image) VALUES ('" . $sno . "','" . $pname . "','" . $pprice . "','" . $pcategory . "','" . $pdetails . "','" . $pquantity . "','" . $pdiscount . "','" . $pscharge . "','" . $image . "')";


            $run = mysqli_query($conn, $sql);
            if ($run) {
                echo "success";
            } else {
                echo "not insertde";
            }
        } else {
            echo "empty filed warning";
        }
    }else{

        $productsRecives = array();
        if ($action=="updateWithFile") {
            $productsRecives = returnImageArray($sirial);
            $image = json_encode($productsRecives);

            $sql = mysqli_query($conn, "UPDATE `product`SET `name`='" . $pname . "',`price`='" . $pprice . "',`category`='" . $pcategory . "', `details`='" . $pdetails . "',`quantity`='" . $pquantity . "',`discount`='" . $pdiscount . "',`scharge`='" . $pscharge . "',`image`='$image' WHERE  `sno`='" . $sirial . "'");

            if ($sql) {
                echo "success UploadImageUpdatedData";
            }
        }else {
            $sql = mysqli_query($conn, "UPDATE `product`SET `name`='" . $pname . "',`price`='" . $pprice . "',`category`='" . $pcategory . "', `details`='" . $pdetails . "',`quantity`='" . $pquantity . "',`discount`='" . $pdiscount . "',`scharge`='" . $pscharge . "' WHERE  `sno`='" . $sirial . "'");

            if ($sql) {
                echo "success without file check";
            }
        }

    }
} else {
    echo "failed";
}







function returnImageArray($datas)
{
    $products = array();
    $storePath = "../../Asset/image/product/".$datas."/";
    unlinkImage($storePath);
    foreach ($_FILES['images']['name'] as $key => $value) {
        $file_name = explode(".", $_FILES['images']['name'][$key]);
        $img_ext = strtolower(end($file_name));
        $allowed_ext = array("jpg", "jpeg", "png");
        if (in_array($img_ext, $allowed_ext)) {
            $new_name = $datas . $key . '.' . $img_ext;
            $sourcePath = $_FILES['images']['tmp_name'][$key];
            $imageLocation = $storePath . $new_name;
            
            if (move_uploaded_file($sourcePath, $imageLocation)) {
                array_push($products, $new_name);
            }
            
        }
    }
    return $products;
}

function unlinkImage($storePath)
{
    
    if (!is_dir($storePath)) {
        mkdir($storePath, 0777, true);
    }else{
        $files = glob($storePath."*");
        foreach($files as $file){ // iterate files
            if(is_file($file)) {
              unlink($file); // delete file
            }
        }
        rmdir($storePath);
        mkdir($storePath, 0777, true);
    }

}



function sernum()
{
    $template   = 'XX99-XX99-99XX';
    $k = strlen($template);
    $sernum = '';
    for ($i = 0; $i < $k; $i++) {
        switch ($template[$i]) {
            case 'X':
                $sernum .= chr(rand(65, 90));
                break;
            case '9':
                $sernum .= rand(0, 9);
                break;
            case '-':
                $sernum .= '-';
                break;
        }
    }
    return $sernum;
}
