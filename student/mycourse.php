<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Course</title>
    
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
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
            <li >
                <a href="home.php">
                    <i class="icon-home"></i>
                    <span>Home</span>
                </a>
            </li>            
           
            <li class="active">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
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


	<!-- main container -->
    <div class="content">
        <table class="fc-header" style="width:100%">
            <tbody>
                <br>
                <tr>
                <td class="fc-header-center">
                    <span class="fc-header-title">
                        <h2 style="color:DarkCyan;">My Courses</h2>
                    </span>
                </td>
                </tr>
            </tbody>
        </table>
     <table class="table table-hover" >
         <thead>
             <tr>
                          <th></th>
                          <th>CID</th>
                          <th>Course name</th>
                          <th>Teacher name</th>
                          <th>Course room</th>
                          <th>Credit</th>
                          <th>time</th>
                          <th>num</th>
             </tr>
         </thead>
         <tbody>
<?php
$Tcredit=0;
$conn = new mysqli('localhost','root' , '941126xiangjie', 'courses');
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    $sql="select CID from sc where sc.SID={$_SESSION['user']}";
    $result = $conn->query($sql); 
    $i=1;
    while($row = $result->fetch_assoc()){
        $sql1="select CID,Cname,Tname,Croom,Credit,Ctime,Cnum from course where course.CID='{$row['CID']}'";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        echo '<tr><td>'.$i.'</td>';
        echo '<td>'.$row1['CID'].'</td>';
        echo '<td>'.$row1['Cname'].'</td>';
        echo '<td>'.$row1['Tname'].'</td>';
        echo '<td>'.$row1['Croom'].'</td>';
        echo '<td>'.$row1['Credit'].'</td>';
        echo '<td>'.$row1['Ctime'].'</td>';
        echo '<td>'.$row1['Cnum'].'</td>';
        $i++;
        $Tcredit+=$row1['Credit'];
        }
?>
         </tbody>
        </table>
<h1 style="color:DarkCyan;">Total Credits: <?php echo $Tcredit; ?></h1>
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
    function selection(){
        document.form.action="select.php";
    }
    function drop(){
        document.form.action="drop.php";
    }    
    </script>    
    <!-- builds fullcalendar example -->
    
</body>
</html>