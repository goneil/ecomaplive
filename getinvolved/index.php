<?php
	require_once('../start_session.php');
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo
    $_SERVER['SERVER_HOST'];?>/images/css/ecostyle.css" />
    <link rel="stylesheet" type="text/css" href="http://<?php echo
    $_SERVER['HTTP_HOST'];?>/images/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="http://<?php echo
    $_SERVER['HTTP_HOST'];?>/images/css/bootstrap-responsive.min.css" />
</head>
<body>
<div class="all">
    <div class="banner" id="banner4"><img src="<?php echo $_SERVER['SERVER_HOST'];?>/getinvolved/bannergetinvolved.jpg"></img></div>
    <?php include ("../mainmenu.php"); ?>
    <div class="content">
      <h2>Get Involved</h2>
      <p>
      <ul>
        <li><a href="students.php">Students</a></li>
        <li><a href="teachers.php">Teachers</a></li>
        <li><a href="ngos.php">NGOs</a></li>
        <li><a href="developers.php">Developers</a></li>
      </ul>
      </p>
    </div>
</div>
</body>
</html>
