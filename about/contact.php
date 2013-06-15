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
      <h2>Contact Information</h2>
      <p>
        Research Scientist and Project Advisor:
        <a href="http://web.mit.edu/bin/cgicso?query=alias%3DR-fletcher">Rich
        Fletcher</a>
        <br/>
        Undergraduate Researcher:
        <a href="http://web.mit.edu/bin/cgicso?options=general&query=goneil">Gilbert
        O'Neil</a>
      </p>
    </div>
</div>
</body>
</html>
