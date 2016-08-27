<!DOCTYPE html>
<head>
	<title>Create Account</title>
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
			<h1 class="margin-bottom-15">Create Account</h1>
<?php
// define variables and set to empty values
$usertp=$ID = $Password =  "";
 $conn = new mysqli('localhost','root' , '941126xiangjie', 'courses');
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

   if (($_POST["ID"]))
     {$ID = test_input($_POST["ID"]);}
   
   if (($_POST["Password1"]))
     {$Password = test_input($_POST["Password1"]);}
   $sql1="select SID from student where student.SID={$ID}";
   $sql2="select TID from teacher where teacher.TID={$ID}";
   if( $conn->query($sql1)->fetch_assoc()>0){
       $usertp='student';
       useradd($ID,$Password,$usertp);
   }
    else if($conn->query($sql2)->fetch_assoc()>0){
        $usertp='teacher';
        useradd($ID,$Password,$usertp);
    }
    else
        echo '<script>alert("NO Such ID Exists!")</script>';
}

function useradd($ID,$PS,$UT){
    $sql = "insert into user(ID,Password,userTP)value('$ID','$PS','{$UT}')";
    if ($GLOBALS['conn']->query($sql) === TRUE) {
        echo '<script>alert("Account Created,Please Login!");location.href="login.php";</script>';
        
    }
}
function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}
?>
			<form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="form">
                <p style="color: #138892;margin-left: 30px;">Only The Student Or Teacher In Fudan University Can Register</p>
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
		            	<input type="password" class="form-control" name="Password1" id="password1" placeholder="Password">
		            </div>
		          </div>
		        </div>
                <div class="form-group">
		          <div class="col-md-12">
		          	<div class="control-wrapper">
		            	<label for="password" class="control-label fa-label"><i class="fa fa-lock fa-medium"></i></label>
		            	<input type="password" class="form-control" id="password2" placeholder="Confirm Password">
		            </div>
		          </div>
		        </div>
		        <p style="color:#F00; margin-left: 30px;" id="pck"></p>
		        <div class="form-group">
		          <div class="col-md-12">
		          	<div class="control-wrapper">
		          		<input type="button" value="Create Account" class="btn btn-info" id="reg">
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
		      	<a href="login.php" class="templatemo-create-new">Log In <i class="fa fa-arrow-circle-o-right"></i></a>	
		      </div>
		</div>
	</div>
    <script>
        document.getElementById('reg').addEventListener('click', function (){
            var pw1 = document.getElementById("password1").value;
            var pw2 = document.getElementById("password2").value;
            if(pw1 != pw2) {
                  document.getElementById("pck").innerHTML="<font color='red'>Passwords don't match. Try again?</font>";
              }
            else{
                   document.getElementById('pck').innerHTML="<font color='green'>Passwords match.</font>";
                   document.getElementById('form').submit();    
             }
        });
    </script>
</body>
</html>