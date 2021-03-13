<?php  include 'admin-header.php'; 

if (($_SESSION['user_role'])==0) {
    header("location:{$hostname}/admin/post.php");
}
 if (isset($_POST['save'])){
 	include 'config.php';

    $fname= mysqli_real_escape_string($conn, $_POST['fname']);
    $lname= mysqli_real_escape_string($conn, $_POST['lname']);
    $user= mysqli_real_escape_string($conn, $_POST['user']);
    $password= mysqli_real_escape_string($conn, md5($_POST['password']));
    $role= mysqli_real_escape_string($conn, $_POST['role']);

      $sql="SELECT username FROM user WHERE username='{$user}'";
     
    $result=mysqli_query($conn,$sql) or die("connection failed");

    if (mysqli_num_rows($result)>0) {
    	echo "<p>username already exists:</p>";
    }else{
    	$sql1="INSERT INTO user(first_name,last_name,username,password,role)
               VALUES('{$fname}','{$lname}','{$user}','{$password}','{$role}') ";

        $result1=mysqli_query($conn,$sql1) or die("connection failed 1");        
    

     }




 }

?>

<div id="admin-content">
	<div class="container">
	  <div class="row">
	  	<div class="col-md-12 ">
	  		<h1 class="admin-heading">ADD USER</h1>

	  	</div>
        <div class="col-md-6 col-md-offset-3 " style="background-color: white;padding: 40px 20px; " >
        	<!--form start-->
        	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" class="form">
        		<div class="form-group">
        			<label>First Name</label>
        			<input type="text" name="fname" placeholder="first name" required class="form-control">
        		</div>
        		<div class="form-group">
        			<label>Last Name</label>
        			<input type="text" name="lname" placeholder="last name" required class="form-control">
        		</div>
        		<div class="form-group">
        			<label>User Name</label>
        			<input type="text" name="user" placeholder="user name" required class="form-control">
        		</div>
        		<div class="form-group">
        			<label>Password</label>
        			<input type="password" name="password" placeholder="password" required class="form-control ">
        		</div>
        		<div class="form-group">
        			<label>User Role</label>
        			<select name="role" class="form-control">
        				<option value="0">Normal user</option>
        				<option value="1"> Admin</option>
        			</select>
        		</div>
                    <input type="submit" name="save" value="save" class="btn btn-primary " required/>
           </form>
        </div>
	  </div>
	</div>
</div>
<?php include 'admin-footer.php'; ?>