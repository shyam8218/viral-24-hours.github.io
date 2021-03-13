<?php include 'admin-header.php' ;
      include 'config.php';
 if ($_SESSION["user_role"]=='0') {
    header("Location: {$hostname}/admin/post.php");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row ">
            <div class="col-md-10   ">
                <h1 class="admin-heading">ALL USERS</h1>
            </div>
            <div class="col-md-2 ">
                <a href="add-user.php" class="add-new">ADD USER</a>
            </div>


            <div class="col-md-12" >
              <?php
                include 'config.php' ;
                //calculate the offset code 
                $limit=3;
                if(isset($_GET['page'])){
                  $page=$_GET['page'];
                  }else{
                    $page=1;
                  } 
                  $offset=($page-1)*$limit;
                  //select query of user table with offset and limit//
                $sql="SELECT * FROM user ORDER by user_id DESC LIMIT {$offset},{$limit}";
                $result=mysqli_query($conn,$sql) or die("query failed");

                if (mysqli_num_rows($result)>0) {
                               

              ?>
                <table class="table table-bordered table-striped table-content">
                    <thead >
                        <th>S.NO</th>
                        <th>FULL NAME</th>
                        <th>USER NAME</th>
                        <th>ROLE</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </thead>
                    <tbody>
                    <?php
                        $serial = $offset + 1;
                        while ($row=mysqli_fetch_assoc($result)) {
                        
                        
                    ?>

                    <tr>
                      <td class="id"> <?php echo $serial; ?></td>
                      <td><?php echo $row['first_name']."".$row['last_name']; ?></td>
                      <td><?php echo $row['username']?></td>
                      <td><?php   
                                    if($row['role']==1){
                                        echo "admin";
                                         }else{
                                           echo "normal";
                                              }
                                           

                      ?></td>
                      <td class="edit"><a href="update-user.php?id=<?php echo $row['user_id'] ;?>"><i class="fa fa-edit"></i></a></td>
                      <td class="delete"><a href="delete-user.php?id=<?php echo $row['user_id']; ?>"><i class="fa fa-trash"></i></a></td>
                            
                    </tr>
                    <?php
                     $serial++;
                    }
                    ?>
                    </tbody>
                </table>
            
                <?php
               }else{
                echo "no record found";
               }
               
                   //pagination cooding start to start page
                  $sql1="SELECT *FROM user";
                  $result=mysqli_query($conn,$sql1)or die("query failed");
                  
                  if(mysqli_num_rows($result)>0){
                    $total_records=mysqli_num_rows($result);
                    $total_page=ceil($total_records/$limit);
                    

                      echo '<div style="margin-left: 450px;"><ul class="pagination justify-content-center" >';
                      if ($page>1) {
                          echo '<li><a href="users.php?page='.($page-1).'">prev</a></li>';
                      }
                      for($i=1;$i<=$total_page;$i++){
                        if($i==$page){
                          $active="active";
                        }else{
                          $active="";
                        }
                        echo'<li class="'.$active.'"><a href="users.php?page='.$i.'" >'.$i.'</a></li>';
                      }
                      if($total_page>$page){
                        echo '<li><a href="users.php?page='.($page+1).'" >next</a></li>';
                      }
                      echo '</ul></div>';
                      
                  } 

                ?>
               

            </div>


               
                        
                       
                               



        </div>

    </div>

</div>
