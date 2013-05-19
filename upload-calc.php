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
	if(count($file) > $max) {
        //echo "count > max";
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/upload/error/'.count($file));
	} else {
        for ($i = 0; $i < count($file); $i++) {
            //$file[$i] = explode(' ',$file[$i]);
            $file[$i] = trim($file[$i]);
            $file[$i] = preg_split('/[\s\,]+/',$file[$i]);
            // was probably for non unix timestamp
            //$file[$i][4] .= ' ' . $file[$i][5];
        }

		foreach ($file as $line) {
            //echo "parsing line";
            $time = $line[0];
            $lat  = $line[1];
            $lng  = $line[2];
            $rad  = $line[3];
            $val  = $line[4];


            //TODO change to project not map
			$point = new Point($project->getID(), $lat, $lng, $rad, $val, $time);
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
