<?php include 'mheader.php'; ?>
<div id="main-content">
	<div  class="container">
		<div class="row">
			<div class="col-md-8">
				<!--post-container-->
				<div class="post-container " style="border:2px solid black;">

                      <?php
                               include 'config.php';
                               $post_id=$_GET['id'];
                               
                                 $sql="SELECT  post.post_id,post.description,post.titile,
                                 post.post_date,category.category_name,user.username,  post.category ,post.post_img FROM post
                                 LEFT JOIN category ON post.category = category.category_id
                                 LEFT JOIN user ON post.post_author = user.user_id
                                 WHERE post.post_id={$post_id}";
                               
                                 $result=mysqli_query($conn,$sql);
                                if (mysqli_num_rows($result)>0) {
                                         while ($row=mysqli_fetch_assoc($result)) { 
                               ?>

					<div class="post-content single-post">
						<h3><?php  echo $row{'titile'} ?></h3>

						<div class="post-information">
							<span>
								<i class="fa fa-tags"></i>
								<a href='category.php?cid=<?php echo $row['category']; ?>'><?php  echo $row{'category_name'} ?></a>
							</span>
							<span>
								<i class="fa fa-user"></i>
								<a href="#"><?php echo $row['username'] ?></a>
							</span>
							<span>
								<i class="fa fa-calendar"></i>
								<a href="#"><?php  echo $row{'post_date'} ?></a>
							</span>

						</div>
						 <img  src="admin/upload/<?php echo $row['post_img']; ?>" class="single-feature-img"> 
						<p>
							<?php  echo $row{'description'} ?>
						</p>
					</div>
					<?php  
                      }
                  }
                    
					?>
				</div>
                 <!--post-container-end-->


			</div>
			<?php include 'sidebar.php'; ?>
		</div>
	</div>
</div>


<?php include 'footer.php'; ?>