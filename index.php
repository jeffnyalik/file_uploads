<?php
 include ("./lib/config.php");
 include ("./lib/Database.php");
 include("./inc/header.php");
 $db = new Database;
 ?>

 <div class="container">
   <div class="row">
    <br> <hr>
     <form class="" action="" enctype="multipart/form-data" method="post">
       <?php
         if($_SERVER['REQUEST_METHOD'] == 'POST')
         {
           $allowed = array("jpg", "jpeg", "png", "gif", "pdf");
           $file_name  = $_FILES['image']['name'];
           $file_size = $_FILES['image']['size'];
           $file_tmp = $_FILES['image']['tmp_name'];
           $location = "uploads/";
           $img = explode('.', $file_name);
           $file_extension = strtolower(end($img));

          // check for errors
          if(empty($file_name))
          {
            echo '<div class="alert alert-danger"> please choose a file'.'</div>';

          }else if($file_size < 2000){
            echo '<div class="alert alert-danger"> image size should  be less than 2 kb'.'</div>';
          }else if($allowed != true){
            echo '<div class="alert alert-danger"> Type of file is not recognized'.'</div>';
          }else{
           move_uploaded_file($file_tmp, $location.$file_name);
           $query = "INSERT INTO tbl_image(image) VALUES('$file_name')";
           $inserted = $db->insert($query);
           if($inserted)
           {
             echo '<div class="alert alert-success"> uploaded successfully'.'</div>';
           }else{
               echo '<div class="alert alert-danger"> failed to upload'.'</div>';
           }
         }
       }
       ?>
           <div class="form-group">
             <input type="file" class="btn btn-primary" name="image" class="form-control">
           </div>
           <div class="form-group">
             <input type="submit" class="btn btn-success" name="submit" value="upload">
           </div>
     </form>
   </div>
   <?php
    $query = "SELECT * FROM tbl_image order by id desc limit 2";
    $select_img = $db->select($query);
    if($select_img)
    {
      while($row = $select_img->fetch_assoc())
      {

    ?>
    <img src="uploads/<?php echo $row['image']; ?>" height="250px" width="200px;" alt="">
    <?php } } else {  echo '<div class="alert alert-danger"> can not display an image'.'</div>'; } ?>
 </div>

 <hr>
