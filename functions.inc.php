<?php
//prints the javascript needed to work the map
//options to be implemented
//options to include project, date range, from certain users
//does not include the map div
function printMapScript($map,$options = array()) { 
	$width = 550;
	$height = 400;
	if (!$map instanceof Map) $map = Map::loadMap($map);
	$points = $map->getPoints();
	//then to pass through Options filters
	if (isset($options['height'])) $height = $options['height'];
	if (isset($options['width'])) $width = $options['width'];
	if (isset($options['maps']) && $options['maps']) {
		if (is_array($options['maps'])) {
			foreach ($options['maps'] as $mapID) {
				$temp_map = new Map($mapId);
				foreach ($temp_map->getPoints() as $p) {
					array_push($points, $p);
				}
			}
		} else {
			$temp_map = new Map($options['maps']);
			foreach ($temp_map->getPoints() as $p) {
				array_push($points, $p);
			}
		}
	}
	if (isset($options['users'])) {
		if (is_array($options['users'])) {
			$pts = array();
			foreach ($options['users'] as $user) {
				foreach ($points as $point) {
					if ($point->getUser() == $user) {
						array_push($pts, $point);
					}
				}
			}
			$points = $pts;
		} else {
			$pts = array();
			foreach ($points as $point) {
				if ($point->getUser() == $options['users']) {
					array_push($pts, $point);
				}
			}
			$points = $pts;
		}
	}
	if (isset($options['start'])) {
		//$start = new DateTime($options['start']);
		//function timestart($var){return $start < $var;}
		//$point = array_filter($points, 'timestart');
		//$start = new DateTime($options['start']);
		$pts = array();
		foreach ($points as $point) {
			//var_dump($end . ' ' . $point->getTime());
			var_dump(strtotime($options['start'])  .' '. $point->getTime());
			if (strtotime($options['start'])  < $point->getTime()) {
				array_push($pts, $point);
			}
		}
		$points = $pts;
	}
	if (isset($options['end'])) {
		//$end = new DateTime($options['end']);
		$pts = array();
		foreach ($points as $point) {
			//var_dump($end . ' ' . $point->getTime());
			if (strtotime($options['end']) > $point->getTime()) {
				array_push($pts, $point);
			}
		}
		$points = $pts;
	}
	if (isset($options['demo'])) {
		$points = $_SESSION['points'];
	}
	
	
	if (isset($points[0])) {
		$minLat = $points[0]->getLat();
		$maxLat = $points[0]->getLat();
		$minLng = $points[0]->getLng();
		$maxLng = $points[0]->getLng();
		$min = $points[0]->getValue();
		$max = $points[0]->getValue();
		foreach ($points as $point) {
			if ($point->getLat() < $minLat) $minLat = $point->getLat();
			if ($point->getLat() > $maxLat) $maxLat = $point->getLat();
			if ($point->getLng() < $minLng) $minLng = $point->getLng();
			if ($point->getLng() > $maxLng) $maxLng = $point->getLng();
			if ($point->getValue() < $min) $min = $point->getValue();
			if ($point->getValue() > $max) $max = $point->getValue();
		}
	} else {
		$minLat = $minLng = $maxLat = $maxLng = $max = $min = 0;
	}
	
	//uhh, different api keys per host
	//switch ($_SERVER['HTTP_HOST']) {
		//case 'ecomaplive.com': case 'www.ecomaplive.com':
			//echo '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAA5n2t78oxb_-eRFDjPSn8ARRLXWBrQmFTAU2DsiFqArp7zTGUmRQht9dFGDHkLb_EYeooYdgkB7qo7A" type="text/javascript"></script>' . "\n";
			//break;
		//case 'localhost': case 'localhost:8080':
			//echo '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAA5n2t78oxb_-eRFDjPSn8ART2yXp_ZAY8_ufC3CFXhHIE1NvwkxQDPIiQQLyyTPpXdtPYkVcuORV1jg" type="text/javascript"></script>' . "\n";
			//break;
		//case 'jchiu.no-ip.org':
			//echo '<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAA5n2t78oxb_-eRFDjPSn8ART7CEX8X51e8wWa1QjNIyfbtUMqWRS3SXhtqwouROb1LhXQrdDMT-HRDw" type="text/javascript"></script>' . "\n";
			//break;
//}

	?>
	<!--<script type='text/javascript' src='/images/js/circles.js'></script>-->
	<!--<script type='text/javascript' src='http://www.bdcc.co.uk/Gmaps/BDCCCircle.js'></script>-->
    <script type="text/javascript" src="/images/js/heatmap.js"></script>
    <script type="text/javascript" src="/images/js/heatmap-gmaps.js"></script>
	<script type="text/javascript">
        var locations = [<?php
            foreach ($points as $point) echo $point,",";
        ?>]
		<?php
		if ($minLat==0 || $minLng==0 || $maxLat==0 || $maxLng==0){
			echo "var minLatLng = new google.maps.LatLng(42.358016,-71.093291);";
			echo "var maxLatLng = new google.maps.LatLng(42.358016,-71.093291);";
        } else{
            echo "var minLatLng = new google.maps.LatLng($minLat, $minLng);";
			echo "var maxLatLng = new google.maps.LatLng($maxLat,$maxLng);";
        }
		?>
		var max = <?php echo $max; ?>;
	</script>
	<!--<script type='text/javascript' src='/images/js/print_map_screen.js'></script>-->

	<!--<div id="map" style="z-index: 0; width: <?php echo $width;?>px; height:
        <?php echo $height;?>px;"></div>-->
	<div id="map" style="z-index: 0; width: 100%; height: 100%;"></div>
	<div id="slideshow" style="z-index: 0; width: <?php echo $width;?>px;">
        <div id="play"></div>
        <div id="pause"></div>
        <div id="slider"></div>
    </div>
	<script type='text/javascript' src='/images/js/print_map_screen_trial.js'></script>
<?php 
}

