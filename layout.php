<?php

  include 'mheader.php';
?>
      <div id="main-content">
        <div class="container">
         <div class="row">

                           <?php
                               include 'config.php';
                               $limit=6;
                               //calculating the offsett class
                               if (isset($_GET['page'])) {
                               $page=$_GET['page'];
                               }else{
                               $page=1;
                               }
                                $offset=($page-1)*$limit;
                                  /* select query of post table for admin user */
                                 $sql="SELECT  post.post_id,post.description,post.titile,
                                 post.post_date,category.category_name,user.username,  post.category,post.post_author ,post.post_img FROM post
                                 LEFT JOIN category ON post.category = category.category_id
                                 LEFT JOIN user ON post.post_author = user.user_id
    
                                 ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

                                 $result=mysqli_query($conn,$sql);
                                if (mysqli_num_rows($result)>0) {
                                         while ($row=mysqli_fetch_assoc($result)) { 
                               ?>
                 
                 
                   <div class="col-lg-4 col-md-6 mb-4 card-main">
                 <div class="card  " >
                      <div class="card-img">
                         <img src="admin/upload/<?php echo $row['post_img']; ?>" >
                       </div>  
                   <div class="card-body card-body " >

                    <h2 class="card-title">
                      <a href='single.php?id=<?php echo $row['post_id']; ?> '><?php echo $row['titile'] ?></a>
                    </h2>
                    <p class="card-text">there are two type of the people that can not difined to how </p>
                    <a href='single.php?id=<?php echo $row['post_id']; ?>' class="btn btn-primary " >read more</a>
                   </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                 </div>
                </div> 
                     <?php

                       }
                   }else{
                      echo'  <h2>recored not found</h2>';
                   }

                     ?>

                 

                </div>
                
         <?php 
        
                $sql1="SELECT * FROM  post";
                $result=mysqli_query($conn,$sql1);
                if (mysqli_num_rows($result)>0) {
                $total_records=mysqli_num_rows($result);
                $total_page=ceil($total_records/$limit);
                    echo '<ul class="pagination page-set "  >';
                    if ($page>1) {
                        echo '<li><a href="index.php?page='.($page-1).'">pre</a></li>';
                    }
                for ($i=1; $i <$total_page ; $i++) { 
                    
                    if ($i==$page) {
                      $active="active";
                    }else{
                      $active="";
                    }
                    echo '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';

                }
                  if ($total_page>$page) {
                        echo '<li class="page-item" ><a class="page-link" href="index.php?page='.($page+1).'">next</a></li>';
                    }

                   echo "</ul>";
                   
          }


   
          
         ?>
         



        </div>   
        </div>
      </div>

<?php include 'footer.php'; ?>