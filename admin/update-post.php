<?php
  include 'admin-header.php';



?>
 <div id="admin-content">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <h1>Update Post</h1>
       </div>

       <div class="col-md-6 col-md-offset-3">

              <?php

                    include 'config.php';
                    $post_id=$_GET['id'];
                    $sql="SELECT post.post_id,post.titile,post.description,post.post_img,
                          category.category_name,post.category FROM post
                          LEFT JOIN category ON  post.category=category.category_id
                          LEFT JOIN user ON post.post_author=user.username
                          where post.post_id={$post_id}";

                  $result = mysqli_query($conn, $sql) or die("Query Failed.");
                  if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)) {     

              ?>

          <form action="save-update-post.php" method="POST" enctype="multipart/form-data">
             <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
            </div>
             <div class="form-group">
               <label>Titile</label>
               <input type="text" name="title" class="form-control"  value="<?php echo $row['titile']; ?>" required>
             </div>
             <div class="form-group">
               <label>Description</label>
               <textarea class="form-control" name="postdesc" rows="5"><?php echo $row['description'] ;?> </textarea> 
             </div>
             <div class="form-group">
               <label>Category</label>
               <select class="form-control" name="category">
                 <option disabled >select category</option>
                  <?php
                      include 'config.php';
                      $sql1="SELECT * FROM category";
                      $result1=mysqli_query($conn,$sql1) or die("Qury failed");
                      if (mysqli_num_rows($result1)>0) {
                        while ($row1=mysqli_fetch_assoc($result1)) {
                          if ($row['category']==$row1['category_id']) {
                             $select="selected";
                          }else{
                            $select="";
                          }

                           echo "<option {$select} value={$row1['category_id']}>{$row1['category_name']}</option>";
                        }
                      }

                  ?> 
               </select>
               <input type="hidden" name="old_category" value="<?php echo $row['category']; ?>">
               </div>


               <div class="form-group">
               <label>Post Image</label>
               <input type="file" name="new-image" >

               <img src="upload/<?php echo $row['post_img'];?>" name="" height="150px;">
               <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?>">

             </div>

              <input type="submit" name="submit" value="Update" class="btn btn-primary">
              
             
          </form>

          <?php
            }
          }
         ?>
       </div>



     </div>
   </div>
 </div>

<?php
  include 'admin-footer.php';
?>