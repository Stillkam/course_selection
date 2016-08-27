<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    <body>

    <!-- navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <br>
            <a class="brand" href="http://www.fudan.edu.cn">Fudan University</a>
            <ul class="nav pull-right">                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle hidden-phone" data-toggle="dropdown">
                        Admin:&nbsp&nbsp<?php echo $_SESSION['user'].'&nbsp&nbsp&nbsp&nbsp';?>  
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
            <li>
                <a href="admin.php">
                    <i class="icon-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="active">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                 <a href="ad_c_info.php">
                    <i class="icon-tasks"></i>
                    <span>Course INFO</span>
                </a>
            </li>
            <li>
            <li >
                <a href="ad_t_info.php">
                    <i class="icon-user"></i>
                    <span>Teacher INFO</span>
                </a>
            </li>
            <li>
                <a href="ad_s_info.php">
                    <i class="icon-group"></i>
                    <span>Student  INFO</span>
                </a>
            </li>    
             <li>
                <a href="ad_user_info.php">
                    <i class="icon-key"></i>
                    <span>User INFO</span>
                </a>
            </li> 
        </ul>
    </div>
    <!-- end sidebar -->
<?php
$CID=$_POST['CID'];
$conn = new mysqli('localhost','root' , '941126xiangjie', 'courses');
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql="select Cname,Tname,Croom,Credit,Ctime,Cnum from course where course.CID='{$CID}'";
$result = $conn->query($sql); 
$row = $result->fetch_assoc();
$Cname=$row['Cname'];
$Tname=$row['Tname'];
$Croom=$row['Croom'];
$Credit=$row['Credit'];
$Ctime=$row['Ctime'];
$num=$row['Cnum'];
?>

	<!-- main container -->
    <div class="content">
        <div class="alert alert-info" style="border-left-width: 1px;margin-left: 50px;margin-right: 200px;">
                <i class="icon-lightbulb"></i>
                <strong>CID</strong> cannot been modified.Please be <strong>careful</strong>,your modification will cause <strong>Unpredictable consequences.</strong>
        </div>
        <h2 style="margin-left: 50px;font-style:Comic Sans MS;color:CadetBlue;margin-top: 50px;">Course INFO</h2>
        <div style="margin-left: 50px;margin-top: 50px;">
        <form method="post" action="ad_c_mfr.php">
            <div class="field-box" style="margin-bottom: 25px;">
                <label>CID: &nbsp&nbsp<span class="label label-info">
                    <?php echo $CID;echo '<input type="hidden" name="CID" value="'.$CID.'">'; ?>
                    </span></label>
            </div>
            <div class="field-box" style="margin-bottom: 25px;">
                <label>Course Name:&nbsp&nbsp&nbsp
<?php echo '<input style="width: 500px;" class="span8 inline-input" placeholder="'.$Cname.'" type="text" name="Cname">'; ?></label>
            </div>
            <div class="field-box" style="margin-bottom: 25px;">
                <label>Teacher Name:&nbsp&nbsp
<?php echo '<input style="width: 500px;" class="span8 inline-input" placeholder="'.$Tname.'" type="text" name="Tname">'; ?></label>
            </div>
            <div class="field-box" style="margin-bottom: 25px;">
                <label>Course Room:&nbsp&nbsp&nbsp&nbsp
<?php echo '<input style="width: 500px;" class="span8 inline-input" placeholder="'.$Croom.'" type="text" name="Croom">'; ?></label>
            </div>
            <div class="field-box" style="margin-bottom: 25px;">
                <label>Credit:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<?php echo '<input style="width: 500px;margin-left: 40px;" class="span8 inline-input" placeholder="'.$Credit.'" type="text" name="Credit">'; ?></label>
            </div>
            <div class="field-box" style="margin-bottom: 25px;">
                <label>Course Time:&nbsp&nbsp
<?php echo '<input style="width: 500px;margin-left: 12px;" class="span8 inline-input" placeholder="'.$Ctime.'" type="text" name="Ctime">'; ?></label>
            </div>
            <div class="field-box" style="margin-bottom: 25px;">
                <label>NUM:&nbsp&nbsp
<?php echo '<input style="width: 500px;margin-left: 60px;" class="span8 inline-input" placeholder="'.$num.'" type="text" name="num">'; ?></label>
            </div>
            <div class="field-box" style="margin-bottom: 25px;">
                <input type="submit" value="Modify" class="btn-flat danger"> 
            </div>
        </form>
        </div>
        </div>
	<!-- scripts -->
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script src='js/fullcalendar.min.js'></script>  
    <!-- builds fullcalendar example -->
    
</body>
</html>