function update_map($points){
    ?>
	<script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function(){
            var locations = [<?php
                foreach ($points as $point) echo $point,",";
            ?>]
            // javascript call
            update_map(locations);
        });
    </script>
    <?php
}

function getProjectList() {
	//Gets all projects by id
	$database = new Database();
	$query = "SELECT `id` FROM `project`";
	$results = $database->query($query);
	$projID = array();
	
	while ($result = $results->fetch_array()) {
		array_push($projID, $result['id']);
	}
	return $projID;
}

function getAllProjects() {
	$ids = getProjectList();
	$projects = array();
	foreach ($ids as $id) {
		array_push($projects, $id);
	}
	return $projects;
}

function getOpenProjectList() {
	//Gets all projects by id
	$database = new Database();
	$query = "SELECT `id` FROM `project` AS a WHERE a.private=0";
	$results = $database->query($query);
	$projID = array();
	
	while ($result = $results->fetch_array()) {
		array_push($projID, $result['id']);
	}
	return $projID;
}

function getOpenProjects() {
	$ids = getOpenProjectList();
	$projects = array();
	foreach ($ids as $id) {
		array_push($projects, $id);
	}
	return $projects;
}

function setPrivate($pid) {
	$database = new Database();
	$query = "UPDATE `project` SET private=1 WHERE id=".$pid;
	$results = $database->query($query);
}

function setPublic($pid) {
	$database = new Database();
	$query = "UPDATE `project` SET private=0 WHERE id=".$pid;
	$results = $database->query($query);
}

function getUserProjects($uid) {
	$ids = getUserProjectList($uid);
	$projects = array();
	foreach ($ids as $id) {
		array_push($projects, $id);
	}
	return $projects;
}

function getUserProjectList($uid) {
	//Gets all projects by id
	$database = new Database();
	$query = "SELECT a.id FROM `project` AS a INNER JOIN `projusers` AS b ON a.id = b.project WHERE b.user = ".$uid;
	$results = $database->query($query);
	$projID = array();
	
	while ($result = $results->fetch_array()) {
		array_push($projID, $result['id']);
	}
	return $projID;
}

function loggedIn() {
	return $_SESSION['user']->isLoggedIn();
}

function array_remove_empty($arr){
    $narr = array();
    while(list($key, $val) = each($arr)){
        if (is_array($val)){
            $val = array_remove_empty($val);
            // does the result array contain anything?
            if (count($val)!=0){
                // yes :-)
                $narr[$key] = $val;
            }
        }
        else {
            if (trim($val) != ""){
                $narr[$key] = $val;
            }
        }
    }
    unset($arr);
    return $narr;
}

function filterQuotes($str) {
	if (stripos($str,"'") !== false || stripos($str,'"') !== false) {
		die('Quotes are not allowed');
	}
	return $str;
}

// Reusable functions
function show_project_list($projs){
    foreach ($projs as $proj) {
        $p = new Project($proj);
            echo "<li class='list-icon button project' id='" . $p->getName() . "'>";
                echo '<a class="projectLink" href="http://',$_SERVER['HTTP_HOST'],'/project/',$p->getID(),'">'.$p->getName().'</a><br>';
                echo 'Blurb: '.$p->getBlurb().'<br>';
                echo 'Description: '.$p->getDescription();
            echo "</li>";
    }
}

