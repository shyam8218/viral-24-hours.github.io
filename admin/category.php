<?php
  include 'admin-header.php';
  include 'config.php';

  if ($_SESSION['username']=='0') {
        header("location: {$hostname}/admin/post.php");
  }
?>
<div id="admin-content">
	<div class="container">
		<div class="row">
			<div class="col-md-10 ">
				<h3 class="admin-heading">ALL Catergory</h3>
			</div>
			<div class="col-md-2 ">
				<a href="add-category.php" class="add-new">Add Category</a>
			</div>

             <div class="col-md-12" >

             	<?php
             	  include 'config.php';
                  //calculating the offset 
                  $limit=3;
                  if (isset($_GET['page'])) {
                  	$page=$_GET['page'];
                  }else{
                  	$page=1;
                  }
                  $offset=($page-1)*$limit;
                  $sql="SELECT * FROM category ORDER BY category_id desc LIMIT {$offset},{$limit}";
                  $result=mysqli_query($conn,$sql) or die("query failed.");
                     if (mysqli_num_rows($result)>0) {
                           
                     

             	?>

             	<table class="table table-bordered table-hover table-striped table-content ">
             		<thead >
             			<th class="text-center">S.NO.</th>
             			<th class="text-center">CATEGORY NAME</th>
             			<th class="text-center">NO. OF POSTS</th>
             			<th class="text-center">EDIT</th>
             			<th class="text-center">DELETE</th>

             		</thead>
    
             		<tbody>
                              
             			<?php 
                        $serial=1;
                        while ($row=mysqli_fetch_assoc($result)) {
                                         
                                   
                               ?>
             			<tr>
             				<td class="id" ><?php echo $serial; ?></td>
             				<td><?php echo $row['category_name'] ?></td>
             				<td><?php echo $row['post'] ?></td>
             				<td class='edit'><a href='update-category.php?id=<?php echo $row['category_id'] ?>' ><i class='fa fa-edit'></i></a></td>
                    <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id']?>'><i class='fa fa-trash'></i></a></td>
             			</tr>
             		</tbody>
                        <?php
                               $serial++;
                               }
                        ?>
             	</table>
                        <?php
                           }
                           include 'config.php';
                            $sql1="SELECT * FROM category";
                           $result=mysqli_query($conn,$sql1) or die("query failed");
                         if (mysqli_num_rows($result)>0) {
                         	
                         	$total_record=mysqli_num_rows($result);
                         	$total_page=ceil($total_record/$limit);

                             
                               echo  '<ul class="pagination" style="margin: 20px 450px;">';
                         	for ($i=1; $i <$total_page ; $i++) { 

                         		  if ($i==$page) {
                         		  	 $active="active";
                         		  }else{
                         		  	$active="";
                         		  }

                         		  echo '<li class="'.$active.'"><a href="category.php?page='.$i.'">'.$i.'</a></li>';
                         	}
                         	if ($total_page>$page) {
                         		echo '<li><a href="category.php?page='.($page+1).'">next</a></li>';
                         	}

                         	echo '</ul>';

                         }

                        ?>
                                         
                      
                                        


             </div>


		</div>
	</div>
</div>