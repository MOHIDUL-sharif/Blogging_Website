<?php   
// connection
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
      <link rel="stylesheet" type="text/css" href="./css/blog.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <meta name="viewpoint" content="width-device-width,initial-scale=1.0">
      <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
   </head>
   <body>
      <section class="features">
         <h1>Mohidul's Blog</h1>
         <div class="container">
            <div class="row">
                <?php   
                  if(mysqli_num_rows($read) > 0){
                    while ($row = $read->fetch_assoc()) {
                        $title = $row["title"];
                        $des = $row["description"];
                        $image =  $row["image"];
                        $img_explode = explode('.', $row["image"]);
                        $first = $img_explode[0] ;
                ?>
               <div class="col-md-4">
                  <div class="feature-box">
                     <div class="feature-img">
                        <img src="./image/<?php echo $first; echo "/"; ?><?php echo $image; ?>">
                        <div class="price">
                        </div>
                     </div>
                     <div class="feature-details">
                        <h4><?php echo $title; ?></h4>
                        <p><?php echo $des; ?></p>
                     </div>
                  </div>
               </div>

               <?php
                    }
                }
               ?>
            </div>
         </div>
      </section>
      <footer>
         <p>© Mohidul Alam 2023, all right reserved.</p>
      </footer>
   </body>
</html>