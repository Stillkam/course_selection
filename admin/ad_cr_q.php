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
            <li class="active">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <a href="admin.php">
                    <i class="icon-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li >
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


	<!-- main container -->
    <div class="content">
        <table class="fc-header" style="width:100%">
            <tbody>
                <br>
                <tr>
                <td class="fc-header-center">
                    <span class="fc-header-title">
                    <h2 style="color:DarkCyan;">Course INFO  </h2>
                    </span>
                </td>
                </tr>
            </tbody>
        </table>
<?php
$cor=$_POST['cor'];
 $conn = new mysqli('localhost','root' , '941126xiangjie', 'courses');
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    $sql = "select CID,Cname,Tname,Croom,Credit,Ctime,Cnum from course where course.CID like '%{$cor}%' or course.Cname like '%{$cor}%'";
$result=$conn->query($sql); 
while($row = $result->fetch_assoc()){
     echo '<table class="table table-hover" >
        <thead>
             <tr>
                          <th>CID</th>
                          <th>Course Name</th>
                          <th>Teacher Name</th>
                          <th>Course Room</th>
                          <th>Credit</th>
                          <th>Course Time</th>
                          <th>Num</th>
             </tr>
        </thead>';
        echo '<tbody><td>'.$row['CID'].'</td>';
        echo '<td>'.$row['Cname'].'</td>';
        echo '<td>'.$row['Tname'].'</td>';
        echo '<td>'.$row['Croom'].'</td>';
        echo '<td>'.$row['Credit'].'</td>';
        echo '<td>'.$row['Ctime'].'</td>';
        echo '<td>'.$row['Cnum'].'</td>';
        echo '
             <tr>
                          <td style="color:green">SID</td>
                          <td style="color:green">Student Name</td>
                          <td style="color:green">Grade</td>
             </tr>';
        $sql1="select SID,Grade from sc where sc.CID = '{$row['CID']}'";
        $result1 = $conn->query($sql1);
        while($row1 = $result1->fetch_assoc()){
            $sql2="select SNAME from student where student.SID = {$row1['SID']}";
            $row2=$conn->query($sql2)->fetch_assoc();
            echo '<tr><td>'.$row1['SID'].'</td>';
            echo '<td>'.$row2['SNAME'].'</td>';
            echo '<td>'.$row1['Grade'].'</td></tr>';
        }
}
$conn->close();
?>
        </div>
	<!-- scripts -->
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script src='js/fullcalendar.min.js'></script>  
    <!-- builds fullcalendar example -->
    
</body>
</html>