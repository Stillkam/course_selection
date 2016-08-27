<?php
session_start();
$_SESSION['user']=666;
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
       <h2 style="margin-left: 25px;font-style:Comic Sans MS;color:CadetBlue;margin-top: 50px;margin-bottom: 20px;height: 50px;"> INFO Query</h2>
        <table class="table table-hover">
            <tr><td style="width: 200px;"><span class="label label-success">Student INFO Query</span></td>
                <form method="post" action="ad_st_q.php">
                <td style="width: 250px;"><input type="text" class="span8 inline-input" name="Std" placeholder="SID OR NAME" style="width:150px"></td>
                <td><input type="submit" value="QUERY" class="btn-flat inverse"> </td>
                </form></tr>
             <tr><td style="width: 200px;"><span class="label label-info">Teacher INFO Query</span></td>
                 <form method="post" action="ad_te_q.php">
                <td style="width: 250px;"><input type="text" class="span8 inline-input" name="Tec" placeholder="TID OR NAME" style="width:150px"></td>
                <td><input type="submit" value="QUERY" class="btn-flat inverse"> </td>
                </form></tr>
            <tr><td style="width: 200px;"><span class="label">Course INFO Query</span></td><form method="post" action="ad_cr_q.php">
                <td style="width: 250px;"><input type="text" class="span8 inline-input" name="cor" placeholder="CID OR NAME" style="width:150px"></td>
                <td><input type="submit" value="QUERY" class="btn-flat inverse"> </td>
                </form></tr>
            </table>
         <h2 style="margin-left: 25px;font-style:Comic Sans MS;color:CadetBlue;margin-top: 50px;margin-bottom: 20px;height: 50px;">
             Select/Drop Course</h2>
         <table class="table table-hover">
            <tr>
                <form role="form" id="form" method="post" >
                <td style="width: 200px;"><input type="text" class="span8 inline-input" name="SID" placeholder="SID" style="width:150px"></td>
                <td style="width: 200px;"><input type="text" class="span8 inline-input" name="CID" placeholder="CID" style="width:150px"></td>
                <td style=" padding-left: 60px;width:50px;"><input type="button" value="SELECT" class="btn-flat white" id="btn_select" /></td>
                <td ><input type="button" value="Drop" class="btn-flat gray" id="btn_drop"/> </td>   
                </form></tr>
        </table>
        </div>
	<!-- scripts -->
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script src='js/fullcalendar.min.js'></script>  
    <script>
        document.getElementById('btn_select').addEventListener('click', function (){
            document.getElementById('form').action="ad_select.php";
            document.getElementById('form').submit();
        });
        document.getElementById('btn_drop').addEventListener('click', function (){
            document.getElementById('form').action="ad_drop.php";
            document.getElementById('form').submit();
        });
    </script>
    <!-- builds fullcalendar example -->
    
</body>
</html>