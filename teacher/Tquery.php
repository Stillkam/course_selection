<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Tcourse</title>
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
                        Teacher:&nbsp&nbsp<?php echo $_SESSION['user'].'&nbsp&nbsp&nbsp&nbsp';?>  
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
                <a href="Teacher.php">
                    <i class="icon-home"></i>
                    <span>Home</span>
                </a>
            </li>            
            <li >
                <a href="Tcourse.php">
                    <i class="icon-reorder"></i>
                    <span>Courses</span>
                </a>
            </li>
            <li>
                <a href="mark.php">
                    <i class="icon-pencil"></i>
                    <span>Mark</span>
                </a>
            </li>  
            <form role="form" name='form' method="post" action="Tquery.php">
            <li><br>
            <input type="text" class="span8 inline-input" name="SID" placeholder="SID">
            </li><br>
                 <table>
            <tr>
                <input type="submit" value="SID Query" class="btn-flat info" />
            </tr><br>
                </table>
            </form>
        </ul>
    </div>
    <!-- end sidebar -->


	<!-- main container -->
    <div class="content">
        <table class="fc-header" style="width:100%">
            <tbody>
                <br>
                <tr>
                <td class="fc-header-center">
                    <span class="fc-header-title">
                        <h2 style="color:DarkCyan;">Query Results</h2>
                    </span>
                </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-hover" >
        <thead>
             <tr>
                          <th>SID</th>
                          <th>Student Name</th>
                          <th>Course Name</th>
                          <th>Course Time</th>
             </tr>
        </thead>
 <?php
$conn = new mysqli('localhost','root' , '941126xiangjie', 'courses');
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    $sql=" select SID,Cname,Ctime from sc,course where SC.SID like '%{$_POST["SID"]}%' and sc.CID=course.CID and course.Tname in(select Tname from teacher where teacher.TID={$_SESSION['user']})";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        echo '<tr><td>'.$row['SID'].'</td>';
        echo '<td></td>';
        echo '<td>'.$row['Cname'].'</td>';
        echo '<td>'.$row['Ctime'].'</td></tr>';
    }
$conn->close();
?>
        </table>
        </div>
	<!-- scripts -->
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script src='js/fullcalendar.min.js'></script>
    <!-- builds fullcalendar example -->
    
</body>
</html>