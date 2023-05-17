<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "sharifblog");
// if(isset($_GET["name"])){
//    $id = $_GET["name"];
//    echo $id;
// }
$ids = $_GET['id'];
$sno = $_GET['sno'];
$read = mysqli_query($conn, "SELECt * FROM  blog WHERE id='".$ids."'");
$cust = mysqli_fetch_array($read); 

// print_r($cust);




?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" type="text/css" href="./css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body style="background-image:url(./image/<?php echo $sno; echo "/"; echo $cust["image"];  ?>); background-size:cover; background-repeat:no-repeat;background-position:center;">
    <div class="container" >
        <div class="card text-center mt-5" style="background:rgba(255,255,255, 0.5);">
            <div class="card-header">
               <h2>Update <?php  echo $cust["title"]; ?></h2> 
                <div class=" alert-dismissible fade <?php if (isset($_SESSION['create_message'])) echo"alert alert-success show";  ?>" role="alert">
                    <strong>
                        <?php 
                            if (isset($_SESSION['create_message'])){
                                echo $_SESSION['create_message'];
                                unset($_SESSION['create_message']);
                            }  
                        ?>
                    </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="update.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $cust["id"];  ?>" name="hbid">
                            <input type="hidden" value="<?php echo $sno;  ?>" name="sno">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <div class="form-group">
                                        <label for="blogtitle" class="ml-1"><strong>Blog Title</strong></label>
                                        <input type="text" value="<?php echo $cust["title"];  ?>" name="title" class="form-control" id="blogtitle" placeholder="<?php echo $cust["title"];  ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12  text-left">
                                    <div class="form-group">
                                        <label for="blogdes" class="ml-1"><strong>Blog Description</strong></label>
                                        <textarea class="form-control" id="blogdes" rows="5" name="blogdes"><?php echo $cust["description"];  ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label ml-1"><strong>Blog Image</strong></label>
                                        <input class="form-control" name="image" type="file" id="formFile">
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <div class="form-group">
                                        <input type="submit" value="Update Blog" class="btn btn-primary form-control" />
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>