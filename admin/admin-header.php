
<?php
 include 'config.php';
 session_start();
 if(!isset($_SESSION['username'])){
   header("location:{$hostname}/admin/");
 }

?>


<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ADMIN Panel</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <!--<link rel="stylesheet" href="../css/font-awesome.css">-->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">





        <!-- Custom stlylesheet -->


        <link rel="stylesheet" href="../css/news-css.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
      <div id="header-admin">
      	<div class="container " style="background-color: blue;" >
      		<div class="row">
      			<div class="col-md-2 ">
      				<a href="#" class="logo"><img src="images/logo.png"></a>
      			</div>
            
      			<div class="col-md-3 col-md-offset-7  ">
      				<a href="logout.php" class="admin-logout">Hello <?php echo $_SESSION['username'];?>, Logout</a>
      			</div>
      		</div>
      	</div>
      </div>
      <!--header end-->
       <!--menu bar start-->
     <div id="admin-menubar">  
       <div class="container ">
  
            <ul class="nav nav-tabs admin-menu"  >
              <li class="nav-item">
                 <a class="nav-link" href="post.php">post</a>
              </li>
              <?php 
                     if ($_SESSION['user_role']==1) {
                    
               ?>
             <li class="nav-item">
                <a class="nav-link" href="category.php">catergory</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="users.php">users</a>
             </li>
             <?php } ?>
    
           </ul>
           
 
        </div>
      </div>
    
