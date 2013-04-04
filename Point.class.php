<?php
class Point {
    private $id;
    private $projectID;
	private $lat;
	private $lng;
	private $range;
	private $value;
	private $time;
    private static $database;
	
	function __construct($projectID, $lat, $lng, $range, $value, $time = "") {
        $this->database = new Database();
        $this->projectID = $projectID;
		$this->lat = $lat;
		$this->lng = $lng;
		$this->range = $range;
		$this->value = $value;
		//$time = new DateTime($time);
		//$this->time = $time->format("Y-m-d H:i:s");
        $this->time = $time;
	}

    function exportToDB(){
		$query = "INSERT INTO `point` VALUES(DEFAULT, '$this->projectID',
                  '$this->lat', '$this->lng', '$this->range', '$this->value',
                  $this->time)";
		$this->database->query($query);
		$this->id = $this->database->getConnection()->insert_id;
    }

    // TODO return point from db with id $id
    // might have an error with database
    static function loadPoint($id){
        $query = "SELECT * FROM `point` WHERE `id` = '$id'";
        $database = new Database();
		$info = $database->query($query);
        if ($info){
            $info = $info->fetch_array();
            $point = new Point($info['project'], $info['lat'], $info['lng'],
                               $info['range'], $info['val'], $info['time']);
            $point->setID($info['id']);
            return $point;
        } else{
            echo "Point::loadPoint: no points with id " . $id;
            return null;
        }
    }

    function setID($id){
        $this->id = $id;
    }
	
    // TODO function not used
    // function will also fail
	function getJSCoords() {
		return "[$this->lat,$this->lng,$this->range,$this->value,$this->id,$this->time]";
	}
	
	function getLat() {
		return $this->lat;
	}
	
	function getLng() {
		return $this->lng;
	}
	
	function __toString() {
		return $this->getJSCoords();
	}
	
	function getUser() {	
		return $this->id;
	}
	
	function getMap() {
		return $this->map;
	}
	
	function getRange() {
		return $this->range;
	}
	
	function getValue() {
		return $this->value;
	}
	
	function getTime() {
		return $this->time;
	}
    function remove(){
        $database = new Database();
        $query = "DELETE FROM `point` WHERE id=".$this->id;
        $results = $database->query($query);
    }
}
?>
