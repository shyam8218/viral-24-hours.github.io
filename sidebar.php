
<div id="sidebar" class="col-md-4" >
   
    

    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
          include 'config.php';
          $limit=4;
         $sql="SELECT  post.post_id,post.titile,
                                 post.post_date,category.category_name, post.category ,post.post_img FROM post
                                 LEFT JOIN category ON post.category = category.category_id
                                 
                                 ORDER BY post.post_id DESC LIMIT {$limit}";
          $result=mysqli_query($conn,$sql) or die("query failed");
          if (mysqli_num_rows($result)) {
              while ($row=mysqli_fetch_assoc($result)) {
            
        ?>
        <div class="recent-post">
            <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>">
                <img src="admin/upload/<?php echo $row['post_img'] ?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=<?php echo $row['post_id'] ?>"><?php echo $row['titile']; ?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cid=<?php echo $row['category'] ?>'><?php echo $row['category_name'] ?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    01 Nov, 2019
                </span>
                <a class="btn btn-primary btn-sm" href="single.php?id=<?php echo $row['post_id'] ?>">read more</a>
            </div>
        
        </div>
        <?php 
              }
          }

         ?>
    </div>
   </div>
