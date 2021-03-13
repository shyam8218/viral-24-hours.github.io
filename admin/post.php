<?php
 include 'admin-header.php';


?>

<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1>All Posts</h1>
      </div>
      <div class="col-md-2">
        <a href="add-post.php" class="add-new">ADD POST</a>
      </div>

       <div class="col-md-12">

            <?php
             include 'config.php';
              $limit=3;
               //calculating the offsett class
              if (isset($_GET['page'])) {
                 $page=$_GET['page'];
              }else{
                $page=1;
              }
              $offset=($page-1)*$limit;
                               
                 if($_SESSION["user_role"] == '1'){
                    /* select query of post table for admin user */

             $sql="SELECT  post.post_id,post.description,post.titile,
             post.post_date,category.category_name,user.username,  post.category FROM post
             LEFT JOIN category ON post.category = category.category_id
             LEFT JOIN user ON post.post_author = user.user_id
    
             ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

             }elseif($_SESSION["user_role"] == '0'){
                    /* select query of post table for normal user */
      
                   $sql="SELECT  post.post_id,post.description,post.titile,
                   post.post_date,category.category_name,user.username,  post.category FROM post
                   LEFT JOIN category ON post.category = category.category_id
                   LEFT JOIN user ON post.post_author = user.user_id
                   WHERE post.post_author = {$_SESSION['user_id']}
                   ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";              
                   $result=mysqli_query($conn,$sql);
          

               }




              $result=mysqli_query($conn,$sql);
               if (mysqli_num_rows($result)>0) {


               
            ?>

         <table class="table table-bordered table-stripped table-hover table-content">
           <thead>
             <th>S.NO.</th>
             <th>TITILE</th>
             <th>CATEGOTY</th>
             <th>DATE</th>
             <th>AUTHOR</th>
             <th>EDIT</th>
             <th>DELETE</th>

           </thead>
           <tbody>
               <?php 
                 $serial=$offset+1;
                while ($row=mysqli_fetch_assoc($result)) {   ?>
              <tr>
                <td class="id"><?php echo $serial;  ?></td>
                <td><?php echo $row['titile'];  ?></td>
                <td><?php echo $row['category_name'];  ?></td>
                <td><?php echo $row['post_date'];  ?></td>
                <td><?php echo $row['username'];  ?></td>
                <td class="edit"><a href='update-post.php?id= <?php echo $row['post_id']; ?>'><li class="fa fa-edit"></li></a></td>
                <td class="delete"><a href='delete-post.php?id=<?php echo $row['post_id'];?>&catid=<?php echo $row['category'] ?>'><li class="fa fa-trash"></li></a></td>
              </tr>
            <?php
             $serial++; 
              } 
            ?>
             
           </tbody>
         </table>

           
             
             
           

         <?php 
        
        }else{
          echo "<h3>no record found</h3>";
        } 
   
          $sql1="SELECT * FROM  post";
          $result=mysqli_query($conn,$sql1);
          if (mysqli_num_rows($result)>0) {
            $total_records=mysqli_num_rows($result);
            $total_page=ceil($total_records/$limit);
                    echo '<ul class="pagination page-set" >';
                    if ($page>1) {
                        echo '<li><a href="post.php?page='.($page-1).'">pre</a></li>';
                    }
              for ($i=1; $i <$total_page ; $i++) { 
                    
                    if ($i==$page) {
                      $active="active";
                    }else{
                      $active="";
                    }
                    echo '<li class="page-item '.$active.'"><a href="post.php?page='.$i.'">'.$i.'</a></li>';

               }
                  if ($total_page>$page) {
                        echo '<li><a href="post.php?page='.($page+1).'">next</a></li>';
                    }

                   echo "</ul>";
                   
          }


         ?>
       </div>









    </div>
  </div>
</div>

<?php
 include 'admin-footer.php';
?>