// Reusable functions
function show_map_list($maps){
    foreach ($maps as $map) {
        $map = Map::loadMap($map);

        echo "<li class='list-icon button map' id='" . $map->getName() . "'>";
                echo '<a class="mapLink" href="http://',$_SERVER['HTTP_HOST'],'/map/',$map->getID(),'">'.$map->getName().'</a><br>';
        echo "</li>";
    }

}


function printPlotScript($map,$options = array()) { 
	$width = 550;
	$height = 400;
	if (!$map instanceof Map) $map = Map::loadMap($map);
	$points = $map->getPoints();
	//then to pass through Options filters
	if (isset($options['height'])) $height = $options['height'];
	if (isset($options['width'])) $width = $options['width'];
	if (isset($options['maps']) && $options['maps']) {
		if (is_array($options['maps'])) {
			foreach ($options['maps'] as $mapID) {
				$temp_map = new Map($mapId);
				foreach ($temp_map->getPoints() as $p) {
					array_push($points, $p);
				}
			}
		} else {
			$temp_map = new Map($options['maps']);
			foreach ($temp_map->getPoints() as $p) {
				array_push($points, $p);
			}
		}
	}
	if (isset($options['users'])) {
		if (is_array($options['users'])) {
			$pts = array();
			foreach ($options['users'] as $user) {
				foreach ($points as $point) {
					if ($point->getUser() == $user) {
						array_push($pts, $point);
					}
				}
			}
			$points = $pts;
		} else {
			$pts = array();
			foreach ($points as $point) {
				if ($point->getUser() == $options['users']) {
					array_push($pts, $point);
				}
			}
			$points = $pts;
		}
	}
	if (isset($options['start'])) {
		//$start = new DateTime($options['start']);
		//function timestart($var){return $start < $var;}
		//$point = array_filter($points, 'timestart');
		//$start = new DateTime($options['start']);
		$pts = array();
		foreach ($points as $point) {
			//var_dump($end . ' ' . $point->getTime());
			var_dump(strtotime($options['start'])  .' '. $point->getTime());
			if (strtotime($options['start'])  < $point->getTime()) {
				array_push($pts, $point);
			}
		}
		$points = $pts;
	}
	if (isset($options['end'])) {
		//$end = new DateTime($options['end']);
		$pts = array();
		foreach ($points as $point) {
			//var_dump($end . ' ' . $point->getTime());
			if (strtotime($options['end']) > $point->getTime()) {
				array_push($pts, $point);
			}
		}
		$points = $pts;
	}
	if (isset($options['demo'])) {
		$points = $_SESSION['points'];
	}
	
	
	if (isset($points[0])) {
		$minLat = $points[0]->getLat();
		$maxLat = $points[0]->getLat();
		$minLng = $points[0]->getLng();
		$maxLng = $points[0]->getLng();
		$min = $points[0]->getValue();
		$max = $points[0]->getValue();
		foreach ($points as $point) {
			if ($point->getLat() < $minLat) $minLat = $point->getLat();
			if ($point->getLat() > $maxLat) $maxLat = $point->getLat();
			if ($point->getLng() < $minLng) $minLng = $point->getLng();
			if ($point->getLng() > $maxLng) $maxLng = $point->getLng();
			if ($point->getValue() < $min) $min = $point->getValue();
			if ($point->getValue() > $max) $max = $point->getValue();
		}
	} else {
		$minLat = $minLng = $maxLat = $maxLng = $max = $min = 0;
	}

    echo '<!--[if lt IE 9]><script language="javascript" type="text/javascript"
    src="/images/resources/jqplot/excanvas.js"></script><![endif]-->';
    echo '<script language="javascript" type="text/javascript"
    src="/images/resources/jqplot/jquery.jqplot.min.js"></script>';
    echo '<link rel="stylesheet" type="text/css" href="/images/resources/jqplot/jquery.jqplot.css" />';
    echo '<script type="text/javascript" src="/images/resources/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>';
    echo '<script type="text/javascript" src="/images/resources/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>';
    echo '<script type="text/javascript" language="javascript" src="/images/resources/jqplot/plugins/jqplot.dateAxisRenderer.js"></script>';
    echo '<script type="text/javascript" language="javascript" src="/images/resources/jqplot/plugins/jqplot.canvasTextRenderer.js"></script>';
    echo '<script type="text/javascript" language="javascript" src="/images/resources/jqplot/plugins/jqplot.canvasAxisTickRenderer.js"></script>';

    echo "<script language='JavaScript'>\n"; 
    echo "var jsPoints = new Array();\n"; 
    $ix = 0; 
    foreach($points as $key => $value) { 
        echo "jsPoints[$key] = $value;\n"; 
    } 
    echo "</script>\n";

    echo '<div id="plot"></div>';
}


?>
