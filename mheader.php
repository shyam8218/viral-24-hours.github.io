
<?php
  include 'config.php';
  $page=basename($_SERVER['PHP_SELF']);

  switch ($page) {
      case 'single.php':
           if (isset($_GET['id'])) {
               $sql_title="SELECT * FROM post WHERE post_id={$_GET['id']}";
               $result_title=mysqli_query($conn,$sql_title) or die("query failed title");
               $row_title=mysqli_fetch_assoc($result_title);
               $page_title=$row_title['titile'];
                

           }else{
            $page_title= "no post found";
           }
            break;
        case 'category.php':
           if (isset($_GET['cid'])) {
               $sql_title="SELECT * FROM category WHERE category_id={$_GET['cid']}";
               $result_title=mysqli_query($conn,$sql_title) or die("query failed title");
               $row_title=mysqli_fetch_assoc($result_title);
               $page_title=$row_title['category_name'];
                $page_title;

           }else{
            $page_title= "no post found";
           }
          break;
           case 'search.php':
            if (isset($_GET['search'])) {
               
               $page_title=$_GET['search'];
               

           }else{
            $page_title= "no search result found";
           }
          break;
      case 'author.php':
            if (isset($_GET['aid'])) {
               $sql_title="SELECT * FROM user WHERE user_id={$_GET['aid']}";
               $result_title=mysqli_query($conn,$sql_title) or die("query failed title");
               $row_title=mysqli_fetch_assoc($result_title);
               $page_title=$row_title['username'];
                $page_title;

           }else{
            $page_title= "no post found";
           }
          break;
      
      default:
          $page_title = "NEWS 24";
          break;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $page_title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/news-css.css">
   <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #f1f1f1;">

  <div id="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 bg-danger col-md-offset-4 mx-auto">
                        <img src="images/logo.png" id="logo">
                 </div>
                
                </div>

            </div>
        </div>
        <!--header close-->
 <div id="menu-bar">
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">

       <?php  
                       include 'config.php';
                       if (isset($_GET['cid'])) {
                                 $post_cid=$_GET['cid'];
                         }
                       $sql="SELECT * FROM category WHERE post>0";
                       $result=mysqli_query($conn,$sql) or die("query failed:category");
                        if (mysqli_num_rows($result)>0) {
                                                           
                           $active="";
                        
                   ?>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 menu">
              <li  ><a  href='<?php echo $hostname; ?>'> HOME</a></li>
                  <?php   while ($row=mysqli_fetch_assoc($result)) { 
                           if (isset($_GET['cid'])) {
                                   if ($post_cid==$row['category_id']) {
                                    $active="active";
                                  }else{
                                  $active="";
                                   }  
                           }
                          
                      echo "<li  ><a class='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
                    } ?>              
                </ul>
                <?php } ?>
      
    
        <form  action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>

  </div>
</nav>
</div>


