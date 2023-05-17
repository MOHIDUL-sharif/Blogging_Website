<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "sharifblog");
$read = mysqli_query($conn, "SELECt * FROM  blog");
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel-With-Mohidul</title>
    <link rel="stylesheet" type="text/css" href="./css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="card text-center mt-5">
            <div class="card-header">
               <h2>Insert Blog Data</h2> 
                <div class="alert alert-success alert-dismissible fade <?php if (isset($_SESSION['create_message'])) echo"show";  ?>" role="alert">
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
                        <form action="action.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <div class="form-group">
                                        <label for="blogtitle" class="ml-1"><strong>Blog Title</strong></label>
                                        <input type="text" name="title" class="form-control" id="blogtitle" placeholder="Blog Title here ..">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12  text-left">
                                    <div class="form-group">
                                        <label for="blogdes" class="ml-1"><strong>Blog Description</strong></label>
                                        <textarea class="form-control" id="blogdes" rows="5" name="blogdes"></textarea>
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
                                        <input type="submit" value="Create Blog" class="btn btn-primary form-control" />
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="page-content page-container mb-5 mtop-20" id="page-content">
                <div class="padding">
                    <div class="row container d-flex justify-content-center">

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Blog Management</h2>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-success alert-dismissible fade <?php if (isset($_SESSION['flash_message'])) echo"show";  ?>" role="alert">
                                                <strong>
                                                    <?php 
                                                        if (isset($_SESSION['flash_message'])){
                                                            echo $_SESSION['flash_message'];
                                                            unset($_SESSION['flash_message']);
                                                        }  
                                                    ?>
                                                </strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th colspan="2">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (mysqli_num_rows($read) > 0) {
                                                    while ($row = $read->fetch_assoc()) {
                                                        $title = $row["title"];
                                                        $des = $row["description"];
                                                        $image =  $row["image"];
                                                        $id =  $row["id"];
                                                        $img_explode = explode('.', $row["image"]);
                                                        $first = $img_explode[0] ;
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <img src="./image/<?php echo $first;echo "/"; ?><?php echo $image; ?>" alt="" class="tableimage">
                                                            </td>
                                                            <td><?php echo $title; ?></td>
                                                            <td><?php echo $des; ?></td>
                                                            <td>
                                                                <a href="updateBlog.php?id=<?php echo $id;?>&sno=<?php echo $first;?>" class="table-icon" > Edit </a>
                                                            </td>
                                                            <td>
                                                                <form action="delete.php" method="POST">
                                                                    <input type="hidden" name="deleteid" value="<?php echo $id; ?>" />
                                                                    <input type="submit" value="Delete" class="table-icon" />
                                                                </form>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

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