<?php

  include 'mheader.php';
?>
 <div id="main-content">
        <div class="container">
           <div class="row">
              <div class="col-md-8  " style="background-color: #fff">
                <!--post-container start-->
                <div class="post-container">
                	<?php
                          include 'config.php';  
                          if (isset($_GET['aid'])) {
                              $authr_id=$_GET['aid']; 
                            }  
                               
                              
                                
                              
                        $sql1="SELECT * FROM user WHERE user_id={$authr_id}";
                       
                        $result1=mysqli_query($conn,$sql1) or die("query failed");
                         $row1=mysqli_fetch_assoc($result1);
                 
                	?>
                	  <h2 class="page-heading"><?php echo $row1['username'] ?></h2>

                           <?php
                               
                               $limit=3;
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
                                 where post.post_author={$authr_id}
                                 ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

                                 $result=mysqli_query($conn,$sql);
                                if (mysqli_num_rows($result)>0) {
                                         while ($row=mysqli_fetch_assoc($result)) { 
                               ?>

                   <div class="post-content " >
                      <div class="row">
                         <div class="col-md-4 ">
                              <a href='single.php?id=<?php echo $row['post_id']; ?>'class="post-img">
                                            <img src="admin/upload/<?php echo $row['post_img']; ?>" >
                              </a>   
                         </div>
                         <div class="col-md-8">
                            <div class="inner-content clearfix">
                                <h3><a href='single.php?id=<?php echo $row['post_id']; ?> ' ><?php echo $row['titile'] ?></a></h3>
                                <div class="post-information">
                                        <span>
                                                <i class="fa fa-tags " aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                                        </span>
                                        <span>
                                                <i class="fa fa-user"></i>
                                                <a href='author.php?aid=<?php echo $row['post_author']; ?>'> <?php echo $row['username']; ?></a>
                                        </span>
                                        <span>
                                                <i class="fa fa-calendar"></i>
                                                <?php echo $row['post_date']; ?>
                                        </span>
                                </div>
                                    <p class="description">
                                            <?php echo substr($row['description'],0,130) . "..."; ?>
                                   </p>
                                   <a href='single.php?id=<?php echo $row['post_id']; ?> ' class="btn btn-primary pull-right" >read me</a>
                            </div>               
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
        
               

                if (mysqli_num_rows($result1)>0) {
                $total_records=mysqli_num_rows($result1);
                
                $total_page=ceil($total_records/$limit);
                    echo '<ul class="pagination justify-content-center"  >';
                    if ($page>1) {
                        echo '<li><a href="author.php?cid='. $authr_id .' &page='.($page-1).'">pre</a></li>';
                    }
                for ($i=1; $i <=$total_page ; $i++) { 
                    
                    if ($i==$page) {
                      $active="active";
                    }else{
                      $active="";
                    }
                    echo '<li class="page-item '.$active.'"><a class="page-link" href="author.php?aid='. $authr_id .'&page='.$i.'">'.$i.'</a></li>';

                }
                  if ($total_page>$page) {
                        echo '<li class="page-item" ><a class="page-link" href="author.php?aid='. $authr_id .'&page='.($page+1).'">next</a></li>';
                    }

                   echo "</ul>";
                   
          }


   
          
         ?>
         



              </div>
              <?php include 'sidebar.php'; ?>
           </div>
        </div>
 </div>
<?php include 'footer.php'; ?>