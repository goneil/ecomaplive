<?php
if (!isset($_SESSION['points'])) $_SESSION['points'] = array();
if (isset($_POST['delete'])) {
	$_SESSION['points'] = array();
}
if (isset($_POST['demo'])) {
	//for documentation look in map-calc
	function process($list) {
		$temp = array();
		for ($i = 0; $i < count($list);$i++) {
			if (!empty($list[$i])) {
				filterQuotes($list[$i]);
				array_push($temp, (double)$list[$i]);
			}
		}
		return $temp;
	}
	
	$lat = process($_POST['lat']);
	$lng = process($_POST['lng']);
	$radius = process($_POST['radius']);
	for ($i = 0; $i < count($lat); $i++) {
		$point = new Point(0, $lat[$i], $lng[$i], $radius[$i], 1, "",
        new Database());
		array_push($_SESSION['points'], $point);
	}
}
?>
