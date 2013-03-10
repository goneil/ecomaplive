<?php
class Map {
	private $id;
	private $name;
	private $project;
	private $isPrivate;
	private $points;
	private static $database;
	
	function __construct($id = 0) {
		$this->construct($id);
	}


	function construct($name, $project, $isPrivate, $points) {
		$this->database = new Database();
		$this->isPrivate = $isPrivate;
		$this->name = $name;
		$this->project = $project;
		$this->points = $points;
	}

    //TODO make sure correct
    function save(){
		$query = "INSERT INTO `maps` VALUES(DEFAULT, '$this->name',
                 '$this->project', '$this->isPrivate')";
		$this->database->query($query);
        //TODO is this how to set id?
		$this->id = $this->database->getConnection()->insert_id;
        return false;
    }


    /** TODO implement function
      * @returns new Map loaded from the database
      * @params id {int}
      */
	public static function loadMap($id) {
		$database = new Database();
		$query = "SELECT * FROM `projmaps` WHERE `map` = '$id'";
		$info = $this->database->query($query)->fetch_array();
		if (!$info) { $this->loadMap(0); }
		$isPrivate = $info['private'];
		$name = $info['name'];
		$project = $info['project'];
		$query = "SELECT * FROM `data` WHERE `map` = '$id'";
		$data = $this->database->query($query);
		$points = array();
		while ($point = $data->fetch_array()) {
			array_push($points, new Point($point['lat'],$point['lng'],$point['map'],$point['uid'],$point['range'],$point['val'],$point['time']));
		}
        return (new Map($name, $project, $isPrivate, $points));
	}

    function getMapFromDB($database, $id){
        
    }
	
    //TODO delete
	function createNew($project, $name, $isPrivate) {
        if (!$isPrivate){
            $isPrivate = 0;
        }
		$query = "INSERT INTO `projmaps` VALUES('$project', DEFAULT, '$isPrivate', '$name')";
        echo $query;
		$this->database->query($query);
		$id = $this->database->getConnection()->insert_id;
		$this->construct($id);
	}
	
	function addPoint(Point $point) {
		array_push($this->points, $point);
		$lat = $point->getLat();
		$lng = $point->getLng();
		$map = $this->getID();
		$uid = $point->getUser();
		$range = $point->getRange();
		$val = $point->getValue();
		$time = $point->getTime();
		$query = "INSERT INTO `data` VALUES('$lat', '$lng', '$map', '$uid', '$range', '$val', '$time')";
		$this->database->query($query);
	}
	
	function getPoints() {
		return $this->points;
	}
	
	function getID() {
		return $this->id;
	}
	
	function isPrivate() {
		return $this->isPrivate;
	}
	
	function getProject() {
		return $this->project;
	}
	
	function getName() {
		return $this->name;
	}
}
?>
