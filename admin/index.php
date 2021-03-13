<?php
   include  'config.php';
   session_start();
   if (isset($_SESSION['username'])) {
       header("location:{$hostname}/admin/post.php");
   }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ADMIN|login</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="../css/font-awesome.css">

        <!-- Custom stlylesheet -->


        <link rel="stylesheet" href="../css/news-css.css">
</head>
<body>
      <div id="wrapper-admin">
      	<div class="container">
      		<div class="row">
      			<div class="col-md-4 col-md-offset-4">
      				<img src="images/logo.png" class="logo">
      				<h3>ADMIN</h3>
      				<!--form start-->
      			<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
      				<div class="form-group">
      					<label>Username</label>
      					<input type="text" name="username" class="form-control" required>
      				</div>
      				<div class="form-group">
      					<label>Password</label>
      					<input type="password" name="password" class="form-control" required>
      				</div>
                    <input type="submit" name="login" value="save" class="btn btn-primary">
      			</form>
      			<!-- form end-->

      			<?php 
                   
                 if (isset($_POST['login'])) {
                 	include "config.php";
                 	$username=mysqli_real_escape_string($conn,$_POST['username']);
                 	$password=md5($_POST['password']);
                 
                $sql="SELECT user_id,username,role FROM user WHERE username='{$username}' AND password='{$password}'";
              
                 $result=mysqli_query($conn,$sql) or die("query failed");

                      if (mysqli_num_rows($result)>0) {
                       	  while ($row=mysqli_fetch_assoc($result)) {
                       	  	 session_start();
                       	  	 $_SESSION["username"]=$row['username'];
                       	  	 $_SESSION["user_id"]=$row['user_id'];
                       	  	 $_SESSION["user_role"]=$row['role'];
                       	  	 header("location:{$hostname}/admin/post.php");

                       	  }
                       } else{
                       	   echo '<div class="alert alert-danger" >username or password not matched</div>';
                       }
                  }
      			?>
      			</div>
      			
      		</div>
      	</div>
      </div>
</body>
</html>
