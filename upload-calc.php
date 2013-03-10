<?php 
if (isset($_POST['upload'])) {
	$max = 150;
	if (!loggedIn()) {
		filterQuotes($_POST['user']);
		filterQuotes($_POST['pass']);
		$user = new User($_POST['user'],$_POST['pass']);
	} else {
		$user = $_SESSION['user'];
	}
    $project = new Project($request[1]);
	$filename = $_FILES['file']['tmp_name'];
	$file = file($filename);
	for ($i = 0; $i < count($file); $i++) {
		$file[$i] = explode(' ',$file[$i]);
		if (count($file[$i]) != 6) {
			//throw error
		}
		$file[$i][4] .= ' ' . $file[$i][5];
	}
	if(count($file) > $max) {
        //echo "count > max";
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/upload/error/'.count($file));
	} else {
		foreach ($file as $line) {
            //echo "parsing line";
            // line 0: latitude
            // line 1: longitude
            // line 2: range
            // line 3: val
            // line 4: time
			if ($line[3] > 1) $line[3] = 1;
			if ($line[3] < 0) $line[3] = 0;
            //TODO change to project not map
			$point = new Point($project->getID(), $line[0], $line[1], $line[2], $line[3], $line[4]);
            $point->exportToDB();
		}
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/project/'.
               $project->getID()) ;


	}
}
if (isset($_POST['dl'])) {

	header('Location: http://'.$_SERVER['HTTP_HOST'].'/datapoints.dat') ;
}
?>
