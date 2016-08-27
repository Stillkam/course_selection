<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Course Selection</title>
    
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- libraries -->
    <link href="css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/icons.css" />
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />
    <link href='css/lib/fullcalendar.css' rel='stylesheet' />
    <link href='css/lib/fullcalendar.print.css' rel='stylesheet' media='print' />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/index.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/compiled/calendar.css" type="text/css" media="screen" />

    <!-- open sans font -->
    <link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!-- lato font -->
    <link href='http://fonts.useso.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    <body >

    <!-- navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <br>
            <a class="brand" href="http://www.fudan.edu.cn">Fudan University</a>
            <ul class="nav pull-right">                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle hidden-phone" data-toggle="dropdown">
                        Student User:&nbsp&nbsp<?php echo $_SESSION['user'].'&nbsp&nbsp&nbsp&nbsp';?>  
                    </a>
                    <ul class="dropdown-menu">
                       <li><a href="http://localhost/WORK/course_selection/forgot_password.html">Change Password</a></li>
                        <li><a href='http://localhost/WORK/course_selection/login.php'>Log Out</a></li>
                    </ul>
                </li>
                <br><br>
            </ul>            
        </div>
    </div>
    <!-- end navbar -->

    <!-- sidebar -->
    <div id="sidebar-nav">
        <ul id="dashboard-menu">
            <li class="active">
                <a href="home.php">
                    <i class="icon-home"></i>
                    <span>Home</span>
                </a>
            </li>            
           
            <li>
                <a href="mycourse.php">
                    <i class="icon-reorder"></i>
                    <span>My Courses</span>
                </a>
            </li>
            <form role="form" name="form" method="post">
            <li><br>
            <input type="text" class="span8 inline-input" name="courseID" placeholder="CourseID">
            </li><br>
                <table>
            <tr>
                <input type="submit" value="Course Query" class="btn-flat info" onclick="query()"/>
            </tr><br>
            <li><br>   
            <tr>
                <input type="submit" value="Course Select" class="btn-flat" onclick="selection()"/>
            </tr>
            </li>
            <li><br>   
            <tr>
                <input type="submit" value="Course Drop " class="btn-flat danger" onclick="drop()"/>
            </tr>
            </li>              
                </table>
            </form>
        </ul>
    </div>
    <!-- end sidebar -->
<?php
$courseID = $_POST["courseID"];
require('../cktime.php');
$conn = new mysqli('localhost','root' , '941126xiangjie', 'courses');
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

    $sql1="select * from course where exists (select CID from course where CID='{$courseID}')";
    $result1= $conn->query($sql1); 
    if($result1->num_rows>0){
       $sql2="select * from sc where sc.SID={$_SESSION['user']} and sc.CID='{$courseID}'";
       $result2= $conn->query($sql2); 
       if($result2->num_rows>0){
            echo '<script>alert("This Course Has Been Selectd!");</script>';
        }
        else{
            if(cktime($_SESSION['user'],$courseID)){
            $sql = "insert into sc(SID,CID)value({$_SESSION['user']},'{$courseID}')"; 
            if ($conn->query($sql) == TRUE) {
            echo '<script>alert("Course Selected Successfully!");</script>';
            }
            }
            else
                echo '<script>alert("Time conflicts!");</script>';
     }
    }
    else{
        echo '<script>alert("CourseID IS Wrong!");</script>';
    }

   
$conn->close();
?>
	<!-- main container -->
    <div class="content">
        <table class="fc-header" style="width:100%">
            <tbody>
                <br>
                <tr>
                <td class="fc-header-center">
                    <span class="fc-header-title">
                        <h2 style="color:DarkCyan;">Course Table</h2>
                    </span>
                </td>
                </tr>
            </tbody>
        </table>
     <table class="table table-hover" >
                      <thead>
                        <tr>
                          <th></th>
                          <th>Monday</th>
                          <th>Tuesday</th>
                          <th>Wednesday</th>
                          <th>Thursday</th>
                          <th>Friday</th>
                          <th>Saturday</th>
                          <th>Sunday</th>
                        </tr>
                      </thead>
                      <tbody>
<?php
require('table.php');
$c=getstable($_SESSION['user']);
?>
                      </tbody>
                    </table>
<h1 style="color:DarkCyan;">Total Credits: <?php echo $c; ?></h1>
    </div>
	<!-- scripts -->
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script src='js/fullcalendar.min.js'></script>
    <script>
    function query(){
        document.form.action="query.php";
    }
    function select(){
        document.form.action="select.php";
    }
     function drop(){
        document.form.action="drop.php";
    }    
    </script>    
    <!-- builds fullcalendar example -->
    
</body>
</html>