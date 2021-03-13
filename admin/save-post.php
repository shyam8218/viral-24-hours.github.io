<?php
  include 'config.php';

    if (isset($_FILES['fileToUpload'])) {
      $error=array();    

      $file_name=$_FILES['fileToUpload']['name'];
      $file_size=$_FILES['fileToUpload']['size'];
      $file_temp=$_FILES['fileToUpload']['tmp_name'];
      $file_type=$_FILES['fileToUpload']['type'];
      $file_ext=end(explode('.', $file_name));
      $extensions=array("jpeg","png","jpg");

      if (in_array($file_ext, $extensions)==false) {
        $error[]="This extension file not allowed to upload,please upload the file in jpeg or png type";
      }

        if ($file_size>2097152) {
          $error[]="the file must be less than 2mb";
        }

        $new_name=time()."_".basename($file_name);
        $target="upload/".$new_name;

       if (empty($error)==true) {
           move_uploaded_file($file_temp, $target);
       }else{
        print_r($error);
        die();
       }


    }

  session_start();
  $title=mysqli_real_escape_string($conn,$_POST['title']);
  $description=mysqli_real_escape_string($conn,$_POST['postdesc']);
  $category=mysqli_real_escape_string($conn,$_POST['category']);
  $date=date("d M,Y");
  $author=$_SESSION['user_id'];

  $sql="INSERT INTO post(titile,description,category,post_date,post_author,post_img)
         VALUES('{$title}','{$description}','{$category}','{$date}','{$author}','{$new_name}');";
  
  $sql .="UPDATE category SET post=post+1  WHERE category_id={$category}";
 
  if (mysqli_multi_query($conn,$sql)) {
    header("location:post.php");
  }
  else{
    echo '<div class="alert">Query Failed</div>';
  }
?>





