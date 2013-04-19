<?php
	require_once('../start_session.php');
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo
    $_SERVER['SERVER_HOST'];?>/images/css/ecostyle.css" />
</head>
<body>
<div class="all">
    <div class="banner" id="banner1"><img src="<?php echo $_SERVER['SERVER_HOST'];?>/images/grassbanner1.jpg"></img></div>
    <?php include ("../mainmenu.php"); ?>
    <div class="content">
      <h2>Vision</h2>
      <p>
        Our team strives to allow users to visualize sensor data to make
        analysis simpler and more efficient.
      </p>
    </div>
</div>
</body>
</html>
