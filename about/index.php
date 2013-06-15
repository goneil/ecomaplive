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
    <div class="banner" id="banner1"><img src="<?php echo $_SERVER['SERVER_HOST'];?>/images/grassbanner1.jpg"></img></div>
    <?php include ("../mainmenu.php"); ?>
    <div class="content">
      <h2>About</h2>
      <p>
      <ul>
        <li><a href="team.php">Our Team</a></li>
        <li><a href="vision.php">Vision</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      </p>
    </div>
</div>
</body>
</html>
