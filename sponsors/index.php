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
    <div class="banner" id="banner6"><img src="<?php echo $_SERVER['SERVER_HOST'];?>/sponsors/bannersponsors.jpg"></img></div>
    <?php include ("../mainmenu.php"); ?>
    <div class="content">
      <h2>Sponsorship</h2>
      <p>
      To become a sponsor, contact:
      <br />
      <br /> Dr. Rich Fletcher
      <br /> fletcher (at) media (dot) mit (dot) edu
      <br />
      <br /> Professor Rosalind Picard
      <br /> Director of Affective Computing
      <br /> picard (at) media (dot) mit (dot) edu
      </p>
    </div>
</div>
</body>
</html>
