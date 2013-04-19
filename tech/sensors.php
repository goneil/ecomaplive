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
    <div class="banner" id="banner2"><img src="<?php echo $_SERVER['SERVER_HOST'];?>/tech/bannertech.jpg"></img></div>
    <?php include ("../mainmenu.php"); ?>
    <div class="content">
      <h2>Sensors</h2>
      <p>
      JASON ADD CONTENT HERE
      </p>
    </div>
</div>
</body>
</html>
