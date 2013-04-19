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
      <h2>Our Team</h2>
      <p>
      Supervisor: <br /> <a href="http://web.media.mit.edu/~fletcher/">Rich Fletcher</a> <br /><br />

      Students: <br /> Yuta Kuboyama<br /><br />

      <a href="http://web.mit.edu/urop/">UROPs:</a> <br /> Coco Agbeyibor <br />
      Jason Chiu <br />
      Michaela LaVan <br />
      Gilbert O'Neil<br/>
      </p>
    </div>
</div>
</body>
</html>
