<?php 
session_start();
if(isset($_SESSION['user']))
unset($_SESSION['user']);
?>

<!DOCTYPE html>
<head>
	<title>Login</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">	
</head>
<body class="templatemo-bg-gray">
	<div class="container">
		<div class="col-md-12">
			<h1 class="margin-bottom-15">COURSE SELECTION</h1><br><br>
<?php
$ID = $Password =  "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

   if (($_POST["ID"]))
     {$ID = test_input($_POST["ID"]);}
   
   if (($_POST["Password"]))
     {$Password = test_input($_POST["Password"]);}
   userck($ID,$Password);
}

function userck($ID,$PS){
    $conn = new mysqli('localhost','root' , '941126xiangjie', 'courses');
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

    $sql = "select ID,Password,UserTP from user where user.ID='$ID'";
    $result = $conn->query($sql);    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if($row['Password']===$PS){
            $_SESSION['user']=$ID;
            switch($row['UserTP']){
                case 'student': header('Location:http://localhost/WORK/course_selection/student/home.php');break;
                case 'teacher': header('Location:http://localhost/WORK/course_selection/teacher/teacher.php');break;
                case 'admin':  header('Location:http://localhost/WORK/course_selection/admin/admin.php');break;
                default:break;
            }
        }
        else{
            echo '<script>alert("Password Or ID is wrong!");</script>';
            }
    }
    else {
        echo '<script>alert("Password Or ID is wrong!");</script>';
    }
    $conn->close();
}
function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}
?>
			<form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">				
		        <div class="form-group">
		          <div class="col-xs-12">		            
		            <div class="control-wrapper">
		            	<label for="username" class="control-label fa-label"><i class="fa fa-user fa-medium"></i></label>
		            	<input type="text" class="form-control" name="ID" placeholder="ID">
		            </div>		            	            
                  </div>            
		        </div>
		        <div class="form-group">
		          <div class="col-md-12">
		          	<div class="control-wrapper">
		            	<label for="password" class="control-label fa-label"><i class="fa fa-lock fa-medium"></i></label>
		            	<input type="password" class="form-control" name="Password" placeholder="Password">
		            </div>
		          </div>
		        </div>
		        <div class="form-group">
		          <div class="col-md-12">
		          	<div class="control-wrapper">
		          		<input type="submit" value="Log in" class="btn btn-info">
		          		<a href="forgot_password.html" class="text-right pull-right">Forgot password?</a>
		          	</div>
		          </div>
		        </div>
		        <hr>
		        <div class="form-group">
		        	<div class="col-md-12">
		        		<p2 style="color: #138892;">Fudan University</p2>
		        	</div>
		        </div>
		      </form>
		      <div class="text-center">
		      	<a href="create_account.php" class="templatemo-create-new">Create new account <i class="fa fa-arrow-circle-o-right"></i></a>	
		      </div>
		</div>
	</div>
</body>
</html>