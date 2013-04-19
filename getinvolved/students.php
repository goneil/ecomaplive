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
      <h2>Students</h2>
      <p>
      <ul>
	<li>Start a project at your school</li>
	<li>How to build your sensor</li>
	<li>Upload your data!</li>
      <ul>
      </p>
    </div>
</div>
</body>
</html>
