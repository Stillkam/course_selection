<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Teacher</title>
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
            <li class="active">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <a href="teacher.php">
                    <i class="icon-home"></i>
                    <span>Home</span>
                </a>
            </li>            
            <li>
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
            <form role="form" name='form' method="post">
            <li><br>
            <input type="text" class="span8 inline-input" name="SID" placeholder="SID">
            </li><br>
                 <table>
            <tr>
                <input type="submit" value="SID Query" class="btn-flat info" onclick="Tquery()"/>
            </tr><br>
                </table>
            </form>
        </ul>
    </div>
    <!-- end sidebar -->


	<!-- main container -->
    <div class="content">
         
         <table class="table table-hover">
            <tr>
                <form role="form" id="form" method="post" >
                <td style="width: 200px;"><input type="text" class="span8 inline-input" name="SID" placeholder="SID" style="width:150px"></td>
                <td style="width: 200px;"><input type="text" class="span8 inline-input" name="CID" placeholder="CID" style="width:150px"></td>
                <td style=" padding-left: 60px;width:50px;"><input type="button" value="SELECT" class="btn-flat white" id="btn_select" /></td>
                <td ><input type="button" value="Drop" class="btn-flat gray" id="btn_drop"/> </td>   
                </form></tr>
        </table>
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
require 'Ttable.php';
getttable($_SESSION['user']);
?>
                          </tbody>
                    </table>
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
    </script>    
     <script>
        document.getElementById('btn_select').addEventListener('click', function (){
            document.getElementById('form').action="Tselect.php";
            document.getElementById('form').submit();
        });
        document.getElementById('btn_drop').addEventListener('click', function (){
            document.getElementById('form').action="Tdrop.php";
            document.getElementById('form').submit();
        });
    </script>
    <!-- builds fullcalendar example -->
    
</body>
</html>