<?php
	require_once('../start_session.php');
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo
    $_SERVER['SERVER_HOST'];?>/images/css/ecostyle.css"/>
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
        <h2>Technology Introduction</h2>
        <p>
            Ecomaplive was build using php on the backend, mysqlite for the
            database, and javascript, html5 and css on the frontend.  In building
            this website, we have taken advantage of multiple open source libraries
            including jQuery, jQuery UI, Google Maps V3, Twitter's Bootstrap, Trent
            Richardson's DateTimepicker, and jqplot.
        </p>
        </br>
        <p>
            A public github repository can be found at:
            https://github.com/goneil/ecomaplive.git
        </p>
    </div>
</div>
</body>
</html>
