<?php
class MapPoints {
	private $map_id;
	private $point_id_list;
	private static $database;
	
	function __construct($map_id, $point_id_list) {
		$this->construct($map_id, $point_id_list);
	}


	function construct($map_id, $point_id_list) {
		$this->database = new Database();
        $this->map_id = $map_id;
		$this->point_id_list = $point_id_list;
	}

    //TODO make sure correct
    function exportToDB(){
        foreach($this->point_id_list as $point_id){
		    $query = "INSERT INTO `mappoints` VALUES($this->map_id,
                     $point_id)";
            $this->database->query($query);
        }
    }
    
    function getPoints(){
        return $this->point_id_list;
    }


	public static function loadMapPoints($map_id) {
        $database = new Database();
        $query = "SELECT * FROM `mappoints` WHERE `map_id` = '$map_id'";
        $info = $database->query($query);
        $point_id_list = array();
        if ($info){
            while($row = $info->fetch_array()){
                array_push($point_id_list, $row['point_id']);
            }
            return new MapPoints($map_id, $point_id_list);
        } else{
            echo "no mappoints with id: " . $map_id;
        }
	}
    function remove(){
        $query = "DELETE FROM `mappoints` WHERE map_id=".$this->map_id;
        $results = $this->database->query($query);

    }
}
?>
